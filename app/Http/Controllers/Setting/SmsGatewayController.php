<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\SmsGateways;
use Illuminate\Http\Request;

class SmsGatewayController extends Controller
{
    public function index(){
        return view('setting.gateway.index');
    }

    public function process(Request $request){
        $validate = $request->validate([
            'sms_gateway' => 'required',
            'twilio_sid' => 'required_if:sms_gateway,2',
            'twilio_token' => 'required_if:sms_gateway,2',
            'semaphore_api_key' => 'required_if:sms_gateway,1',
            'semaphore_sender' => 'required_if:sms_gateway,1'
        ]);

        $verify = SmsGateways::where('id', 1)->first();
        if($verify){
            $verify->update($validate);
        }else{
            SmsGateways::create($validate); 
        }

         return response()->json([
            'code'   => 206,
            'msg'    => 'SMS gateway has been saved',
            'target' => 'list_table'
        ]);

    }
}
