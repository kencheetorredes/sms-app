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
use App\Models\CountryCodes;
use Illuminate\Http\Request;
use CommonLib;
use Twilio\TwiML\MessagingResponse;
use App\Models\OtpMessages;

class SmsOtp extends Controller
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
        return view('otp_sms.inbox.index',[
            'twilliono' => $twilliono,
            'twillio_id' => $twillio_id
        ]);

    }
    public function lists($id)
    {
        $twilio_number = TwilioPhones::where('id',$id)->pluck('mobile')->first();

        $lists = OtpMessages::where('twillio_no_id', $id)->get()->unique('number');

        return view('otp_sms.inbox.lists',[
            'lists' => $lists,
            'twilio_number' => $twilio_number
        ]);

        // var_dump($twilio_number);
    }

    public function show($number, $twillio_no)
    {
        $twillio_id = TwilioPhones::where('mobile',$twillio_no)->pluck('id')->first();

        $messages = OtpMessages::where('number',$number)->orderBy('created_at')->get();

        return view('otp_sms.inbox.messages',[
            'messages' => $messages,
            'number' => $number,
            'twillio_no' => $twillio_no,
            'twillio_id' => $twillio_id
        ]);

    }
}
