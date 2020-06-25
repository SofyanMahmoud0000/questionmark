<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = "questions";

    public $timestamps = true;
    
    protected $fillable = [
        'asker_id', 'replier_id' , "content" , "likes" , "has_answer" , "anonymous" , "read"
    ];

    public function asker()
    {
        return $this->belongsTo("App\Models\User" , "asker_id" , "id");
    }

    public function replier()
    {
        return $this->belongsTo("App\Models\User" , "replier_id" , "id");
    }

    public function answer()
    {
        return $this->hasOne("App\Models\Answer" , "question_id" , "id");
    }
}
