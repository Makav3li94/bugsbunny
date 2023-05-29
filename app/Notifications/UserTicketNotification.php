<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class UserTicketNotification extends Notification implements ShouldQueue
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
        return ['database', 'mail' ,SmsChannel::class];
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
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(Lang::get('New ticket'))
            ->line(Lang::get('You have a new ticket.'))
            ->action(Lang::get('مشاهده تیکت'), route('user.dashboard'))
            ->line(Lang::get('If you do not have an account,ignore this email'));
    }

}
