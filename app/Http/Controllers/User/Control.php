<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Controllers\User\Image;

/**
* @group control 
* We control and setting the user here  
*/
class Control extends Controller
{
    /**
    * @authenticated
    * @queryParam name required 
    */
    public function ChangeName(Request $request)
    {
        $Validation = array(
            "name" => "required|max:30|min:3"
        );
        $Validate = Validator($request->all() , $Validation);

        if(!$Validate->fails())
        {
            $User = $this->getUser();
            $User->update(["name" => $request["name"]]);
            
            session()->flash("message" , "You have changed your name to " . $request["name"]);
            return back();
        }
        else 
        {
            session()->flash("error" , $Validate->errors()->first());
            return back();
        }
    }

    /**
    * @authenticated
    * @queryParam currentPassword required 
    * @queryParam newPassword required 
    * @queryParam newPassword_confirmation required 
    */
    public function ChangePassword(Request $request)
    {
        $Validation = array(
            "newPassword" => "required|confirmed|min:3|max:50",
        );
        $Validate = Validator($request->all() , $Validation);
        if(!$Validate->fails())
        {
            if(auth()->attempt(["id" => $this->getId() , "password" => $request["currentPassword"]]))
            {
                $User = $this->getUser();
                $User->update(["password" => $request["newPassword"]]);
                
                session()->flash("message" , "You have changed your password");
                return back();
            }
            else
            {
                session()->flash("error" , "The current password is wrong");
                return back();
            }
        }
        else 
        {
            session()->flash("error" , $Validate->errors()->first());
            return back();
        }
    }


    /**
    * @authenticated  
    */
    public function Logout(Request $request)
    {
        session()->flash("message" , "We wait you to visit us again");
        session()->forget("User");
        auth()->logout();
        return redirect("/");
    }


    /**
    * @authenticated  
    */
    public function Delete(Request $request)
    {
        $Image = new Image();
        $Image->delete();
        $this->getUser()->delete();
        session()->forget("User");
        auth()->logout();


        session()->flash("message" , "We are sad to see you leave us");
        return redirect("/");
    }

}
