<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SignUp
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $User_id;
    public function __construct($User_id)
    {
        $this->User_id = $User_id;
    }

    
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
