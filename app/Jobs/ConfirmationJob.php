<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\Confirmation;
use Mail;

class ConfirmationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $Email;
    private $Url;
    public function __construct($Email,$Url)
    {
        $this->Email = $Email;
        $this->Url = $Url;
    }

    
    public function handle()
    {
        Mail::to($this->Email)->send(new Confirmation($this->Url));        
    }
}
