<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioPasswordHistoricosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql')->create('usuario_password_historicos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
                        $table->string('password',250);
                        $table->integer('id_usuario')->unsigned();
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
		Schema::drop('usuario_password_historicos');
	}

}
