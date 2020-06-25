<?php

namespace App\Http\Controllers\Answer;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Question;
use App\Http\Controllers\Controller;
use App\Models\User;
use Notification;
use App\Notifications\Notifications;

class Create extends Controller
{
    public function Create(Request $request)
    {
        $Validate = $this->Validation($request);
        if(!$Validate->fails())
        {
            $Create = array(
                "content" => $request["content"],
                "question_id" => $request["id"],
            );

            Answer::create($Create);
            $Question = Question::find($request["id"]);
            $Question->update(["has_answer" => 1]);


            $Id = $Question->asker_id;
            $NotificId = $Question->id;
            $Message = "replied to your question";
            $this->SendNotification($Id , $NotificId , $Message ,"question");


            session()->flash("message" , "You have answerd the question");
            return redirect("inbox");
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
            "id" => "required|exists:questions,id"
        );
        $Messages = array(
            "id.required" => "Something went wrong try again",
            "id.exists" => "This question dosen't exists"
        );
        $Validate = Validator($request->all() , $Validation , $Messages);

        return $Validate;
    }
}
