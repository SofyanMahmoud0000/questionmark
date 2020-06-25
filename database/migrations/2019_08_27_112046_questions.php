<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Questions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger("asker_id");
            $table->foreign("asker_id")->references("id")->on("users")->onDelete("cascade");

            $table->unsignedBigInteger("replier_id");
            $table->foreign("replier_id")->references("id")->on("users")->onDelete("cascade");

            $table->longText("content");
            
            $table->integer("likes")->default(0);

            $table->boolean("has_answer")->default(0);

            $table->boolean("anonymous")->default(1);

            $table->boolean("read")->default(0);

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
        Schema::dropIfExists('questions');
    }
}
