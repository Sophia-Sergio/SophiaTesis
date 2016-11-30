<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostRamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_ramos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text('contenido');
            $table->integer('id_user')->unsigned();
            $table->integer('id_carrera')->unsigned();
            $table->integer('id_usuario_ramo_docente')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_carrera')->references('id')->on('carreras');
            $table->foreign('id_usuario_ramo_docente')->references('id')->on('usuario_ramo_docentes');
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
        Schema::dropIfExists('post_ramos');
    }
}
