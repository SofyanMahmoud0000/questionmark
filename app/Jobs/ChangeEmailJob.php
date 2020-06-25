<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
use App\Mail\ChangeEmailmail;

class ChangeEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $Email;
    public $Url;
    public function __construct($Email , $Url)
    {
        $this->Email = $Email;
        $this->Url = $Url;
    }

    public function handle()
    {
        Mail::to($this->Email)->send(new ChangeEmailmail($this->Url));  
    }
}
