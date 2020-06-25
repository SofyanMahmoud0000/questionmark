<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChangeEmailmail extends Mailable
{
    use Queueable, SerializesModels;

    private $Url;
    public function __construct($Url)
    {
        $this->Url = $Url;
    }

    
    public function build()
    {
        return $this->markdown('ChangeEmail')->with("Url" , $this->Url);
    }
}
