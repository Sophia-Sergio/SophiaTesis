<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UsuariosTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
        public function run()
        {
            
            $faker = Faker::create();    
        
            //seteamos cantidad de usuarios random a crear
            for($i= 0;$i < 50;$i ++)
            {
                $id = \DB::table('users')->insertGetId(array(
                    'nombre'            => $faker->firstName,
                    'apellido'          => $faker->lastName,
                    'email'             => $faker->unique()->email,
                    'password'          => \Hash::make('123456'),
                    'fecha_nacimiento'  => $faker->date($format = 'Y-m-d', $max = 'now') ,
                    'edad'              => $faker->numberBetween($min = 1, $max = 120),
                    'estado'            => 1,
                    //'fecha_expiracion'  => date ( 'Y-m-j' ,strtotime( '+365 day' , strtotime ( date('Y-m-j') ) )),
                    'reintentos'        => 0,
                    //'pregunta_secreta' => 'Hola como estas',
                    //'respuesta_secreta' => 'bien y tu',
                    //'pais'              => $faker->country
                ));
            
                //perfil usuario
                \DB::table('usuario_perfils')->insert(array(
                    'id_usuario'        => $id,
                    'id_perfil'         => 2
                    ));
                /*
                //crea usuarios en BD sistemas
                \DB::connection('mysql')->table('usuario_sistemas')->insert(array(
                    'id'                => $id
                    ));
                */
            }
        }

}
