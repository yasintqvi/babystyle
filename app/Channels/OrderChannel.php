<?php

namespace App\Channels;

use App\Models\User;
use Ghasedak\Laravel\GhasedakFacade;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class OrderChannel{
    public function send($notifiable, Notification $notification)
    {

        try {
            // ارسال پیامک مربوط به سفارش
            $receptor = '0' . $notifiable->phone_number;
            $template = "babystyleOrder";
            $param1 = $notifiable->fullName;
            $type = GhasedakFacade::VERIFY_MESSAGE_TEXT;
            GhasedakFacade::setVerifyType($type)->Verify($receptor, $template, $param1);
        } catch (\Exception $e) {
            // مدیریت خطا در ارسال پیامک سفارش
            logger()->error('Error sending Order SMS via Ghasedak: ' . $e->getMessage());
        }

        try {
            // ارسال پیامک مربوط به سفارش
            $receptor = '09115029577';
            $template = "babystyleSms";
            $param1 = $notifiable->fullName;
            $type = GhasedakFacade::VERIFY_MESSAGE_TEXT;
            GhasedakFacade::setVerifyType($type)->Verify($receptor, $template, $param1);
        } catch (\Exception $e) {
            // مدیریت خطا در ارسال پیامک سفارش
            logger()->error('Error sending Order SMS via Ghasedak: ' . $e->getMessage());
        }

    }
}
