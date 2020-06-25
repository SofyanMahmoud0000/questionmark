<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    DB::statement("select setval('users_seq', (select max(id) + 1 from users));");
    return [
        "name" => $faker->name,
        "email" => $faker->unique()->email,
        "username" => $faker->unique()->userName,
        "confirmed" => 1,
        "password" => "password",
        "image" => $faker->imageUrl($width = 640, $height = 480),
        "cover" => $faker->imageUrl($width = 640, $height = 480)
    ];
});
