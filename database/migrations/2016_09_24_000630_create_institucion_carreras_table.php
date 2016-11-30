<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitucionCarrerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::connection('mysql')->create('institucion_carreras', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('id_institucion')->unsigned();
            $table->integer('id_carrera')->unsigned();
            $table->integer('id_regimen')->unsigned();
            $table->foreign('id_institucion')->references('id')->on('institucions');
            $table->foreign('id_carrera')->references('id')->on('carreras');
            $table->foreign('id_regimen')->references('id')->on('regimens');
        });

    }

        public function down()
    {
        Schema::drop('institucion_carreras');

        // creamos las tabla instuticion
    }

}
