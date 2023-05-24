<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserVerifyNotification extends Notification
{
    use Queueable;

    private $user;
    private $details;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
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
            'pattern' => '75511',
            'name' => $this->user->name,
            'status' => $this->details['status'],
            'type' => $this->details['type'],
        ];
    }

}
