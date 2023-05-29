<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class UserVerifyNotification extends Notification implements ShouldQueue
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
        return ['database', 'mail', SmsChannel::class];
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
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(Lang::get('notif',['type'=>$this->details['type']]))
            ->line(Lang::get('notifStat',['type'=>$this->details['type'],'status'=>$this->details['status']]))
            ->action(Lang::get('مشاهده'), route('user.dashboard'))
            ->line(Lang::get('If you do not have an account,ignore this email'));
    }

}
