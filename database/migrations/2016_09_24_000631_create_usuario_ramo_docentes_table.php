<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioRamoDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('usuario_ramo_docentes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_usuario')->unsigned();
            $table->integer('id_ramo_docente')->unsigned();
            $table->timestamps();

            $table->foreign('id_usuario')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('id_ramo_docente')
                ->references('id')->on('ramo_docentes')
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
        Schema::dropIfExists('usuario_ramo_docentes');
    }
}
