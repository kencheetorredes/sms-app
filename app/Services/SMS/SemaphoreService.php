<?php

namespace App\Services\SMS;

use Illuminate\Support\Facades\Http;

class SemaphoreService implements SmsGatewayInterface
{
    public function send($to, $message)
    {
        return Http::post('https://semaphore.co/api/v4/messages', [
            'apikey' => config('sms.semaphore.api_key'),
            'number' => $to,
            'message' => $message,
            'sendername' => config('sms.semaphore.sender_name')
        ]);
    }
}