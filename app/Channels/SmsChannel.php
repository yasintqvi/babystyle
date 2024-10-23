<?php

namespace App\Channels;

use App\Models\User;
use Ghasedak\Laravel\GhasedakFacade;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class SmsChannel{
    public function send($notifiable, Notification $notification)
    {


        try {
            $receptor = '0' . $notifiable->phone_number;
            $template = "babystyle";
            $type = GhasedakFacade::VERIFY_MESSAGE_TEXT;
            $param1 = $notification->code;
            GhasedakFacade::setVerifyType($type)->Verify($receptor, $template, $param1);
        } catch (\Exception $e) {
            logger()->error('Error sending OTP SMS via Ghasedak: ' . $e->getMessage());
        }


    }
}
