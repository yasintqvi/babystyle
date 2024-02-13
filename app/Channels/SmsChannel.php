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
            $receptor = 0 . $notifiable->phone_number;
            $type = GhasedakFacade::VERIFY_MESSAGE_TEXT;
            $template = "babystyle";
            $param1 = $notification->code;
            GhasedakFacade::setVerifyType($type)->Verify($receptor, $template, $param1);
        }

        catch (\Exception $e) {
            Log::error('Error in Ghasedak verification: ' . $e->getMessage());
        }
    }
}