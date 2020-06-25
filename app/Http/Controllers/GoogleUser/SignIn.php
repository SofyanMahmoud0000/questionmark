<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignIn extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }


    public function SignIn()
    {
        if(auth()->attempt());
    }
}
