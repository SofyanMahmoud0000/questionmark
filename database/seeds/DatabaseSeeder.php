<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(InitialSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AdminSeeder::class);
        // $this->call(QuestionSeeder::class);
        // $this->call(AnswerSeeder::class);
    }
}
