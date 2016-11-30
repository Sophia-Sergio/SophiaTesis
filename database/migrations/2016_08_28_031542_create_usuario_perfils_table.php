<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioPerfilsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql')->create('usuario_perfils', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
                        $table->integer('id_usuario')->unsigned();
                        $table->integer('id_perfil')->unsigned();
                        $table->foreign('id_usuario')->references('id')->on('users');
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
		Schema::drop('usuario_perfils');
	}

}
