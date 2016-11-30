<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilModulosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql')->create('perfil_modulos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
                        $table->integer('id_modulo')->unsigned();
                        $table->integer('id_perfil')->unsigned();
                        $table->foreign('id_modulo')->references('id')->on('modulos');
                        $table->foreign('id_perfil')->references('id')->on('perfils');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('perfil_modulos');
	}

}
