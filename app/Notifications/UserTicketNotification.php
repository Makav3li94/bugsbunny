<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserTicketNotification extends Notification
{
    use Queueable;

    private $user;
    private $ticket;

    public function __construct($user,$ticket)
    {
        $this->user = $user;
        $this->ticket = $ticket;
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
            'status' => 1,
            'type' => 'تیکت جدید',
        ];
    }

    public function toSms($notifiable)
    {
        return [
            'mobile' => $this->user->mobile,
            'pattern' => '73363',
            'TCode' => $this->ticket->id,
        ];
    }
}
