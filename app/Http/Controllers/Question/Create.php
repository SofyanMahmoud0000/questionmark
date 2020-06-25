<?php

namespace App\Http\Controllers\Question;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Notifications\Notifications;
use Notification;
use App\Models\User;

class Create extends Controller
{
    public function Create(Request $request)
    {
        $Validate = $this->Validation($request);
        if(!$Validate->fails())
        {
            $Create = array(
                "content" => $request["content"],
                "asker_id" => $this->getId(),
                "replier_id" => $request["id"],
                "anonymous" => ($request["anonymous"] == "on") ? 1 : 0,
            );

            $NotificId = Question::create($Create)->id;

            $Message = "asked you a questoin";
            $this->SendNotification($request["id"] , $NotificId , $Message ," question" , $request["anonymous"]);
            session()->flash("message" , "Be Polite in your questions");
            return back();
        
            
        }
        else
        {
            session()->flash("error" , $Validate->errors()->first());
            return back();
        }
    }

    private function Validation(Request $request)
    {
        $Validation = array(
            "content" => "required",
            "id" => "required|exists:users,id"
        );
        $Messages = array(
            "id.required" => "Something went wrong try again",
            "id.exists" => "This user dosen't exists"
        );
        $Validate = Validator($request->all() , $Validation , $Messages);

        return $Validate;
    }
}
