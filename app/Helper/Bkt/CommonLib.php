<?php

namespace App\Helper\Bkt;

use Auth;
use App\Models\Logs;
use App\Models\Messages;
use App\Models\ErrorLogs;
use App\Models\UserNumbers;
use App\Models\SettingUserRoles;
use Twilio\Rest\Client;
class CommonLib {

    /**
     * Send Messages
     */
    public static function sendMessage($client_id,$from,$recipient,$messages,$from_id,$created_by = ''){
        $account_sid    = getenv("TWILIO_SID");
        $auth_token     = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number  = getenv("TWILIO_NUMBER");

        try{
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($recipient, 
                    ['from' => $from, 'body' => $messages]);
            Messages::create([
                'client_id' => $client_id,
                'number'    => $from,
                'message'   =>  $messages,
                'type'      => 1,
                'twillio_no_id'  => $from_id,
                'created_by' => $created_by == '' ? Auth::guard('web')->user()->id : $created_by
            ]);
            
        } catch(\Exception $exception){
            ErrorLogs::create([
                'client_id' => $client_id,
                'error' => $exception->getMessage(),
                'number' => $recipient,
                'message' => $messages,
                'twillio_no_id' => $from_id
            ]);
        }
       
       
    }
    public static function getRole(){
        return Auth::guard('web')->user()->role;
    }
   
    public static function currentTwillioNo($field = ''){
        $userNumbers = UserNumbers::where('user_id',Auth::guard('web')->user()->id)->first();
        return  $field == '' ? $userNumbers->number->mobile : $userNumbers->number->id;
    }

    public static function usertNumbers(){
        return UserNumbers::where('user_id',Auth::guard('web')->user()->id)->get();
    }


    public static function userId(){
        return Auth::guard('web')->user()->id;
    }

    public static function createLogs($module,$action,$data,$client_id = 0){

        Logs::create([
            'module' => $module,
            'action' => $action,
            'client_id' => $client_id,
            'user_id'   => self::userId(),
            'data'   => json_encode($data)
        ]);
    }

}