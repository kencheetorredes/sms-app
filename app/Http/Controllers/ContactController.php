<?php

namespace App\Http\Controllers;

use App\Models\Groups;
use App\Models\Contacts;
use App\Models\CountryCodes;
use Illuminate\Http\Request;
use Bkt;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact.index');
    }

     /**
     * listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists(Request $request)
    {
        $limit       = $request->input('limit');
        $offset      = $request->input('offset');
        $search      = $request->all();

        $sort        = $request->sort;
        $orderBy     = $request->order;
        $results     = Contacts::lists($search, 1, $offset, $limit,$sort,$orderBy)->get();

        foreach( $results as  $result){
            $result->mobile_code = $result->code->code;
            $result->group_name = isset($result->group->name) ? $result->group->name : '';
            $result->status_        = '<span class="mb-1 badge '.config('setting.status.'.$result->status.'.class').'">'.config('setting.status.'.$result->status.'.label').'</span>';
            if($request->group_id){
                $result->action        = '<a href="#" data-action="remove" data-url="'.route('group.memberProcess').'" data-msg="Are you sure you want to remove '.$result->name.' to this group " data-id="'.$result->id.'" class="text-danger removeToGroup"><i class="fa fa-trash " aria-hidden="true"></i></a>';
            }
        }

        return response()->json([
            'rows' => $results,
            'total' => Contacts::lists($search)->count()
        ]);
    }


    
    /**
     * Show the form for import a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
       return view('contact.import');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = '')
    {
       return view('contact.form',[
            'codes'   => CountryCodes::all(),
            'groups'  => Groups::get(),
            'details' =>  Contacts::where('id',$id)->first()
       ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data = $request->validate([
        'name' => 'required|unique:contacts,name',
        'country_code_id' => 'required',
        'mobile' => 'required|unique:contacts,mobile',
        'group_id' => 'exclude_if:group_id,null'
       ]);

       Contacts::create($data);

        return response()->json([
            'code'   => 200,
            'msg'    => 'New Contact has been saved',
            'target' => 'list_table'
        ]);
    }

    


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:contacts,name,'.$request->id,
            'country_code_id' => 'required',
            'mobile' => 'required|unique:contacts,mobile,'.$request->id,
           'group_id' => 'exclude_if:group_id,null'
           ]);
    
           Contacts::where('id',$request->id)->update($data);
    
           return response()->json([
                'code'   => 200,
                'msg'    => ' Contact has been updated',
                'target' => 'list_table'
           ]);
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function otherProcess(Request $request)
    {
        if($request->data){
            $mod = explode('-',$request->data);
            $module = 'process_'.$mod[0];
        } else {
            $module = 'process_'.$request->action;
        }

       
        return self::$module($request);
    }


    public static function process_upload($request){

        $data = $request->validate([
            'files' => 'required|mimes:csv,txt'
        ]);
        
       
        $path        = 'upload/csv/contacts/';
        $file_name   =  Bkt::uploadFiles($request->file('files'),$path,'',1);
        $code        = 200;
        $table       = "list_table";
       

        return [
            'code'          => $code,
            'data'          => 'import'.'-'.$request->id,
            'current_page'  => 0,
            'file'          => $file_name,
            'percentage'    => 0,
            'url'           => route('contacts.otherProcess')
        ];

    }

    public static function process_import($request){
        $path                   = 'public/upload/csv/contacts/';
        $datas                  = Bkt::read($request->file,$path);
        $dataPatch = explode('-',$request->data);
 
        $header = Bkt::readHead($request->file,$path);
        $attributes = array();

        if(count($datas) > 0){

            foreach($header as $k=> $v) {
                $j = explode('_',$v);
                if( $j[0] == 'attr') {
                    $attributes[] = $j[1];
                }
            }

            $slide_data_import  = array_chunk($datas, 5);

            $last_page          = array_key_last($slide_data_import);
            $current_page       = $request->current_page ? $request->current_page : 0;
            $percentage         = ($current_page + 1 ) / count($slide_data_import) * 100;

            if(in_array('name',$header) && in_array('country',$header) && in_array('mobile',$header)){
                
                foreach($slide_data_import[$current_page] as $data_){
                    $verify         = Contacts::where('mobile',$data_['mobile'])->first();
                    $countryCode    = CountryCodes::where('country',strtolower($data_['country']))->first();

                    if($data_['group'] != ''){
                        $groups = Groups::where('name',$data_['group'])->first();
                        if(!$groups){
                            $group = Groups::create([
                                'name' => $data_['group']
                            ]);
                            $group_id = $group->id;
                        } else {
                            $group_id = $groups->id;
                        }
                    } else {
                        $group_id = null;
                    }
                   
                    if($countryCode){
                        if(!$verify){
                            Contacts::create([
                                'name'                => $data_['name'],
                                'mobile'              => $data_['mobile'],
                                'country_code_id'     => $countryCode->id,
                                'group_id'            => $group_id,
                            ]);
                        } else {
                            $verify->name               = $data_['name'];
                            $verify->country_code_id    = $countryCode->id;
                            $verify->group_id           = $group_id;
                            $verify->save();
                        }
                    }
                   
                }

                return [
                    'file' => $request->file,
                    'is_last' => $last_page == $current_page ? true : false,
                    'last_page'    => $last_page,
                    'current_page' =>  $current_page + 1,
                    'percentage' => $percentage,
                    'table' => 'list_table',
                    'msg'   => 'data has been imported succesfully',
                    'url'   => route('contacts.otherProcess'),
                    'data'  => $request->data
                ];

            } else {
                return [
                    'code' => 300,
                    'msg'  => 'Invalid Template'
                ];
            }



        } else {
            return [
                'code' => 300,
                'msg'  => 'Template Should not be empty'
             ];
        }

    }
}
