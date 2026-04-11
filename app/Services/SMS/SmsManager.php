<?php

namespace App\Services\SMS;

class SmsManager
{
    public static function driver()
    {
        $gateway = config('sms.default');

        return match ($gateway) {
            'twilio' => app(TwilioService::class),
            'semaphore' => app(SemaphoreService::class),
            default => throw new \Exception("Unsupported SMS gateway")
        };
    }

    public static function send($to, $message)
    {
        return self::driver()->send($to, $message);
    }
}