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

      // Seeds Sistema
      $this->call('InstitucionsTableSeeder');
      $this->call('SemestresTableSeeder');
      $this->call('CarrerasTableSeeder');
      $this->call('DocentesTableSeeder');
      $this->call('RegimenTableSeeder');
      $this->call('PerfilsTableSeeder');
      $this->call('UsuariosTableSeeder');
      $this->call('RamosTableSeeder');
      $this->call('RamoDocentesTableSeeder');
      $this->call('CarreraRamosTableSeeder');
      $this->call('InstitucionCarrerasTableSeeder');
      $this->call('UsuarioRamoDocentesTableSeeder');
      $this->call('AdministradorTableSeeder');
      $this->call('ModulosTableSeeder');
	}
}
