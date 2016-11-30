<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostCarrerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_carreras', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text('contenido');
            $table->integer('id_user')->unsigned();
            $table->integer('id_carrera')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_carrera')->references('id')->on('carreras');
            $table->integer('estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_carreras');
    }
}
