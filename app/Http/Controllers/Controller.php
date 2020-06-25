<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\User\Image;
use Session;
use App\Models\User;
use Notification;
use App\Notifications\Notifications;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function getId()
    {
        return auth()->user()->id;
    } 

    public function getUser()
    {
        return auth()->user();
    }

    public function calculateTime($Time)
    {
        switch(true)
        {
            case($Time < 1):
            $Time = "just now";
            break;

            case($Time < 60):
            $Time = floor($Time);
            $Time = ($Time == 1) ? "one minute ago" : $Time . " minutes ago";
            break;

            case($Time > 60):
            $Time = floor($Time/60);
            $Time = ($Time == 1) ? "one hour ago" : $Time . " hours ago";
            break;

            case($Time > 60*24):
            $Time = floor($Time / (60*24));
            $Time = ($Time == 1) ? "one day ago" : $Time . " days ago";
            break;
        }
        return $Time;
    }


    public function SendNotification($Id , $NotificId , $Message ,  $Type  , $Anonymous = false)
    {
        $Notifiable = User::find($Id);
        if($Anonymous)
        {
            $Notification = (object)array(
                "type"          => 1,
                "content"       => $Message,
                "Url"           => secure_asset("notification?type=" . $Type ."&notific_id=" . $NotificId . "&id="),
            );
        }
        else
        {
            $Notification = (object)array(
                "type"          => 0,
                "user_id"       => app("User")->id,
                "content"       => $Message,
                "Url"           => secure_asset("notification?type=" . $Type ."&notific_id=" . $NotificId . "&id="),
            );
        }
        Notification::send($Notifiable, new Notifications($Notification));
    }

    public function DeleteNotification($Notifiable_id , $Sender_id , $Content)
    {
        $Notification = \App\Models\Notification::where("data" , "like" , '%"user_id":' . $Sender_id .'%')
                                                ->where("notifiable_id" , $Notifiable_id)
                                                ->where("data" , "like" , "%follow%")->get()->first();

        if($Notification)
            $Notification->delete();
    }

    public function ReadFirstNotify()
    {
        $Notification = \App\Models\Notification::where("data" , "like" , '%"user_id":' . app("Team")->id .'%')
                                                ->where("notifiable_id" , app("User")->id)
                                                ->where("data" , "like" , "%welcome%")->get()->first();
        if($Notification)
        {
            $Notification->read_at = now();
            $Notification->save();
        }
    }
}
