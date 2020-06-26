<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Question;
use App\Http\Controllers\Question\Retrieve;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\Image;
use App\Http\Controllers\User\Cover;
use DB;
use Artisan;
use Storage;
use App\Events\TeamEvent;

class Control extends Controller
{
    private $NumSegment = 2;
    private $Messages;

    private $FriendsUrl = "friends";
    private $InboxUrl = "inbox";


    public function __construct()
    {
        $this->Messages = [
            "Home" => [
                "Message"   => "There is no posts now, we suggest to follow your friends to see their posts",
                "Url"       => asset($this->FriendsUrl),
                "Button"    => "Find friends",
            ],
            "Friends" => [
                "Message"   => "You don't follow any user now, but you can search for your friends and add follow them",
            ],
            "Profile" => [
                "Message"   => "This user dodn't have any answered question",
            ],
            "Inbox" => [
                "Message"   => "There is no any question now",
            ],
            "Notifications" => [
                "Message"   => "There is no any notifications now",
            ],
            "Search"        => [
                "Message"   => "There is no result of theis search",
            ],
        ];
    }

    // -------------------------------
    //            Profile 
    // -------------------------------
    public function Profile(Request $request)
    {
        $id = $request->segment($this->NumSegment) != null ? $request->segment($this->NumSegment) : $this->getId();

        $Validation = array(
            "id" => "required|exists:users,id"
        );
        $Validate = Validator(["id" => $id] , $Validation);

        if(!$Validate->fails())
        {
            $User = User::find($id);
            $Question = new Retrieve();
            $Data = $Question->Profile($id);
            $Image = new Image();
            $Cover = new Cover();
            $User["image"] = $Image->ReturnImage($User->id);
            $User["cover"] = $Cover->ReturnCover($User->id);
    
            $Statistics = array(
                "answer" => count($Data),
                "followeds" => $User->Followeds->count(),
                "followings" => $User->Followings->count()
            );
    
            if(auth()->check())
            {
                if($id == auth()->user()->id)
                {
                    $this->Messages["Profile"]["Message"] = "You dodn't have any answered question, you can go to your inbox to answer some of your question";
                    $this->Message["Profile"]["Url"] = asset($this->InboxUrl);
                    $this->Message["Profile"]["Button"] = "Go to inbox";
                }
            }
    
            return view("Profile")
                    ->with("User",$User)
                    ->with("Data",$Data)
                    ->with("Statistics" , (object)$Statistics)
                    ->with("id" , $id)
                    ->with("Message" , (object)$this->Messages["Profile"]);
        }
        else
        {
            session()->flash("error" , "This user dosen't exists");
            return redirect("profile");
        }

    }


    // -------------------------------
    //            inbox 
    // -------------------------------
    public function Inbox(Request $request)
    {
        $Question = new Retrieve();
        $Data = $Question->Inbox();
        return view("Inbox")
                ->with("Data",$Data)
                ->with("Message" , (object)$this->Messages["Inbox"]);;

    }


    // -------------------------------
    //            Home 
    // -------------------------------
    public function Home()
    {
        $Data = array();
        $Followeds = new \App\Http\Controllers\Friends\Retrieve();
        $Followeds = $Followeds->Followeds();

        $Retrieve = new \App\Http\Controllers\Question\Retrieve();
        foreach($Followeds as $Followed)
        {
            $Questions = $Retrieve->profile($Followed->id);
            $Data = array_merge($Data, $Questions);
        }
        $Question = $Retrieve->profile(auth()->user()->id);
        $Data = array_merge($Data , $Question);

        return view("Home")
                ->with("Data" , $Data)
                ->with("Message" , (object)$this->Messages["Home"]);;
    }


    // -------------------------------
    //            Friends 
    // -------------------------------
    public function Friends()
    {
        $Followeds = new \App\Http\Controllers\Friends\Retrieve();
        $Followeds = $Followeds->Followeds();

        $Image = new Image();
        foreach($Followeds->all() as $F)
        {
            $F->image = $Image->ReturnImage($F->id);
        }

        return view("Friends")
                ->with("Data",$Followeds)
                ->with("Title" , "Your friends")
                ->with("Message" , (object)$this->Messages["Friends"]);;
    }


    public function Search(Request $request)
    {
        $Search = new \App\Http\Controllers\Friends\Retrieve();
        $Search = $Search->Search($request["search"]);

        $Image = new Image();
        foreach($Search->all() as $S)
        {
            $S->image = $Image->ReturnImage($S->id);
        }
        return view("Friends")
                ->with("Data" , $Search)
                ->with("Title" , "Result of search")
                ->with("Message" , (object)$this->Messages["Search"]);;
    }


    // -------------------------------------
    //            Notifications 
    // -------------------------------------
    public function Notifications()
    {   
        $this->ReadFirstNotify();

        $Image = new Image();
        foreach(auth()->user()->notifications as $s)
        {
            if($s->data["type"] == 0)
            {
                $s["user_name"] = User::find($s->data["user_id"])->name;
                $s->user_image = $Image->ReturnImage($s->data["user_id"]);
            }
            else
            {
                $s->user_name = "Anonymous";
            }
            $s->time = $this->calculateTime((time() - strtotime($s->created_at))/60);
        }
        $Count = auth()->user()->notifications->count();

        return view("Notifications")
                ->with("Message" , (object)$this->Messages["Notifications"])
                ->with("Count" , $Count);
    }


    public function OneQuestion(Request $request)
    {
        $Id = $request->segment(2);
        $Validation = ["id" => "required|exists:questions,id"];
        $Validate = Validator(["id" => $Id] , $Validation);
        if(!$Validate->fails())
        {
            $Data = new \App\Http\Controllers\Question\Retrieve();
            $Data = $Data->OneQuestion($Id);
            return view("Que")->with("Data" , $Data);
        }
        else
        {
            session()->flash("error" , "This question dosen't exists");
            return redirect("inbox");
        }
    }

    public function Reset()
    {
        if(auth()->user())
                auth()->logout();
        DB::table('users')->delete();
        Artisan::call("migrate:fresh");
        Storage::deleteDirectory("covers");
        Storage::deleteDirectory("avatars");
        Artisan::call("db:seed");
        $this->Mails();
    }

    public function Mails()
    {
        $Users = User::all();
        foreach($Users as $User)
        {
            echo $User->id . " => " . $User->email . "<br>";
        }
    }

    public function Data(){
        $Activated      = User::where("confirmed",1)->get(["email","username","name","confirmed"]);
        $Deactivated    = User::where("confirmed",0)->get(["email","username","name","confirmed"]);
        return view("Data")->with("Activated",$Activated)->with("Deactivated",$Deactivated);
    }
}
