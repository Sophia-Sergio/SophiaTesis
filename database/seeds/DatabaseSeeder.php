<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
	    Model::unguard();

        /* CGG:
        cuando se agrega una nueva class aca se debe correr el comando
        composer dump-autoload
        o sino no toma las clases
        */

        $this->call('InstitucionsTableSeeder');
        $this->call('CarrerasTableSeeder');
        $this->call('RegimenTableSeeder');
        $this->call('InstitucionCarrerasTableSeeder');
        $this->call('RamosTableSeeder');
        $this->call('SemestresTableSeeder');
        $this->call('CarreraRamosTableSeeder');


        $this->call('PerfilsTableSeeder');

        $this->call('DocentesTableSeeder');
        $this->call('RamoDocentesTableSeeder');
        $this->call('UsuarioRamoDocentesTableSeeder');

        $this->call('UsuariosTableSeeder');

        $this->call('FilesTableSeeder');

        /*
        $this->call('AdministradorTableSeeder');
        $this->call('ModulosTableSeeder');
        */
	}
}
