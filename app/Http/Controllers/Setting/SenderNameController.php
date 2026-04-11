<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\SemaphoreSenderNames;
use Illuminate\Http\Request;

class SenderNameController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('setting.semaphore_sender_name.index');
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
        $search      = $request->input('search');

        $sort        = $request->sort;
        $orderBy     = $request->order;
        $results     = SemaphoreSenderNames::lists($search, 1, $offset, $limit,$sort,$orderBy)->get();

        foreach( $results as  $result){
            $result->status_        = '<span class="mb-1 badge '.config('setting.status.'.$result->status.'.class').'">'.config('setting.status.'.$result->status.'.label').'</span>';
        }

        return response()->json([
            'rows' => $results,
            'total' => SemaphoreSenderNames::lists($search)->count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = '')
    {
        return view('setting.semaphore_sender_name.form',[
            'details' =>  SemaphoreSenderNames::where('id',$id)->first()
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
            'sender_name' => 'required|unique:semaphore_sender_names,sender_name',
        ]);

       
        SemaphoreSenderNames::create($data);

        return response()->json([
            'code'   => 200,
            'msg'    => 'New Semaphore Sender Name has been saved',
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
            'sender_name' => 'required|unique:semaphore_sender_names,sender_name,'.$request->id,
            'status'    => 'required'
        ]);

        SemaphoreSenderNames::where('id',$request->id)->update($data);
       

        return response()->json([
            'code'   => 200,
            'msg'    => ' Semaphore Sender Name has been updated',
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
