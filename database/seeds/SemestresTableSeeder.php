<?php

use Illuminate\Database\Seeder;


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SemestresTableSeeder extends Seeder{
    public function run()
    {
        
        //agregamos usuario administrador
        \DB::table('semestres')->insertGetId(array('desc'=> '1er Semestre',));
        \DB::table('semestres')->insertGetId(array('desc'=> '2do Semestre',));
        \DB::table('semestres')->insertGetId(array('desc'=> '3ro Semestre',));
        \DB::table('semestres')->insertGetId(array('desc'=> '4to Semestre',));
        \DB::table('semestres')->insertGetId(array('desc'=> '5to Semestre',));
        \DB::table('semestres')->insertGetId(array('desc'=> '5to Semestre',));
        \DB::table('semestres')->insertGetId(array('desc'=> '7mo Semestre',));
        \DB::table('semestres')->insertGetId(array('desc'=> '8vo Semestre',));
        \DB::table('semestres')->insertGetId(array('desc'=> '9no Semestre',));
        \DB::table('semestres')->insertGetId(array('desc'=> '10mo Semestre',));
        \DB::table('semestres')->insertGetId(array('desc'=> '11avo Semestre',));
        \DB::table('semestres')->insertGetId(array('desc'=> '12avo Semestre',));
        

    }
            
}