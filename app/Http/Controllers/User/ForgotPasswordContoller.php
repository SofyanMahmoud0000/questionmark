<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ForgotPassword;
use App\Jobs\ForgotPasswordJob;

class ForgotPasswordContorller extends Controller
{
    private $OriginalPath = "forgotpasswordcheck?token=";
    private $AllowedTime = 60*60;

    /**
    * @authontecated 
    * @queryParam email required The new email the usr want to connect with his account.
    */
    public function Email(Request $request)
    {
        $Validation = array(
            "email" => "required|email|confirmed"
        );
        $Validate = Validator($request->all() , $Validation);
        if($Validate)
        {
            $this->Sender($request["email"]);
    
            session()->flash("message" , "Go to " . $request["email"] . " to reset your password");
            return back();
        }
        else
        {
            session()->flash("error" , $Validate->errors()->first());
            return back();
        }
    }

    private function Sender($Email)
    {
        $User_id = User::where("email" , $Email)->get()->first()->id();
        $Token = Crypt::encryptString(time());
        $Link = asset($this->OriginalPath .= $Token);

        $Create = array(
            "user_id" => $User_id,
            "token" => $Token,
        );
        ForgotPassword::create($Create);

        $ForgotPasswordJob = new ForgotPasswordJob($Email , $Link);
        dispatch($ForgotPasswordJob);
    }


    public function TokenCheck(Request $request)
    {
        $Validation = array(
            "token" => "required|exists:forgotpassword,token"
        );

        $Validate = Validator($request->all() , $Validation);

        if(!$Validate->fails())
        {
            $ForgotPassword = ForgotPassword::where("token" , $request["token"])->first();
            $User = $ForgotPassword->user;

            if(time() - Crypt::decryptString($request["token"]) < $this->AllowedTime)
            {    
                $User->update(["canchangepassword" , 1]);
                $ForgotPassword->delete();

                return view("ResetPassword")->with("id" , $User->id);
            }
            else
            {
                $ForgotPassword->delete();
                $this->Confirmation($User->email);
                session()->flash("error" , "This link is old, we have sent another link to ". $User->email ." go to reset your password again");
                return redirect("/");
            }
        }
        session()->flash("error" , "something go wrong, try to login now");
        return redirect("/");
    }


    public function ResetPassword(Request $request)
    {
        $Validation = array(
            "id"    => "required|exists:users,id",
            "password" => "required|confirmed|min:3|max:50",
        );
        $Message = array(
            "id.required" => "Some thing went wrong, please try again",
            "id.exists" => "Some thing went wrong, please try again"
        );
        $Validate = Validator($request->all() , $Validation);

        if(!$Validate->fails())
        {
            $User = User::find($request["id"]);
            $User->update(["password" , $request["password"]]);

            session()->flash("message" , "You have changed your password");
            return back();
        }
        else
        {
            session()->flash("error" , $Validate->errors()->first());
            return back();
        }
    }
}
