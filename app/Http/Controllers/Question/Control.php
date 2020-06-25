<?php

namespace App\Http\Controllers\Question;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Like;
use Gate;

class Control extends Controller
{
    public function Delete(Request $request)
    {
        $id = $request->segment(2);
        $Validation = array(
            "id" => "required|exists:questions,id"
        );
        $Messages = [
            "id.required" => "Something went wrong",
            "id.exists" => "This question dosen't exists"
        ];
        $Validate = Validator(["id" => $id] , $Validation);
        if(!$Validate->fails()) {
            $Question = Question::find($id);

            if(Gate::allows("MyQuestion" , $Question->replier_id))
            {
                $Question->delete();
                session()->flash("message", "You have deleted your question");
                return back();
            }
            else
            {
                session()->flash("error", "You can't delete this question");
                return back();
            }
        }
        else
        {
            session()->flash("error" , $Validate->errors()->first());
            return back();
        }


    }

    public function Like(Request $request)
    {
        $Validation = array(
            "id"    => "required|exists:questions,id"
        );
        $Validate = Validator($request->all() , $Validation);

        if(!$Validate->fails()) 
        {
            $Create = array(
                "question_id" => $request->id,
                "user_id"     => app("User")->id,
            );

            Like::create($Create);
            $Question = Question::find($request["id"]);

            $Id = $Question->replier_id;
            $Question->increment("likes" , 1);
            $Message = "liked you a questoin";
            $this->SendNotification($Id , $request["id"] , $Message , "question");

            return response(["message" , "You liked this post"] , 200);
        }
        else
        {
            return response(["error" , "This post dosen't exists"] , 404);
        }
    }

    public function UnLike(Request $request)
    {
        $Validation = array(
            "id"    => "required|exists:questions,id"
        );
        $Validate = Validator($request->all() , $Validation);

        if(!$Validate->fails()) 
        {
            $Post = Question::where("user_id" , app('User')->id)->where("question_id" , $request["id"])->get()->first();
            if($Post)
            {
                $Question = Question::find($request["id"]);
                $Question->decrement("likes" , 1);
                $Post->delete();
                return response(["message" , "You unliked this post"] , 200);
            }
            else
            {
                return response(["error" , "You didn't like this post"] , 404);
            }
        }
        else
        {
            return response(["error" , "This post dosen't exists"] , 404);
        }
    }
}
