<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikePostCarreraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('like_post_carrera', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_carrera_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('post_carrera_id')->references('id')->on('post_carreras');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('like_post_carrera');
    }
}
