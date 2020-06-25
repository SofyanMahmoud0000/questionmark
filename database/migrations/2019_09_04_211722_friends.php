<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Friends extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger("followed_id");
            $table->foreign("followed_id")->references("id")->on("users")->onDelete("cascade");

            $table->unsignedBigInteger("following_id");
            $table->foreign("following_id")->references("id")->on("users")->onDelete("cascade");

            // $table->primary(['followed_id','following_id']);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('friends');
    }
}
