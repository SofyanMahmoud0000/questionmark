<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("email",50)->unique();
            $table->string("name");
            $table->string("password");
            $table->string("username");
            $table->boolean("confirmed")->default(0);
            $table->string("image");
            $table->string("cover")->nullable();
            $table->boolean("can_change_password")->default(0);
            $table->integer("followings")->default(0);
            $table->integer("followers")->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
