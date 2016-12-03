<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name',255);
            $table->string('dir',255);
            $table->integer('size');
            $table->string('extension',5);
            $table->integer('seguridad');
            $table->integer('id_usuario_ramo_docente')->unsigned();
            $table->foreign('id_usuario_ramo_docente')->references('id')->on('usuario_ramo_docentes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
