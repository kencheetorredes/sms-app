<?php

namespace App\Http\Controllers;

use DB;
use Bkt;
use Auth;
use App\BulkContacts;
use App\Models\Groups;
use Twilio\Rest\Client;
use App\Models\Contacts;
use App\Models\Messages;
use App\Models\ErrorLogs;
use App\Models\Templates;
use App\Models\BulkSendings;
use App\Models\TwilioPhones;
use Illuminate\Http\Request;
use CommonLib;
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
            'from_no' => 'required',
            'scheduled' => 'exclude_if:schedule,null'
        ],[
            'contacts.required_if' => 'Please select atleast one contact!',
            'groups.required_if' => 'Please select atleast one contact!'
        ]); 

        

        $twillio = TwilioPhones::where('id',$data['from_no'])->first();

        $from = $twillio->mobile;
        
        if($data['type'] == 0){
            self::sendToContacts($from,$data['contacts'],$data['message'],$data['from_no']);
            $msg = 'Message Sent';   
        } else if($data['type'] == 1){
            $scheduled = date('Y-m-d H:i:s',strtotime($data['scheduled']));
            self::sendGroupContacts($data['groups'],$data['message'],$scheduled,$data['from_no']);
            $msg = 'Messages on the way';
        }
       
        return response()->json([
            'code'   => 206,
            'msg'    => $msg,
            'target' => 'list_table'
        ]);

    }

    public static function sendGroupContacts($groups,$message,$schedule,$from_id){
        foreach($groups as $group){
            $bulk = BulkSendings::create([
                'group_id' => $group,
                'twillio_id' => $from_id,
                'status' => 0,
                'message' => $message,
                'scheduled' => $schedule,
                'created_by' => Auth::guard('web')->user()->id,
                'send' => 0
            ]);
            $contacts = Contacts::where('group_id',$group)
            ->where('status',1)->get();
            $list = [];
            foreach($contacts as $contact){
                $list[] = [
                    'contact_id' => $contact->id,
                    'bulk_id' => $bulk->id
                ];
            }
            $bulk->total = $contacts->count();
            $bulk->save();
            BulkContacts::insert( $list);
        }
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
            CommonLib::sendMessage($recipient->id,$from,$to,$message,$from_id);
        }

    }

   
    public function replyProcess(Request $request){
        $data = $request->validate([
             'message' => 'required|min:1|max:160',
             'client_id' => 'required',
             'twillio_id' => 'required'
        ]);

        $twillio = TwilioPhones::where('id',$data['twillio_id'])->first();

        $from = $twillio->mobile;
        $recipient = Contacts::where('id',$data['client_id'])->first();
        $to = $recipient->code->code.$recipient->mobile;
      
        CommonLib::sendMessage($data['client_id'],$from,$to,$data['message'],$data['twillio_id']);

        return response()->json([
            'code'   => 200,
            'url'    => route('message.view',[$to,$data['client_id'],$from]) ,
            'target' => '.chat'
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
        $twillio_id = TwilioPhones::where('mobile',$twillio_no)->pluck('id')->first();

        $messages = $user ? Messages::where('client_id',$client_id)->orderBy('created_at')->get() : 
        Messages::where('number',$number)->orderBy('created_at')->get();
        return view('sms.inbox.messages',[
            'messages' => $messages,
            'user' => $user,
            'number' => $number,
            'twillio_no' => $twillio_no,
            'twillio_id' => $twillio_id
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
