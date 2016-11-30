<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRamoDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('ramo_docentes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('id_ramo')->unsigned();
            $table->integer('id_docente')->unsigned();
            $table->integer('id_regimen')->unsigned();
            $table->foreign('id_ramo')->references('id')->on('ramos');
            $table->foreign('id_docente')->references('id')->on('docentes');
            $table->foreign('id_regimen')->references('id')->on('regimens');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ramo_docentes');
    }
}
