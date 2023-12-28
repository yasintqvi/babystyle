<?php

namespace App\Channels;

use App\Models\User;
use Ghasedak\Laravel\GhasedakFacade;
use Illuminate\Notifications\Notification;

class SmsChannel{
    public function send($notifiable, Notification $notification)
    {
        return 'Ok!';
        $receptor = 0 . $notifiable->phone_number;
        $type = GhasedakFacade::VERIFY_MESSAGE_TEXT;
        $template = "babystyle";
        $param1 = $notification->code;

        $response = GhasedakFacade::setVerifyType($type)->Verify($receptor, $template, $param1);
    }
}