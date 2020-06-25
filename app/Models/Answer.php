<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = "answers";

    public $timestamp = true;

    protected $fillable = [
        "content" , "question_id"
    ];
}
