<?php

namespace App\Listeners;

use App\Events\SignUp;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Friend;

class FriendListener
{
    
    public function __construct()
    {
        //
    }

    
    public function handle(SignUp $event)
    {
        $Create = array(
            "following_id" => $event->User_id,
            "followed_id" => app("Team")->id,
        );

        Friend::create($Create);
    }
}
