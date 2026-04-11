<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SmsGatewayController extends Controller
{
    public function index(){
        return view('setting.gateway.index');
    }
}
