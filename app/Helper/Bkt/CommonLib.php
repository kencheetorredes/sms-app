<?php

namespace App\Helper\Bkt;

use Auth;
use App\Models\Logs;
use App\Models\SettingUserRoles;

class CommonLib {

    public static function accessBYAccount($access,$own_id){
      
        if($access == 3){
            if($own_id == Auth::guard('web')->user()->role_id){
                return true;
            } else {
                return false;
            }
        }
        
        return true;
    }

    public static function role(){
       return  SettingUserRoles::where('id',Auth::guard('web')->user()->role_id)
        ->pluck('name')->first();
    }

    public static function access($module,$access,$display = 0){
        $user_role = SettingUserRoles::where('id',Auth::guard('web')->user()->role_id)
        ->pluck('access')->first();
        $access_list = json_decode( $user_role,true);

        if($display){
            return $access_list[$module];
        } else {
            return isset($access_list[$module]) && $access_list[$module]  == $access ? true : false;
        }

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