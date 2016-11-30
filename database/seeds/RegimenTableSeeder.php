<?php

use Illuminate\Database\Seeder;



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RegimenTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
        public function run()
        {
        \DB::table('regimens')->insertGetId(array( 'descripcion' => 'Diurno'));
        \DB::table('regimens')->insertGetId(array( 'descripcion' => 'Vespertino'));
        \DB::table('regimens')->insertGetId(array( 'descripcion' => 'Online'));
        }

}
