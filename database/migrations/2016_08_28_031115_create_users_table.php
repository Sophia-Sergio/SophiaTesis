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
            $table->string('nombre',100);
            $table->string('apellido',100);
            $table->string('username', 100)->nullable();
            $table->string('slug', 100)->nullable();
            $table->string('email',250);
            $table->string('password',250);
            $table->date('fecha_nacimiento');
            $table->integer('edad');
            $table->integer('estado')->default(1);
            $table->integer('reintentos')->default(0);
            $table->string('avatar', 100)->nullable();
            //$table->string('api_token', 60)->default(str_random(60))->unique();
            $table->timestamps();
            $table->rememberToken();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
