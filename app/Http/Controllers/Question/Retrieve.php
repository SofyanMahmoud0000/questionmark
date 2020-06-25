<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\User\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\User;

class Retrieve extends Controller
{
    public function Inbox()
    {
        $Questions = $this->getUser()->OtherQuesions->where("has_answer" , 0)->sortByDesc('created_at');      // The question which the users have asked me 
        $Image = new Image();
        $Data = array();
        foreach($Questions->all() as $Question)
        {
            if(!$Question->anonymous)           // not hidden
            {
                $SubData = array(
                    "image" => $Image->ReturnImage($Question->asker_id),
                    "asker_id" => $Question->asker_id,
                    "name" => $Question->asker->name,
                );
            }
            else
            {
                $SubData = array(
                    "image" => $Image->ReturnAnonymous(),
                    "name" => "Anonymous",
                );
            }
            $SubData["content"] = $Question->content;
            $SubData["id"] = $Question->id;
            $SubData["anonymous"] = $Question->anonymous;
            $SubData["time"] = $this->calculateTime((time() - strtotime($Question->created_at))/60);
            $Question->update(["read" => 1]);
            array_push($Data , (object)$SubData);
        }
        return $Data;
    }


    public function Profile($id)
    {
        $User = User::find($id);
        $Questions = $User->OtherQuesions->where("has_answer" , 1)->sortByDesc('created_at');           // The question which the users have asked me 
        $Image = new Image();
        $Data = array();
        foreach($Questions->all() as $Question)
        {
            $SubData;
            if(!$Question->anonymous)           // not hidden
            {
                $SubData = array(
                    "image" => $Image->ReturnImage($Question->asker_id),
                    "asker_id" => $Question->asker_id,
                    "name" => $Question->asker->name,
                    "username" => $Question->asker->username
                );
            }
            else
            {
                $SubData = array(
                    "image" => $Image->ReturnAnonymous(),
                    "name" => "Anonymous",
                );
            }
            $SubData["content"] = $Question->content;
            $SubData["image2"] = $Image->ReturnImage($Question->replier_id);
            $SubData["name2"] = $Question->replier->name;
            $SubData["replier_id"] = $Question->replier_id;
            $SubData["id"] = $Question->id;
            $SubData["anonymous"] = $Question->anonymous;
            $SubData["likes"] = $Question->likes;
            $SubData["answer"] = $Question->answer->content;
            $SubData["time"] = $this->calculateTime((time() - strtotime($Question->answer->created_at))/60);

            array_push($Data , (object)$SubData);
        }
        return $Data;
    }

    public function OneQuestion($Id)
    {
        $Question = Question::find($Id);
        $Image = new Image();

        $Data = array(
            "anonymous" => $Question->anonymous,
            "content"   => $Question->content,
            "id"        => $Question->id,
            "time"      => $this->calculateTime((time() - strtotime($Question->created_at))/60),
        );

        if($Question->anonymous)
        {
            $Data["name"] = "Anonymous";
            $Data["image"] = $Image->ReturnAnonymous();
        }
        else
        {
            $Data["name"] = $Question->asker->name;
            $Data["image"] = $Image->ReturnImage($Question->asker_id);
            $Data["asker_id"] = $Question->asker_id;
        }

        if($Question->has_answer)
        {
            $Data["answer"] = $Question->answer->content;
            $Data["replier_id"] = $Question->replier_id;
            $Data["name2"] = $Question->replier->name;
            $Data["image2"] = $Image->ReturnImage($Question->replier_id);
        }

        return [(object)$Data];
    }


    
}
