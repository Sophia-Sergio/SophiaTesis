<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogAccesosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql')->create('log_accesos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
                        $table->integer('id_usuario')->unsigned();
                        $table->datetime('fecha_y_hora_acceso');
                        $table->string('descripcion_accion');
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
		Schema::drop('log_accesos');
	}

}
