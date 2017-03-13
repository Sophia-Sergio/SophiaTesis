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
            \Sophia\Regimen::firstOrCreate(array( 'descripcion' => 'Diurno'));
            \Sophia\Regimen::firstOrCreate(array( 'descripcion' => 'Vespertino'));
            \Sophia\Regimen::firstOrCreate(array( 'descripcion' => 'Online'));
        }

}
