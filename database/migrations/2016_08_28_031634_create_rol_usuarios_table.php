<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolUsuariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql')->create('rol_usuarios', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
                        $table->integer('id_rol')->unsigned();
                        $table->integer('id_usuario')->unsigned();
                        $table->foreign('id_rol')->references('id')->on('rols');
                        $table->foreign('id_usuario')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rol_usuarios');
	}

}
