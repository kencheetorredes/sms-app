<?php

namespace App\Helper\Bkt;

use Auth;
use App\Models\Logs;
use App\Models\UserNumbers;
use App\Models\SettingUserRoles;

class CommonLib {

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