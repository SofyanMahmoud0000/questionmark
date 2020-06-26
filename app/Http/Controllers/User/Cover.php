<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Storage;
use Str;


class Cover extends Controller
{
    private $DefaultImage = "default.jpg";

    private $DefaultPath = "storage2/defaults";
    private $Path = "storage2/covers";

    private $privatePath = "covers";


    public function Change(Request $request)
    {
        $Validate = $this->Validation($request);
        if (!$Validate->fails()) {
            $User = $this->getUser();

            $OldImage = $User->cover;

            $Extension = $request->file("cover")->getClientOriginalExtension();
            $NewImage = str_random(30) . "." . $Extension;
            Storage::putFileAs($this->privatePath, $request->file("cover"), $NewImage);

            $User->update(["cover" => $NewImage]);

            Storage::delete($this->privatePath ."/". $OldImage);
            
            session()->flash("message", "You have changed your image");
            return back();
        } 
        else 
        {
            session()->flash("error", $Validate->errors()->first());
            return back();
        }
    }


    public function Validation(Request $request)
    {
        $Validation = array(
            "cover" => "required|image"
        );

        $Validate = Validator($request->all(), $Validation);
        return $Validate;
    }


    public function ReturnCover($id = null)
    {
        $User = $id == null ? $this->getUser() : User::find($id);

        if (Str::startsWith($User->cover, "http")) {
            return $User->cover;
        } elseif ($User->cover == null) {
            return secure_asset($this->DefaultPath ."/". $this->DefaultImage);
        } else {
            return secure_asset($this->Path ."/". $User->cover);
        }
    }
}
