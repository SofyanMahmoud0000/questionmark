<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\ConfirmationController;
use Illuminate\Support\Facades\Auth;

/**
* @group sign in 
* we sign in the website here 
*/
class SignIn extends Controller
{
    /**
    * @queryParam email required 
    * @queryParam password required  
    */
    public function SignIn(Request $request)
    {
        $Validate = $this->Validation($request);   
        if(!$Validate->fails())
        {
            if (auth()->attempt(["email"=>$request["email"] , "password" => $request["password"]])) {
                $User = $this->getUser();
                if ($User->confirmed == 1) 
                {
                    
                    return redirect("home");
                } 
                else 
                {
                    auth()->logout();
                    session()->flash("error" ," Unconfirmed account, go to ". $User->email ." to confirm your account");
                    return redirect("/");
                }
            }
            else
            {
                session()->flash("error" , "The email or password is wrong");
                return back();
            }
        }
        else 
        {
            session()->flash("error" , "The email or password is wrong");
            return back();
        }
    }


    //--------------------------------------
    //             Validation
    //--------------------------------------
    public function Validation(Request $request)
    {
        $Validation = array(
            "email" => "required|email|exists:users,email",
            "password" => "required"
        );

        $Validate = Validator($request->all(), $Validation);

        return $Validate;
    }
}
