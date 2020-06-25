<?php

namespace App\Http\Controllers\User;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests;
use App\Jobs\ConfirmationJob;
use Crypt;
use App\Models\Confirmation;
use App\Http\Controllers\User\Image;
use App\Http\Controllers\User\ConfirmationController;
use session;
use App\Models\Friend;
use App\Models\Question;
use Notification;
use App\Notifications\Notifications;


/**
* @group Create User
* We create the new user in this class 
*/
class Create extends Controller
{

    //------------------------------------------------------------------------------------------------------------------------
    //                                                  Variables
    //------------------------------------------------------------------------------------------------------------------------


    private $ConfirmationLink = "tokencheck?token=";
    private $AllowedTime = 60;


    //------------------------------------------------------------------------------------------------------------------------
    //                                                  functions
    //------------------------------------------------------------------------------------------------------------------------


    //--------------------------------------
    //             Insert
    //--------------------------------------
    /**
    * @queryParam email required 
    * @queryParam password required 
    * @queryParam password_confirmation required 
    * @queryParam name required 
    */
    public function Signup(Request $request)
    {
        $Validate = $this->Validation($request);   
        if(!$Validate->fails())
        {
            $Image = new Image();
            $Create = array(
                "name" => $request["name"],
                "email" => $request["email"],
                "password"=> $request["password"],
                "username" => $this->Username($request["email"]),
                "image" => $Image->ReturnDefault()
            );
            $UserId = User::create($Create)->id;
            event(new \App\Events\SignUp($UserId));
            $Confirmation = new ConfirmationController();
            $Confirmation->Confirmation($request["email"], $UserId);
            session()->flash("message" , "Go to ". $request["email"] ." to confirm your account");
            return redirect("/");
        }
        else 
        {
            session()->flash("error" , $Validate->errors()->first());
            return back();
        }
        
    }

    //--------------------------------------
    //             Validation
    //--------------------------------------
    public function Validation(Request $request)
    {
        $Validation = array(
            "name" => "required|max:30|min:3",
            "email" => "required|email|unique:users,email",
            "password" => "required|confirmed|min:3|max:50"
        );

        $Validate = Validator($request->all(), $Validation);

        return $Validate;
    }



    


    //--------------------------------------
    //             Username
    //--------------------------------------
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



    private function Events($User_id)
    {
        // Follow
        
    }
}
