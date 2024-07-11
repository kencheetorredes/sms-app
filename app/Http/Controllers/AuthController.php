<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use CommonLib;
class AuthController extends Controller
{
   public function __construct(){
        $this->middleware('guest:web',['except'=> ['logout']]);
   }
   public function index(){
        return view('auth.login');
   }

   public function forgot(){
    return view('auth.forgot');
    }

    public function reset($code){
        return view('auth.reset');
    }

    public function process($module,Request $request){
        $mod = 'process_'.$module;
        return self::$mod($request);
    }

    public static function process_login($request){

        $credential = $request->validate([
            'email'     => 'required|email|exists:users,email',
            'password'  => 'required'
        ]);

        $credential['status'] = 1;

        if(Auth::attempt($credential)){
            $user = Auth::guard('web')->user()->id;
            return redirect(route('message.index',CommonLib::currentTwillioNo()));
        } else {
            return redirect(route('auth.index'))->with('error', 'invalid email or password');
        } 
    }

    public function logout(Request $request){
        Auth::guard('web')->logout();
        return redirect(route('auth.index'));
    }

   
}
