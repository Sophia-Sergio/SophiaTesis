<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('ramos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre_ramo',100);
            $table->string('nombre_ramo_html', 100);
            $table->string('nombre_ramo_no_tilde', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ramos');
    }
}
