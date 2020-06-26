<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = "admins";

    public $timestamps = true;
    
    protected $fillable = [
        'name', 'email', 'password',"username"
    ];

    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = Hash::make($pass);
    }
}
