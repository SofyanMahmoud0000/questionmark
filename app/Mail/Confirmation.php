<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Confirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $Url;
    public function __construct($Url)
    {
        $this->Url = $Url;
    }

    
    public function build()
    {
        return $this->markdown('Confirmaion')->with("Url" , $this->Url);
    }
}
