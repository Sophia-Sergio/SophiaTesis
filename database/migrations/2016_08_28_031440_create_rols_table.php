<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql')->create('rols', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
                        $table->string('codigo_rol',20);
                        $table->string('descripcion_rol',50);
                        $table->integer('id_modulo')->unsigned();
                        $table->foreign('id_modulo')->references('id')->on('modulos');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rols');
	}

}
