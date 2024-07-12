<?php

namespace App\Http\Controllers\Setting;

use App\Models\BulkSendings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BulkLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('setting.bulklogs.index');
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
        $results     = BulkSendings::lists($search, 1, $offset, $limit,$sort,$orderBy)->get();

        foreach($results as $result){
            $result->date = date('F m,Y H:i A',strtotime($result->created_at));
            $result->group_name = $result->group->name;
            $result->mobile_ = $result->mobile->mobile;
            $result->schedule = $result->scheduled == null || $result->scheduled == '1970-01-01 00:00:00' ? 'Now' : date('F m,Y H:i A',strtotime($result->scheduled));
            $result->status_        = '<span class="mb-1 badge '.config('setting.bulk_status.'.$result->status.'.class').'">'.config('setting.bulk_status.'.$result->status.'.label').'</span>';
        }
       
        return response()->json([
            'rows' => $results,
            'total' => BulkSendings::lists($search)->count()
        ]);
    }

    public function show($id){
        return view('setting.bulklogs.details',[
            'details' => BulkSendings::where('id',$id)->first()
        ]);
    }
}
