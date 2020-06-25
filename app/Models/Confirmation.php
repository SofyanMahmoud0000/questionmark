<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Confirmation extends Model
{
    protected $table = "confirmations";

    public $timestamps = false;
    
    protected $fillable = [
        'token', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo("App\Models\User" , "user_id" , "id");
    }
}
