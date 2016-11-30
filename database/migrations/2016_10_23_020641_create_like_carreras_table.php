<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikeCarrerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('like_carreras', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('id_post_carrera')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->boolean('like');
            $table->foreign('id_post_carrera')->references('id')->on('post_carreras');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('like_carreras');
    }
}
