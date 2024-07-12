<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use CommonLib;
use App\Models\Users;
use Illuminate\Http\Request;

class AuthController extends Controller
{
   public function __construct(){
        $this->middleware('guest:web',['except'=> ['logout','profile','process_change_password']]);
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

    public function profile(){
        return view('auth.profile');
    }

    public function process($module,Request $request){
        $mod = 'process_'.$module;
        return self::$mod($request);
    }

    public  function process_change_password(Request $request){
        $code = 300;
        $msg  = 'Invalid current password';
        $data = $request->validate([
            'current_password' => 'required',
            'password'     => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ]);


        $user  = Users::where('id',Auth::guard('web')->user()->id)->first();

        if(Hash::check($data['current_password'], $user->password)){
            $code = 201;
            Users::where('id',Auth::guard('web')->user()->id)->update(
                ['password' => Hash::make($request->password)]
            );
            Auth::guard('web')->logout();
        } 

        return response()->json([
            'code'   => $code,
            'url'    => route('auth.index'),
            'msg'    => $msg
        ]);
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
