<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegimenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::connection('mysql')->create('regimens', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('descripcion', 100);
        });

    }

    public function down()
    {
        Schema::drop('regimens');
    }

}
