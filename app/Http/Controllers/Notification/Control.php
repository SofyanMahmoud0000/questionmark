<?php

namespace App\Http\Controllers\Notification;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Control extends Controller
{
    private $ProfileUrl = "profile/";
    private $QuestionUrl= "inbox/";


    public function Notification(Request $request)
    {
        $Validation = array(
            "type"      => "required|in:profile,question",
            "id"        => "required|exists:notifications,id",
        );

        $Validate = Validator($request->all() , $Validation);

        if(!$Validate->fails())
        {
            auth()->user()->notifications->find($request["id"])->markAsRead();
            if($request["type"] == "profile")
            {
                $Validation = array(
                    "notific_id" => "required|exists:users,id",
                );
                $Message = array(
                    "notific_id.exists" => "This user has been removed",
                    "notific_id.required" => "Some thing went wrong"
                );
                $Validate = Validator($request->all() , $Validation);

                if(!$Validate->fails())
                {
                    return redirect(secure_asset($this->ProfileUrl . $request["notific_id"]));
                }
                else
                {
                    session()->flash("error" , $Validate->errors()->first());
                    return back();
                }
            }
            else
            {
                $Validation = array(
                    "notific_id" => "required|exists:questions,id",
                );
                $Message = array(
                    "notific_id.exists" => "This question has been removed",
                    "notific_id.required" => "Some thing went wrong"
                );
                $Validate = Validator($request->all() , $Validation , $Message);

                if(!$Validate->fails())
                {
                    return redirect(secure_asset($this->QuestionUrl . $request["notific_id"]));
                }
                else
                {
                    session()->flash("error" , $Validate->errors()->first());
                    return back();
                }
            }
        }
        else
        {
            session()->flash("error" , "Something went wrong");
            return back();
        }
    }


    public function Clear()
    {
        auth()->user()->notifications->each->delete();
        return back();
    }
}
