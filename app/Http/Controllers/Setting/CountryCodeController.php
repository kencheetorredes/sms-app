<?php

namespace App\Http\Controllers\Setting;

use App\Models\CountryCodes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('setting.country_code.index');
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
        $results     = CountryCodes::lists($search, 1, $offset, $limit,$sort,$orderBy)->get();

       
        return response()->json([
            'rows' => $results,
            'total' => CountryCodes::lists($search)->count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = '')
    {
        return view('setting.country_code.form',[
            'details' =>  CountryCodes::where('id',$id)->first()
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
            'country' => 'required|unique:country_codes,country',
            'code'    => 'required',
            'country_short_name' => 'required'
        ]);

        CountryCodes::create($data);

        return response()->json([
            'code'   => 200,
            'msg'    => 'New Country Code has been saved',
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
            'country' => 'required|unique:country_codes,country,'.$request->id,
            'code'    => 'required',
            'country_short_name' => 'required'
        ]);
        CountryCodes::where('id',$request->id)->update($data);
       

        return response()->json([
            'code'   => 200,
            'msg'    => ' Country Code has been updated',
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
