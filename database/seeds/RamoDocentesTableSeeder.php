<?php

use Illuminate\Database\Seeder;



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RamoDocentesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
    {
        $ramos      =   \Sophia\Ramo::all();
        $docentes   =   \Sophia\Docente::all();

        foreach ($ramos as $ramo) {
            foreach ($docentes as $docente) {
                \Sophia\RamoDocente::firstOrCreate([
                    'id_ramo' => $ramo->id,
                    'id_docente' => $docente->id,
                    'id_regimen' => 2
                ]);
            }
        }

        /*\DB::table('ramo_docentes')->insertGetId(array('id_ramo' => 1, 'id_docente' => 1, 'id_regimen' => 2));
        \DB::table('ramo_docentes')->insertGetId(array('id_ramo' => 37, 'id_docente' => 1, 'id_regimen' => 2));
        \DB::table('ramo_docentes')->insertGetId(array('id_ramo' => 31, 'id_docente' => 1, 'id_regimen' => 2));
        \DB::table('ramo_docentes')->insertGetId(array('id_ramo' => 35, 'id_docente' => 2, 'id_regimen' => 2));
        \DB::table('ramo_docentes')->insertGetId(array('id_ramo' => 6, 'id_docente' => 3, 'id_regimen' => 2));
        \DB::table('ramo_docentes')->insertGetId(array('id_ramo' => 12, 'id_docente' => 3, 'id_regimen' => 2));
        \DB::table('ramo_docentes')->insertGetId(array('id_ramo' => 18, 'id_docente' => 3, 'id_regimen' => 2));
        \DB::table('ramo_docentes')->insertGetId(array('id_ramo' => 24, 'id_docente' => 3, 'id_regimen' => 2));
        \DB::table('ramo_docentes')->insertGetId(array('id_ramo' => 30, 'id_docente' => 3, 'id_regimen' => 2));
        \DB::table('ramo_docentes')->insertGetId(array('id_ramo' => 7, 'id_docente' => 41, 'id_regimen' => 2));*/
    }
}
