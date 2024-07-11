<?php

namespace App\Http\Controllers\Setting;

use App\Models\TwilioPhones;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TwillioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('setting.twilio.index');
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
        $results     = TwilioPhones::lists($search, 1, $offset, $limit,$sort,$orderBy)->get();

        foreach( $results as  $result){
            $result->status_        = '<span class="mb-1 badge '.config('setting.status.'.$result->status.'.class').'">'.config('setting.status.'.$result->status.'.label').'</span>';
        }

        return response()->json([
            'rows' => $results,
            'total' => TwilioPhones::lists($search)->count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = '')
    {
        return view('setting.twilio.form',[
            'details' =>  TwilioPhones::where('id',$id)->first()
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
            'mobile' => 'required|unique:twilio_phones,mobile',
            'label' => 'required|unique:twilio_phones,label'
        ]);

       
        TwilioPhones::create($data);

        return response()->json([
            'code'   => 200,
            'msg'    => 'New Twillio has been saved',
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
            'mobile' => 'required|unique:twilio_phones,mobile,'.$request->id,
            'label'  => 'required|unique:twilio_phones,label,'.$request->id,
            'status'    => 'required'
        ]);

        TwilioPhones::where('id',$request->id)->update($data);
       

        return response()->json([
            'code'   => 200,
            'msg'    => ' Twillio Numbers has been updated',
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
