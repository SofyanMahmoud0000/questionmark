<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Friend;
use Illuminate\Auth\Access\HandlesAuthorization;

class Policies
{
    use HandlesAuthorization;

    
    public function __construct()
    {
        //
    }


    public function Follow($User , $Followed)
    {
        if((Friend::where("following_id" , $User->id)->where("followed_id" , $Followed->id)->count() > 0))
            return true;
        return false;
    }

    public function Settings($User)
    {
        if(auth()->attempt(["email" => $User->email , "password" => ""]))
            return true;
        return false;
    }

    public function Me($User , $Followed)
    {
        if($User->id == $Followed->id)
            return true;
        return false;
    }

    public function Team($User , $Followed)
    {
        if($Followed->id == app("Team")->id)
            return true;
        return false;
    }


    public function MyQuestion($User , $Replier_id)
    {
        if($User->id == $Replier_id)
            return true;
        return false;
    }
}
