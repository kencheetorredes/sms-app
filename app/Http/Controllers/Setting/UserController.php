<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\SemaphoreSenderNames;
use App\Models\TwilioPhones;
use App\Models\UserNumbers;
use App\Models\Users;
use App\Models\UserSenderNames;
use Bkt;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
      return view('setting.users.index');
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
        $results     = Users::lists($search, 1, $offset, $limit,$sort,$orderBy)->get();

        foreach( $results as  $result){

            $sender_name = [];
            foreach($result->sender_names as $sender){
                    $sender_name[] = $sender->sender_name->sender_name;
            }

            $result->sender_name = implode(',',$sender_name);
            $mobiles = []; 
            foreach($result->mobiles as $mobile){
                $mobiles[] = $mobile->number->mobile;
            }
            $result->mobile = implode(',',$mobiles);
            $result->role_        = '<span class="mb-1 badge '.config('setting.roles.'.$result->role.'.class').'">'.config('setting.roles.'.$result->role.'.label').'</span>';
            $result->status_        = '<span class="mb-1 badge '.config('setting.status.'.$result->status.'.class').'">'.config('setting.status.'.$result->status.'.label').'</span>';
        }

        return response()->json([
            'rows' => $results,
            'total' => Users::lists($search)->count()
        ]);
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = '')
    {
        return view('setting.users.form',[
            'details' =>  Users::where('id',$id)->first(),
            'twillio_nos' => TwilioPhones::where('status',1)->get(),
            'sender_names' => SemaphoreSenderNames::where('status',1)->get()
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
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'mobiles' => 'required_if:gateway,2|array|min:1',
            'sender_names' => 'required_if:gateway,1|array|min:1',
            'role' => 'required'
        ]);

        unset($data['mobiles']);
        unset($data['sender_names']);

        $password = rand('11111111','99999999');
        $data['password'] = Hash::make($password);
        $user = Users::create($data);

        if($request->gateway == 1){
            foreach($request->sender_names as $sender_name){
                UserSenderNames::create([
                    'user_id' => $user->id,
                    'sender_name_id' => $sender_name
                ]);
            }
        } else {
            foreach($request->mobiles as $mobile){
                UserNumbers::create([
                    'user_id' => $user->id,
                    'twillio_nunber' => $mobile
                ]);
            }
        }

        $info = [
            'subject' => env('COMPANY_NAME').' | Invitation',
            'email'   => $request->email,
            'name'    => $request->name,
            'password' => $password,
            'link' => env('APP_URL')
        ];

        Bkt::mail('email.invitation',$info);

        return response()->json([
            'code'   => 200,
            'msg'    => 'New User has been saved',
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
            'name'      => 'required',
            'email'     => 'required|unique:users,email,'.$request->id,
            'mobiles' => 'required_if:gateway,2|array|min:1',
            'sender_names' => 'required_if:gateway,1|array|min:1',
            'role'      => 'required',
            'status'    => 'required',
            'password'  => 'exclude_if:password,null|min:8'
        ]);

        if(isset($data['password'])){
            $data['password'] = Hash::make($data['password']);
        } 
        
        if($request->gateway == 1){
            unset($data['sender_names']);
            UserSenderNames::where('user_id',$request->id)->delete();
            foreach($request->sender_names as $sender_name){
                UserSenderNames::create([
                    'user_id' => $request->id,
                    'sender_name_id' => $sender_name
                ]);
            }
        } else {
            unset($data['mobiles']);
            UserNumbers::where('user_id',$request->id)->delete();
            foreach($request->mobiles as $mobile){
                UserNumbers::create([
                    'user_id' => $request->id,
                    'twillio_nunber' => $mobile
                ]);
            }
        }

        Users::where('id',$request->id)->update($data);
        

        return response()->json([
            'code'   => 200,
            'msg'    => 'User has been updated',
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
