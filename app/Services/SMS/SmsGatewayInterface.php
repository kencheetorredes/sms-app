<?php

namespace App\Services\SMS;

interface SmsGatewayInterface
{
    public function send($to, $message);
}