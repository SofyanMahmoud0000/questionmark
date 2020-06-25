<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSedder extends Seeder
{
    
    public function run()
    {
        $Create = ([
            "email"=>"admin@yahoo.com" ,
            "name"=>"admin" ,
            "password"=>"password" ,
            "username"=>"adminadmin"
            ]);

        Admin::create($Create);
    }
}
