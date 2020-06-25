<?php

namespace App\Http\Controllers\Friends;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class Retrieve extends Controller
{
    public function Followings()                    // Get all people who follow you 
    {
        $User = $this->getUser();
        $Followings = $User->Followings;
        return $Followings;
    }


    public function Followeds()                     // Get all people who you follow 
    {
        $User = $this->getUser();
        $Followeds = $User->Followeds;
        return $Followeds;
    }


    public function Search($Search)
    {
        $Result = User::where("username", "like", "%" . $Search . "%")->get();

        return $Result;
    }
}
