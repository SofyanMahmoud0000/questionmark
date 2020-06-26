<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use DB;
use Artisan;
use Storage;
use App\Models\User;


class Control extends Controller
{
    public function SignIn(Request $request)
    {
        if(auth()->guard("admin")->attempt(["username" => $request->username , "password" => $request->password]))
        {
            return redirect("data");
        }
        session()->flash("error" , "There is no admin with email " . $request->email);
        return redirect("/");
    }

    public function LogOut()
    {
        auth()->guard("admin")->logout();
        return redirect("/");
    }

    public function Reset()
    {
        auth()->guard("admin")->logout();
        Storage::deleteDirectory("covers");
        Storage::deleteDirectory("avatars");
        Artisan::call("migrate:fresh");
        return redirect("/");
    }

    public function Seed(){
        Artisan::call("db:seed");
        return redirect("data");
    }

    public function Data()
    {
        $Users = User::all();
        
        echo "The number of users is : " . $Users->count() . "<br><br>";

        foreach($Users->all() as $User)
        {
            echo "[id] => " . $User->id . " || [username] => " . $User->username . " || [name] => " . $User->name . " || [email] => " . $User->email . "<br>";  
        }
    }
}
