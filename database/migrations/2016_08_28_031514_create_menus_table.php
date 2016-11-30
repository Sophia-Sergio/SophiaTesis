<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('mysql')->create('menus', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
                        $table->string('nombre_menu',50);
                        $table->string('link_menu',250);
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
		Schema::drop('menus');
	}

}
