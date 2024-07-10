<?php

namespace App\Http\Controllers;

use Bkt;
use App\Models\Groups;
use Twilio\Rest\Client;
use App\Models\Contacts;
use App\Models\Messages;
use App\Models\ErrorLogs;
use App\Models\Templates;
use Illuminate\Http\Request;
use DB;
class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('sms.inbox.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sms.compose.index',[
            'groups' => Groups::all(),
            'contacts' => Contacts::where('status',1)->get(),
            'templates' => Templates::where('status',1)->get()
        ]);
    }

    /**
     * send sms.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        $data = $request->validate([
            'type' => 'required',
            'contacts' => 'required_if:type,0|array|min:1',
            'groups' => 'required_if:type,1|array|min:1',
            'message' => 'required|min:10|max:160'
        ],[
            'contacts.required_if' => 'Please select atleast one contact!',
            'groups.required_if' => 'Please select atleast one contact!'
        ]); 

        $from = '+17079409652';

        if($data['contacts']){
            self::sendToContacts($from,$data['contacts'],$data['message']);
        }

        return response()->json([
            'code'   => 206,
            'msg'    => 'Message Sent',
            'target' => 'list_table'
        ]);

    }

    /**
     * Send messages to contacts
     * @param contacts
     */
    public static function sendToContacts($from,$contacts,$messages){
        $recipients = Contacts::whereIn('id',$contacts)->get();

        foreach($recipients as $recipient){
            $data['name'] = $recipient->name;
            $message  = Bkt::shortcode($messages,$data);
            $to = $recipient->code->code.$recipient->mobile;
            self::sendMessage($recipient->id,$from,$to,$message);
        }

    }

    /**
     * Send Messages
     */
    public static function sendMessage($client_id,$form,$recipient,$messages){
        $account_sid    = getenv("TWILIO_SID");
        $auth_token     = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number  = getenv("TWILIO_NUMBER");

        try{
            // $client = new Client($account_sid, $auth_token);
            // $client->messages->create($recipient, 
            //         ['from' => $form, 'body' => $messages]);
            Messages::create([
                'client_id' => $client_id,
                'number'    => $form,
                'message'   =>  $messages,
                'type'      => 1
            ]);
            
        } catch(\Exception $exception){
            ErrorLogs::create([
                'client_id' => $client_id,
                'error' => $exception->getMessage(),
                'number' => $recipient,
                'message' => $messages
            ]);
        }
       
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($number,$client_id,$twillio_no)
    {
        $user = Contacts::where('id',$client_id)->first();

        $messages = $user ? Messages::where('client_id',$client_id)->orderBy('created_at')->get() : 
        Messages::where('number',$number)->orderBy('created_at')->get();
        return view('sms.inbox.messages',[
            'messages' => $messages,
            'user' => $user,
            'number' => $number,
            'twillio_no' => $twillio_no
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists()
    {
        $lists = Messages::latest()->get()->unique('client_id');
        return view('sms.inbox.lists',[
            'lists' => $lists
        ]);
    }

    
}
