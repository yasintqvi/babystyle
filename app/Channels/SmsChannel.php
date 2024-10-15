<?php

namespace App\Channels;

use App\Models\User;
use Ghasedak\Laravel\GhasedakFacade;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class SmsChannel{
    public function send($notifiable, Notification $notification)
    {
        // try {
        //     $receptor = 0 . $notifiable->phone_number;
        //     $type = GhasedakFacade::VERIFY_MESSAGE_TEXT;
        //     $template = "babystyle";
        //     $param1 = $notification->code;
        //     GhasedakFacade::setVerifyType($type)->Verify($receptor, $template, $param1);
        // }

        // try {
        //     if ($notification->type == 'otp') {
        //         // ارسال کد OTP
        //         $receptor = '0' . $notifiable->phone_number;
        //         $template = "babystyle";
        //         $type = GhasedakFacade::VERIFY_MESSAGE_TEXT;
        //         $param1 = $notification->code;
        //         GhasedakFacade::setVerifyType($type)->Verify($receptor, $template, $param1);

        //     } else if ($notification->type == 'order') {
        //         // ارسال پیامک مربوط به سفارش
        //         $receptor = '0' . $notifiable->phone_number;
        //         $template = "babystyleSms";
        //         $type = GhasedakFacade::VERIFY_MESSAGE_TEXT;
        //         $param1 = $notification->order->id;
        //         GhasedakFacade::setVerifyType($type)->Verify($receptor, $template, $param1);
        //     }
        // }

        // catch (\Exception $e) {
        //     Log::error('Error in Ghasedak verification: ' . $e->getMessage());
        // }


        try {
            $receptor = '0' . $notifiable->phone_number;
            $template = "babystyle";
            $type = GhasedakFacade::VERIFY_MESSAGE_TEXT;
            $param1 = $notification->code;
            GhasedakFacade::setVerifyType($type)->Verify($receptor, $template, $param1);
        } catch (\Exception $e) {
            logger()->error('Error sending OTP SMS via Ghasedak: ' . $e->getMessage());
        }

        try {
            // ارسال پیامک مربوط به سفارش
            $receptor = '0' . $notifiable->phone_number;
            $template = "babystyleSms";
            $type = GhasedakFacade::VERIFY_MESSAGE_TEXT;
            GhasedakFacade::setVerifyType($type)->Verify($receptor, $template);
        } catch (\Exception $e) {
            // مدیریت خطا در ارسال پیامک سفارش
            logger()->error('Error sending Order SMS via Ghasedak: ' . $e->getMessage());
        }

    }
}
