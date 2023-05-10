<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminNotifications extends Notification
{
    use Queueable;

    private $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase(){
        return [
            'user_id' => $this->details['user_id'],
            'name' => $this->details['name'],
            'company' => $this->details['company'],
            'mobile' => $this->details['mobile'],
            'type' => $this->details['type'],
            'type_id' => $this->details['type_id'],
            'status' => $this->details['status'],
        ];
    }
 }
