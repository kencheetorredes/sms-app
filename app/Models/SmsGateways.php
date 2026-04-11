<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsGateways extends Model
{
    use HasFactory;
     protected $fillable = [
        'sms_gateway',
        'twilio_sid',
        'twilio_token',
        'semaphore_api_key',
        'semaphore_sender',
    ];
}
