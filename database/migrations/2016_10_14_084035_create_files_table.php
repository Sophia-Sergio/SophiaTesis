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

            $table->string('name');
            $table->string('dir');
            $table->integer('size');
            $table->string('extension', 5);
            $table->integer('seguridad');
            $table->integer('id_usuario_ramo_docente')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('deleted_reason')->nullable();
            $table->string('deleted_desc')->nullable();

            $table->foreign('id_usuario_ramo_docente')
                ->references('id')->on('usuario_ramo_docentes')
                ->onDelete('cascade');
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
