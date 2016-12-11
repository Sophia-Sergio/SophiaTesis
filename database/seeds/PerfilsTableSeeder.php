<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PerfilsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
        public function run()
        {
                //perfil administrador
                \DB::table('perfils')->insert(array(
                    'codigo_perfil'         => 'ADM',
                    'descripcion_perfil'    => 'Administrador',
                    'estado_perfil'         => 'ACTIVO'
                ));
                
                //perfil usuario
                \DB::table('perfils')->insert(array(
                    'codigo_perfil'         => 'EST',
                    'descripcion_perfil'    => 'Estudiante',
                    'estado_perfil'         => 'ACTIVO'
                ));

                \DB::table('perfils')->insert(array(
                    'codigo_perfil'         => 'ADMEST',
                    'descripcion_perfil'    => 'Adm. Estudiante',
                    'estado_perfil'         => 'ACTIVO'
                ));
        }

}
