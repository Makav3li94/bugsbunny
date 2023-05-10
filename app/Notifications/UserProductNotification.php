<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserProductNotification extends Notification
{
    use Queueable;

    private $user;
    private $details;

    public function __construct($user, $details)
    {
        $this->user = $user;
        $this->details = $details;
    }


    public function via($notifiable)
    {
        return ['database', SmsChannel::class];
    }

    public function toDatabase($notifiable)
    {

        return [
            'user_id' => $this->user->id,
            'name' => $this->user->name,
            'mobile' => $this->user->mobile,
            'status' => $this->details['status'],
            'type' => $this->details['type'],
        ];
    }

    public function toSms($notifiable)
    {
        return [
            'mobile' => $this->user->mobile,
            'pattern' => 'srjfkrau8rwu27a',
            'name' => $this->user->name,
            'status' => $this->details['status'],
            'type' => $this->details['type'],
        ];
    }
}
