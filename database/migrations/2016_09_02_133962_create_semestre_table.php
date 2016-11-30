<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemestreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::connection('mysql')->create('semestres', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('desc', 100);
        });

    }

    public function down()
    {
        Schema::drop('semestres');
    }

}
