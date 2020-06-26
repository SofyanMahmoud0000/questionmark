<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ChangeEmail;
use App\Jobs\ChangeEmailJob;
use Crypt;
use App\Models\User;

/**
* @group Change Email 
* We change the email here  
*/
class ChangeEmailController extends Controller
{

    private $OriginalPath = "changeemailcheck?token=";
    private $AllowedTime = 60*60;

    /**
    * @authontecated 
    * @queryParam email required The new email the usr want to connect with his account.
    */
    public function ChangeEmail(Request $request)
    {
        $Validation = array(
            "email" => "required|email|confirmed"
        );
        $Validate = Validator($request->all() , $Validation);
        if($Validate)
        {
            $this->Confirmation($request["email"]);
    
            session()->flash("message" , "Go to " . $request["email"] . " to confirm new email");
            return back();
        }
        else
        {
            session()->flash("error" , $Validate->errors()->first());
            return back();
        }
    }

    private function Confirmation($Email)
    {

        $Token = Crypt::encryptString(time());
        $Link = asset($this->OriginalPath .= $Token);

        $Create = array(
            "user_id" => $this->getId(),
            "token" => $Token,
            "email" => $Email
        );
        ChangeEmail::create($Create);

        $Confirmation = new ChangeEmailJob($Email, $Link);
        dispatch($Confirmation);
    }


    /**
     * @hideFromAPIDocumentation
     */
    public function TokenCheck(Request $request)
    {
        $Validation = array(
            "token" => "required|exists:changeemail,token",
        );

        $Validate = Validator($request->all() , $Validation);

        if(!$Validate->fails())
        {
            $ChangeEmail = changeemail::where("token" , $request["token"])->first();
            $User = $ChangeEmail->user;

            if(time() - Crypt::decryptString($request["token"]) < $this->AllowedTime)
            {   
                $temp = $ChangeEmail->email;
                $User->update(["email" => $ChangeEmail->email]);
                $ChangeEmail->delete();

                
                session()->flash("message" , "You have changed your email to " . $temp);
                return redirect("settings");
            }
            else
            {
                $ChangeEmail->delete();
                session()->flash("error" , "This link is old, try to change ur email again");
                return redirect("settings");
            }
        }
        session()->flash("error" , "something go wrong, try to login now");
        return redirect("settings");
    }
}
