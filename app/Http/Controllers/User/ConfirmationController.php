<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Confirmation;
use App\Jobs\ConfirmationJob;
use Crypt;
use App\Models\User;


class ConfirmationController extends Controller
{
    private $OriginalPath = "confirmationcheck?token=";
    private $AllowedTime = 60*60;

    //--------------------------------------
    //             Confirmation
    //--------------------------------------
    public function Confirmation($Email , $Id)
    {

        $Token = Crypt::encryptString(time());
        $Link = asset($this->OriginalPath .= $Token);

        $Create = array(
            "user_id" => $Id,
            "token" => $Token
        );
        Confirmation::create($Create);

        $Confirmation = new ConfirmationJob($Email, $Link);
        dispatch($Confirmation);
    }


    //--------------------------------------
    //             token check
    //--------------------------------------
    /**
     * @hideFromAPIDocumentation
     */
    public function TokenCheck(Request $request)
    {
        $Validation = array(
            "token" => "required|exists:confirmations,token"
        );

        $Validate = Validator($request->all() , $Validation);

        if(!$Validate->fails())
        {
            $Confirmation = Confirmation::where("token" , $request["token"])->first();
            $User = $Confirmation->user;

            if(time() - Crypt::decryptString($request["token"]) < $this->AllowedTime)
            {    
                $User->confirmed = 1;
                $User->save();
                $Confirmation->delete();

                session()->flash("message" , "You have confirmed your account, you can login now");
                return redirect("/");
            }
            else
            {
                $Confirmation->delete();
                $this->Confirmation($User->email , $User->id);
                session()->flash("error" , "This link is old, we have sent another link to ". $User->email ." go to confirm again");
                return redirect("/");
            }
        }
        session()->flash("error" , "something go wrong, try to login now");
        return redirect("/");
    }
}
