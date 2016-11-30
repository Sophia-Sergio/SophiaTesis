<?php

use Illuminate\Database\Seeder;


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AdministradorTableSeeder extends Seeder{
    public function run()
    {
        
        //agregamos usuario administrador
        $id = \DB::table('users')->insertGetId(array(
            'nombre'            => 'Admin',
            'apellido'          => 'istrador',
            'email'             => 'carlos.gonzalez.gavilan@gmail.com',
            'password'          => \Hash::make('secret'),
            'fecha_nacimiento'  => '19850302',
            'edad'              => 31,
            'estado'            => 1,
            //'fecha_registro'    => date('Y-m-d'),
            //'fecha_expiracion'  => date ( 'Y-m-j' ,strtotime( '+365 day' , strtotime ( date('Y-m-j') ) )),
            'reintentos'        => 0,
            //'pregunta_secreta'  => 'Hola como estas',
            //'respuesta_secreta' => 'bien y tu',
            //'pais'              => 'Chile'
        ));
        
        //agregamos relacion usuario perfil administrador
        

        \DB::table('usuario_perfils')->insert(array(
            'id_usuario'        => $id,
            'id_perfil'         => 1 //codigo_perfil administrador
        ));

        /*
        //crea usuarios en BD sistemas
        \DB::connection('mysql')->table('usuario_sistemas')->insert(array(
           'id'                => $id
        ));
         */
    }
            
}