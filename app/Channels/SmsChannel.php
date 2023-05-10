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
        $this->setKeys();
        if ($message['pattern'] == '9vbxjcri3w650sa') {
            $this->sendFastSmsMokhaberat([$message['mobile']], $message['pattern'],
                [
                    "name" => $message['name'],
                ]);

        } elseif ($message['pattern'] == 'srjfkrau8rwu27a') {
            $this->sendFastSmsMokhaberat([$message['mobile']], $message['pattern'],
                [
                    "name" => $message['name'],
                    "type" => $message['type'],
                ]);
        } elseif ($message['pattern'] == 'qf4gwq4wrrhanss') {
            $this->sendFastSmsMokhaberat([$message['mobile']], $message['pattern'],
                [
                    "name" => $message['name'],
                    "type" => $message['type'],
                    "status" => $message['status'],
                ]);
        }
    }
}
