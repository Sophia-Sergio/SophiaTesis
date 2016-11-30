<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitucionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('institucions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre_institucion', 255);
            $table->string('nombre_institucion_html', 255);
            $table->string('nombre_institucion_no_tilde', 255);
            $table->integer('id_tipo_institucion')->unsigned();
            $table->foreign('id_tipo_institucion')->references('id')->on('tipo_institucions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institucions');
    }
}
