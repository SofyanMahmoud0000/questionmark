<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForgotPassword extends Model
{
    protected $table = "forgotpassword";

    protected $fillable = [
        "user_id" , "token"
    ];

    public function user()
    {
        return $this->belongsTo("App\Models\User" , "user_id" , "id");
    }
}
