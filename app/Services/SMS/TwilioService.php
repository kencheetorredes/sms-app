<?php

namespace App\Services\SMS;

use Twilio\Rest\Client;

class TwilioService implements SmsGatewayInterface
{
    protected $client;
    protected $from;

    public function __construct()
    {
        $this->client = new Client(
            config('sms.twilio.sid'),
            config('sms.twilio.token')
        );

        $this->from = config('sms.twilio.from');
    }

    public function send($to, $message)
    {
        return $this->client->messages->create($to, [
            'from' => $this->from,
            'body' => $message
        ]);
    }
}