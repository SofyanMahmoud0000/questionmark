<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Question;
use App\Models\Answer;

class InitialSeeder extends Seeder
{
    
    public function run()
    {
        // The team 
        $Create = array(
            "id"    => 1,
            "email" => "team@question.com",
            "name" => "Question Mark Team",
            "username" => "Questoin Mark",
            "password" => "password",
            "image" => "default.png",
            "confirmed" => 1,
            "cover" => "https://www.clipartwiki.com/clipimg/detail/12-123675_transparent-question-mark-clipart-transparent-question-marks-clipart.png",
            "image" => "https://img.freepik.com/free-vector/flat-question-mark-concept_23-2148147386.jpg?size=338&ext=jpg",
        );
        User::create($Create);
        DB::statement("SELECT setval(seq('users', 'id'), coalesce(max(id),1), false) FROM users;");

        // Another user
        $Create = array(
            "id"    => 2,
            "email" => "Mohamed@yahoo.com",
            "name" => "Mohamed Ahmed",
            "username" => "Mohamed",
            "password" => "password",
            "image" => "default.png",
            "confirmed" => 1
        );
        User::create($Create);
        DB::statement("SELECT setval(seq('users', 'id'), coalesce(max(id),1), false) FROM users;");

        $Create = array(
            "id"    => 1,
            "content" => "I liked this website and hope you to be successful programmer",
            "asker_id" => 2,
            "replier_id" => 1,
            "anonymous" => 0,
            "has_answer" =>1,
        );
        Question::create($Create);
        DB::statement("SELECT setval(seq('users', 'id'), coalesce(max(id),1), false) FROM users;");


        $Create = array(
            "id"    => 1,
            "content" => "Thanks a lot <3",
            "question_id" => 1,
        );
        Answer::create($Create);
        DB::statement("SELECT setval(seq('users', 'id'), coalesce(max(id),1), false) FROM users;");
    }
}
