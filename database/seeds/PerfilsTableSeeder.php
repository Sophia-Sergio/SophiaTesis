<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


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
        \Sophia\Perfil::firstOrCreate([
            'codigo_perfil'         =>  'ADM',
            'descripcion_perfil'    =>  'Administrador',
            'estado_perfil'         =>  'ACTIVO',
        ]);

        //perfil usuario
        \Sophia\Perfil::firstOrCreate([
            'codigo_perfil'         =>  'EST',
            'descripcion_perfil'    =>  'Estudiante',
            'estado_perfil'         =>  'ACTIVO',
        ]);

        \Sophia\Perfil::firstOrCreate([
            'codigo_perfil'         =>  'ADMEST',
            'descripcion_perfil'    =>  'Adm. Estudiante',
            'estado_perfil'         =>  'ACTIVO',
        ]);
    }
}
