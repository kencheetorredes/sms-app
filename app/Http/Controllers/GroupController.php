<?php

namespace App\Http\Controllers;

use App\Models\Groups;
use App\Models\Contacts;
use Illuminate\Http\Request;
use Bkt;
class GroupController extends Controller
{

     /**
     * listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists(Request $request)
    {
        $limit       = $request->input('limit');
        $offset      = $request->input('offset');
        $search      = $request->input('search');

        $sort        = $request->sort;
        $orderBy     = $request->order;
        $results     = Groups::lists($search, 1, $offset, $limit,$sort,$orderBy)->get();

        foreach( $results as  $result){
            $result->total      = $result->members->count();
            $result->status_    = '<span class="mb-1 badge '.config('setting.status.'.$result->status.'.class').'">'.config('setting.status.'.$result->status.'.label').'</span>';
        }

        return response()->json([
            'rows' => $results,
            'total' => Groups::lists($search)->count()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        return view('group.index');
    }

    /**
     * Show the form for adding member.
     *
     * @return \Illuminate\Http\Response
     */
    public function addMember($id)
    {
        return view('group.new_member',[
            'details' => Groups::where('id',$id)->first(),
            'contacts' => Contacts::where('status',1)->get()
        ]);
    }

    /**
     * Show the form for import member.
     *
     * @return \Illuminate\Http\Response
     */
    public function import($id)
    {
        return view('group.import',[
            'details' => Groups::where('id',$id)->first()
        ]);
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = '')
    {
        
        return view('group.form',[
            'details' => Groups::where('id',$id)->first()
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
            'name' => 'required|unique:groups,name'
        ]);

        $group = Groups::create($data);

        return response()->json([
            'code'   => 201,
            'url'    => route('group.view',$group->id)
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('group.view.index',[
            'details' => Groups::where('id',$id)->first()
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
            'name' => 'required|unique:groups,name,'.$request->id
        ]);

        Groups::where('id',$request->id)->update($data);

        return response()->json([
            'code'   => 202,
            'target' => '.page-title',
            'data'   => $data['name']
        ]);
        
        
    }

    /**
     * Remove and add member to the group
     * @param  int  Request $request
     * @return \Illuminate\Http\Response
     */
    public function memberProcess(Request $request)
    {
        if($request->action == 'remove'){
            $contact = Contacts::where('id',$request->id)->first();
            $contact->group_id = null;
            $contact->save();
            $msg = $contact->name.' has been remove to this group';
        } elseif($request->action == 'add') {
            $request->validate([
                'contacts' => 'required|array',
                'contacts*' => 'required',
            ]);

            
            foreach($request->contacts as $contact){
                Contacts::where('id',$contact)->update([
                    'group_id' => $request->id
                ]);
            }

            $msg = 'Group member has been updated';
        } else {
            if($request->data){
                $mod = explode('-',$request->data);
                $module = 'process_'.$mod[0];
            } else {
                $module = 'process_'.$request->action;
            }

           
            return self::$module($request);
        }

        return response()->json([
            'code'   => 200,
            'msg'    => $msg,
            'target' => 'list_table'
        ]);

    }

    public static function process_upload($request){

        $data = $request->validate([
            'files' => 'required|mimes:csv,txt'
        ]);
        
       
        $path        = 'upload/csv/contacts-group/';
        $file_name   =  Bkt::uploadFiles($request->file('files'),$path,'',1);
        $code        = 200;
        $table       = "list_table";
       

        return [
            'code'          => $code,
            'data'          => 'import'.'-'.$request->id,
            'current_page'  => 0,
            'file'          => $file_name,
            'percentage'    => 0,
            'url'           => route('group.memberProcess')
        ];

    }

    public static function process_import($request){
        $path                   = 'public/upload/csv/contacts-group/';
        $datas                  = Bkt::read($request->file,$path);
 
        $header = Bkt::readHead($request->file,$path);
        $attributes = array();

        if(count($datas) > 0){

            foreach($header as $k=> $v) {
                $j = explode('_',$v);
                if( $j[0] == 'attr') {
                    $attributes[] = $j[1];
                }
            }

            $slide_data_import  = array_chunk($datas, 10);

            $last_page          = array_key_last($slide_data_import);
            $current_page       = $request->current_page ? $request->current_page : 0;
            $percentage         = ($current_page + 1 ) / count($slide_data_import) * 100;

            if(in_array('name',$header) && in_array('country',$header) && in_array('sku',$header) && in_array('country_code',$header)){
                foreach($slide_data_import[$current_page] as $data_){



                }

                return [
                    'file' => $request->file,
                    'is_last' => $last_page == $current_page ? true : false,
                    'last_page'    => $last_page,
                    'current_page' =>  $current_page + 1,
                    'percentage' => $percentage,
                    'table' => 'list_table',
                    'msg'   => 'data has been imported succesfully',
                    'url'   => route('group.memberProcess'),
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
