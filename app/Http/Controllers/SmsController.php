<?php

namespace App\Http\Controllers;

use DB;
use Bkt;
use App\Models\Groups;
use Twilio\Rest\Client;
use App\Models\Contacts;
use App\Models\Messages;
use App\Models\ErrorLogs;
use App\Models\Templates;
use App\Models\TwilioPhones;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($twilliono)
    {
        $twillio_id = TwilioPhones::where('mobile',$twilliono)->pluck('id')
        ->first();
        return view('sms.inbox.index',[
            'twilliono' => $twilliono,
            'twillio_id' => $twillio_id
        ]);
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
            'message' => 'required|min:10|max:160',
            'from_no' => 'required'
        ],[
            'contacts.required_if' => 'Please select atleast one contact!',
            'groups.required_if' => 'Please select atleast one contact!'
        ]); 

        

        $twillio = TwilioPhones::where('id',$data['from_no'])->first();

        $from = $twillio->mobile;

        if($data['contacts']){
            self::sendToContacts($from,$data['contacts'],$data['message'],$data['from_no']);
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
    public static function sendToContacts($from,$contacts,$messages,$from_id){
        $recipients = Contacts::whereIn('id',$contacts)->get();

        foreach($recipients as $recipient){
            $data['name'] = $recipient->name;
            $message  = Bkt::shortcode($messages,$data);
            $to = $recipient->code->code.$recipient->mobile;
            self::sendMessage($recipient->id,$from,$to,$message,$from_id);
        }

    }

    /**
     * Send Messages
     */
    public static function sendMessage($client_id,$form,$recipient,$messages,$from_id){
        $account_sid    = getenv("TWILIO_SID");
        $auth_token     = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number  = getenv("TWILIO_NUMBER");

        try{
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($recipient, 
                    ['from' => $form, 'body' => $messages]);
            Messages::create([
                'client_id' => $client_id,
                'number'    => $form,
                'message'   =>  $messages,
                'type'      => 1,
                'twillio_no_id'  => $from_id
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

    public function replyProcess(Request $request){
        $data = $request->validate([
             'message' => 'required|min:10|max:160',
             'client_id' => 'required'
        ]);


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
    public function lists($id)
    {
        $twilio_number = TwilioPhones::where('id',$id)->pluck('mobile')->first();
        $lists = Messages::latest()
        ->where('twillio_no_id',$id)->get()->unique('client_id');
        return view('sms.inbox.lists',[
            'lists' => $lists,
            'twilio_number' => $twilio_number
        ]);
    }

    
}
