<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ChangeEmail extends Model
{
    protected $table = "changeemail";

    public $timestamps = true;
    
    protected $fillable = [
        'token', 'user_id' , "email"
    ];

    public function user()
    {
        return $this->belongsTo("App\Models\User" , "user_id" , "id");
    }
}
