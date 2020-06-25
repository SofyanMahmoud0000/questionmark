<?php

namespace App\Listeners;

use App\Events\SignUp;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;
use Notification;
use App\Notifications\Notifications;

class NotificationListener
{
    public function __construct()
    {
        //
    }

    public function handle(SignUp $event)
    {
        $Notifiable = User::find($event->User_id);
        
        $Notification = (object)array(
            "type"          => 0,
            "user_id"       => app("Team")->id,
            "content"       => "welcome to you",
            "Url"           => null,
        );
        Notification::send($Notifiable, new Notifications($Notification));
    }
}
