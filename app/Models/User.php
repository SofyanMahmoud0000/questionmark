<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;
use App\Modesl\Confirmation;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = "users";

    public $timestamps = false;
    
    protected $fillable = [
        'name', 'email', 'password',"username" , "image" , "cover" , "canchangepassword"
    ];

    
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = Hash::make($pass);
    }

    public function Confirmation()
    {
        return $this->hasOne("App\Models\Confirmaiton" , "user_id" , "id");
    }

    public function ChangeEmail()
    {
        return $this->hasOne("App\Models\ChangeEmail" , "user_id" , "id");
    }


    public function MyQuesions()                    // The question which i asked for users
    {
        return $this->hasMany("App\Models\Question" , "asker_id" , "id");
    }

    public function OtherQuesions()                 // The question which users have asked me
    {
        return $this->hasMany("App\Models\Question" , "replier_id" , "id");
    }



    public function Followeds()                     // The users who i follow
    {
        return $this->belongsToMany("App\Models\User" , "friends" ,"following_id" , "followed_id" );
    }

    public function Followings()                    // The users who follow me
    {
        return $this->belongsToMany("App\Models\User","friends" , "followed_id" , "following_id");
    }
}
