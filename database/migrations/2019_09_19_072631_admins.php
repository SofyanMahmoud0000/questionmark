<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Admins extends Migration
{
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("name");
            $table->string("password");
            $table->string("username")->unique();
            $table->timestamps();
            $table->integer("ActivatedLastTime")->default(0);
            $table->integer("DeactivatedLastTime")->default(0);

        });
    }

    
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
