<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarrerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('carreras', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre_carrera',255);
            $table->string('nombre_carrera_html', 255);
            $table->string('nombre_carrera_no_tilde', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carreras');
    }
}
