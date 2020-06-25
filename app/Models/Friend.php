<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $table = "friends";

    public $timestamp = false;

    protected $fillable = [
        "followed_id" , "following_id"
    ];


}
