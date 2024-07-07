<?php

namespace App\Http\Controllers;

use App\Models\Groups;
use App\Models\Contacts;
use App\Models\CountryCodes;
use Illuminate\Http\Request;

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
        'country_mobile_code' => 'required',
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'country_mobile_code' => 'required',
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
