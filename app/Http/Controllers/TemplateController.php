<?php

namespace App\Http\Controllers;

use App\Models\Templates;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sms.template.index');
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
        $results     = Templates::lists($search, 1, $offset, $limit,$sort,$orderBy)->get();

        foreach( $results as  $result){
            $result->status_        = '<span class="mb-1 badge '.config('setting.status.'.$result->status.'.class').'">'.config('setting.status.'.$result->status.'.label').'</span>';
        }

        return response()->json([
            'rows' => $results,
            'total' => Templates::lists($search)->count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = '')
    {
        $details = Templates::where('id',$id)->first();
        return view('sms.template.form',[
            'details' => $details
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
            'name' => 'required|unique:templates,name',
            'content' => 'required'
        ]);

        Templates::create($data);

        return response()->json([
            'code'   => 200,
            'msg'    => 'New Template has been saved',
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
            'name' => 'required|unique:templates,name,'.$request->id,
            'content' => 'required',
            'status' => 'required'
        ]);

        Templates::where('id',$request->id)->update($data);

        return response()->json([
            'code'   => 200,
            'msg'    => 'Template has been updated',
            'target' => 'list_table'
        ]);

    }

}
