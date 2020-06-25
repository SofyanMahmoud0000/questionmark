<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Notifications extends Notification
{
    use Queueable;

    private $Notification;
    public function __construct($Notification)
    {
        // var_dump($Notification);
        // die();
        $this->Notification = $Notification;
    }

    
    public function via($notifiable)
    {
        return ['database'];
    }

    

    
    public function toDatabase($notifiable)
    {
        switch($this->Notification->type)
        {
            case(1):
            return [
                "type"          => 1,                                   // Anonymous
                "content"       => $this->Notification->content,
                "Url"           => $this->Notification->Url,
            ];
            break;

            case(0):
            return [
                "type"          => 0,                                   // Not anonymous
                "user_id"       => $this->Notification->user_id,
                "content"       => $this->Notification->content,
                "Url"           => $this->Notification->Url,
            ];
            break;
        }
    }
}
