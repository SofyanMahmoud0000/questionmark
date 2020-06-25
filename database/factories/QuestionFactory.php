<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Question;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    $Count = User::all()->count();
    return [
        "asker_id"   => rand(1,$Count),
        "replier_id" => rand(1,$Count),
        "content"    => $faker->realText($maxNbChars = 50),
        "anonymous"  => rand(0,1),
        "likes"      => 0,
        "has_answer" => 0
    ];
});
