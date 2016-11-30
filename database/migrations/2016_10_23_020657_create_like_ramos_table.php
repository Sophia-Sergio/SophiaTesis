<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikeRamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('like_ramos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('id_post_ramo')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->boolean('like');
            $table->foreign('id_post_ramo')->references('id')->on('post_ramos');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('like_ramos');
    }
}
