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

        $profile = \Sophia\Perfil::where('codigo_perfil', 'EST')->first();

        for ($i=0; $i<=2; $i++) {

            if ($i==0) {
                $firstName  =   'Nicolás';
                $lastName   =   'Ormeño';
                $email      =   'nicolas@sophia.cl';
            } elseif ($i==1) {
                $firstName  =   'Sergio';
                $lastName   =   'Ramos';
                $email      =   'sergio@sophia.cl';
            } else {
                $firstName  =   'Andrés';
                $lastName   =   'Román';
                $email      =   'andres@sophia.cl';
            }

            $checkUsr = \Sophia\User::where('slug', str_slug("$firstName $lastName"))->get();

            if (!count($checkUsr)) {
                $user = \Sophia\User::firstOrCreate([
                    'nombre'            =>  $firstName,
                    'apellido'          =>  $lastName,
                    'username'          =>  str_slug("$firstName $lastName"),
                    'slug'              =>  str_slug("$firstName $lastName"),
                    'email'             =>  $email,
                    'password'          =>  \Hash::make('123456'),
                    'fecha_nacimiento'  =>  $faker->date($format = 'Y-m-d', $max = 'now') ,
                    'edad'              =>  $faker->numberBetween($min = 1, $max = 120),
                ]);

                // Perfil de Usuario
                \Sophia\Usuario_Perfil::firstOrCreate([
                    'id_usuario'    =>  $user->id,
                    'id_perfil'     =>  $profile->id,
                ]);
            }
        }
    }
}
