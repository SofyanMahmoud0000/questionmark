<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Storage;
use Str;


/**
* @group Image 
* We add and delete the image here  
*/
class Image extends Controller
{
    private $DefaultImage = "default.png";
    private $DefualtAnonymous = "anonymous.jpg";

    private $DefaultPath = "storage2/defaults";
    private $Path = "storage2/avatars";

    private $privatePath = "avatars";



    public function ReturnDefault()
    {
        return $this->DefaultImage;
    }


    /**
    * @authenticated
    */
    public function Delete()
    {
        $User = $this->getUser();

        $OldImage = $User->image;
        $User->update(["image" => $this->DefaultImage]);

        Storage::delete($this->privatePath ."/". $OldImage);

        
        session()->flash("message", "You have delete your image");
        return back();
    }

    public function ReturnImage($id = null)
    {
        $User = $id == null ? $this->getUser() : User::find($id);

        if (Str::startsWith($User->image, "http")) {
            return $User->image;
        } elseif ($User->image == $this->DefaultImage) {
            return secure_asset($this->DefaultPath ."/". $this->DefaultImage);
        } else {
            return secure_asset($this->Path ."/". $User->image);
        }
    }

    public function ReturnAnonymous()
    {
        return secure_asset($this->DefaultPath . "/" . $this->DefualtAnonymous);
    }


    /**
    * @authenticated
    * @queryParam image required
    */
    public function Change(Request $request)
    {
        $Validate = $this->Validation($request);
        if (!$Validate->fails()) {
            $User = $this->getUser();

            $OldImage = $User->image;

            $Extension = $request->file("image")->getClientOriginalExtension();
            $NewImage = str_random(30) . "." . $Extension;
            Storage::putFileAs($this->privatePath, $request->file("image"), $NewImage);

            $User->update(["image" => $NewImage]);

            Storage::delete($this->privatePath ."/". $OldImage);
            
            session()->flash("message", "You have changed your image");
            return back();
        } else {
            session()->flash("error", $Validate->errors()->first());
            return back();
        }
    }


    public function Validation(Request $request)
    {
        $Validation = array(
            "image" => "required|image"
        );

        $Validate = Validator($request->all(), $Validation);
        return $Validate;
    }
}
