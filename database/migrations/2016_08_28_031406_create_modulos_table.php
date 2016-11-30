<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql')->create('modulos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
            $table->string('codigo_modulo',20);
            $table->string('descripcion_modulo',50);
            $table->string('estado_modulo',20);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('modulos');
	}

}
