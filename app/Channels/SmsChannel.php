<?php

namespace App\Channels;

use App\Traits\SmsableMokhaberat;
use Illuminate\Notifications\Notification;

class SmsChannel
{
    use SmsableMokhaberat;

    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSms($notifiable);
        if ($message['pattern'] == '73363') {
            $this->sendFastSmsMokhaberat($message['mobile'], $message['pattern'],
                [
                    "TCode" => $message['TCode'],
                ]);

        } elseif ($message['pattern'] == '75511') {
            $this->sendFastSmsMokhaberat($message['mobile'], $message['pattern'],
                [
                    "Name" => $message['name'],
                    "Type" => $message['type'],
                    "status" => $message['status'],
                ]);

        }
    }
}
