<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    
    public function run()
    {
        $Create = ([
            "name"=>"Admin 1" ,
            "password"=>"publicpassword" ,
            "username"=>"admin1"
            ]);

        Admin::create($Create);
    }
}
