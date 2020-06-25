<?php

namespace App\Http\Controllers\Friends;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Friend;
use App\Models\User;
use App\Notifications\Notifications;
use App\Http\Controllers\User\Image;
use Notification;
use Gate;

class Control extends Controller
{
    private $Segment = 2;

    public function Follow(Request $request)
    {
        $Id = $request->segment($this->Segment);


        $Validation = array(
            "followed_id" => "required|exists:users,id|different:following_id",
        );
        $Message = array(
            "followed_id.required" => "This user doesn't exist",
            "followed_id.exists" => "This user doesn't exist", 
            "followed_id.different" => "You can't follow yourself"
        );

        $Validate = Validator(["followed_id" => $Id , "following_id" => strval( $this->getId())] , $Validation , $Message);
        if(!$Validate->fails())
        {
            if(Gate::denies("Follow" , User::find($Id)))
            {
                $Create = array(
                    "following_id" => $this->getId(),
                    "followed_id" => $Id,
                );
                Friend::create($Create);

                $Message = "start to follow you";
                $this->SendNotification($Id , $this->getId() , $Message , "profile");
                
                return response(["message" , "You start to follow " . User::find($Id)->name],200);
            }
            else
            {
                return response(["error" , "You alredy follow this user"],403);
            }
        }
        else
        {
            return response(["error" => $Validate->errors()->first()],403);
        }
    }


    public function UnFollow(Request $request)
    {

        $Id = $request->segment($this->Segment);

        $Validation = array(
            "followed_id" => "required|exists:users,id",
        );

        $Message = array(
            "followed_id.required" => "This user doesn't exist",
            "followed_id.exists" => "This user doesn't exist", 
        );

        $Validate = Validator(["followed_id" => $Id , "following_id" => $this->getId()] , $Validation , $Message);

        if(!$Validate->fails())
        {
            if(Gate::allows("Follow" , User::find($Id)) && Gate::denies("Team" , User::find($Id)))
            {
                $Friend = Friend::where("following_id" , $this->getId())->where("followed_id" , $Id)->get()->first();
                $Friend->delete();
                $this->DeleteNotification($Id , $this->getId() ,"follow");
                return response(["message" => "You unfollowed " . User::find($Id)->name],200);
            }
            else
            {
                if(Gate::denies("Follow" , User::find($Id)))
                    return response(["error" => "You don't follow this user"],403);
                else
                    return response(["error" => "You can't unfollow this user"],403);
            }
        }
        else
        {
            return response(["error" => $Validate->errors()->first()],403);
        }
    }
}
