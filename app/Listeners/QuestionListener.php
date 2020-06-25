<?php

namespace App\Listeners;

use App\Events\SignUp;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Question;

class QuestionListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    
    public function handle(SignUp $event)
    {
        $Create = array(
            "content" => "Rate us and tell us if there is anything bother you <3",
            "asker_id" => app("Team")->id,
            "replier_id" => $event->User_id,
            "anonymous" => 0,
        );

        Question::create($Create);
    }
}
