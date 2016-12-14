<?php

use Illuminate\Database\Seeder;



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UsuarioRamoDocentesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
        public function run()
        {
        \DB::table('usuario_ramo_docentes')->insertGetId(array('id_usuario' => 1, 'id_ramo_docente' => 1));
        \DB::table('usuario_ramo_docentes')->insertGetId(array('id_usuario' => 1, 'id_ramo_docente' => 2));
        \DB::table('usuario_ramo_docentes')->insertGetId(array('id_usuario' => 1, 'id_ramo_docente' => 5));
        \DB::table('usuario_ramo_docentes')->insertGetId(array('id_usuario' => 1, 'id_ramo_docente' => 6));
        \DB::table('usuario_ramo_docentes')->insertGetId(array('id_usuario' => 1, 'id_ramo_docente' => 7));
        \DB::table('usuario_ramo_docentes')->insertGetId(array('id_usuario' => 1, 'id_ramo_docente' => 8));
        \DB::table('usuario_ramo_docentes')->insertGetId(array('id_usuario' => 1, 'id_ramo_docente' => 9));
        \DB::table('usuario_ramo_docentes')->insertGetId(array('id_usuario' => 1, 'id_ramo_docente' => 10));

        }

}
