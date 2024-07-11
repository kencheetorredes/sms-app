<?php

namespace App\Http\Controllers\Setting;

use App\Models\ErrorLogs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('setting.logs.index');
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
        $results     = ErrorLogs::lists($search, 1, $offset, $limit,$sort,$orderBy)->get();

        foreach($results as $result){
            $result->date = date('F m,Y H:i A',strtotime($result->created_at));
            $result->client_name = $result->client->name;
            $result->mobile_ = $result->mobile->mobile;
        }
       
        return response()->json([
            'rows' => $results,
            'total' => ErrorLogs::lists($search)->count()
        ]);
    }

    public function show($id){
        return view('setting.logs.details',[
            'details' => ErrorLogs::where('id',$id)->first()
        ]);
    }
   
}
