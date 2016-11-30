<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql')->create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
            $table->string('nombre',100);
            $table->string('apellido',100);
            $table->string('email',250);
            $table->string('password',250);
            $table->date('fecha_nacimiento');
            $table->integer('edad');
            $table->integer('estado');
            //$table->date('fecha_expiracion');
            $table->integer('reintentos');
            //$table->string('pregunta_secreta',250);
            //$table->string('respuesta_secreta',250);
            //$table->string('pais',50);
            $table->rememberToken();                  
                        
		});
	}



	/*ACTUALIZAR TABLA SE UTILIZA!!!!!

	public function up()
	{
		Schema::table('users', function()
		{
			$table->string('cambio', 80);
		});
	}
	*/
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuarios');
	}

}
