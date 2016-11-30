<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql')->create('perfils', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
            $table->string('codigo_perfil',20);
            $table->string('descripcion_perfil',50);
			$table->string('estado_perfil',20);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('perfils');
	}

}
