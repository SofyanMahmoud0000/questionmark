<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Answer;
use App\Models\Question;
use Faker\Generator as Faker;

$factory->define(Answer::class, function (Faker $faker) {

    $Count = Question::all()->count();
    return [
        "content" => $faker->realText($maxNbChars = 50),
        "question_id" => rand(0,$Count),
    ];
});
