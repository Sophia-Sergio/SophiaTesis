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
        \Sophia\Semestre::firstOrCreate(array('desc'=> '1er Semestre',));
        \Sophia\Semestre::firstOrCreate(array('desc'=> '2do Semestre',));
        \Sophia\Semestre::firstOrCreate(array('desc'=> '3ro Semestre',));
        \Sophia\Semestre::firstOrCreate(array('desc'=> '4to Semestre',));
        \Sophia\Semestre::firstOrCreate(array('desc'=> '5to Semestre',));
        \Sophia\Semestre::firstOrCreate(array('desc'=> '5to Semestre',));
        \Sophia\Semestre::firstOrCreate(array('desc'=> '7mo Semestre',));
        \Sophia\Semestre::firstOrCreate(array('desc'=> '8vo Semestre',));
        \Sophia\Semestre::firstOrCreate(array('desc'=> '9no Semestre',));
        \Sophia\Semestre::firstOrCreate(array('desc'=> '10mo Semestre',));
        \Sophia\Semestre::firstOrCreate(array('desc'=> '11avo Semestre',));
        \Sophia\Semestre::firstOrCreate(array('desc'=> '12avo Semestre',));
        

    }
            
}