<?php

namespace App\Http\Controllers\GoogleUser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Validator;
use Socialite;
class Create extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function Create()
    {
        if($User = Socialite::driver('google')->stateless()->user())
        {
            if(auth()->attempt(["email" => $User->email , "password" => ""]))
            {
                return redirect("home");
            }
            else
            {
                $Validate = $this->Validation($User->email);
                if(!$Validate->fails())
                {
                    $Create = array(
                        "name" => $User->name,
                        "email" => $User->email,
                        "image" => $User->avatar,
                        "username" => $this->Username($User->email),
                        "password" => "",
                    );
                    $UserId = User::create($Create)->id;
                    event(new \App\Events\SignUp($UserId));
                    auth()->attempt(["email" => $User->email , "password" => ""]);
                    return redirect("home");
                }
                else
                {
                    session()->flash("error" , $Validate->errors()->first());
                    return redirect("/");
                }
            }
        }
        else 
        {
            session()->flash("error" , "Something went wrong, please try again");
            return redirect("/");
        }
    }


    private function Validation($Email)
    {
        $Validation = array(
            "email" => "required|email|unique:users,email"
        );

        $Validate = Validator(["email" => $Email] , $Validation);
        return $Validate;
    }



    public function Username($Email)
    {
        $Username = strstr($Email , "@" , 2);
        $Validation = ["Username" => "unique:users,username"];
        $Validate = Validator(["Username" => $Username] , $Validation);
        $Count = 0;
        while($Validate->fails())
        {
            if($Count === 0)
                $Username.="_";
            
            $Username.=$Count;
            $Count++;
            $Validate = Validator::make(["Username" => $Username] , $Validation);
        }
        return $Username;
    }
}
