<?php

use Illuminate\Database\Seeder;

class FilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $urd    =   \Sophia\UsuarioRamoDocente::first();

        \Sophia\File::firstOrCreate([
            'client_name' => '17190866_10211939867630465_7013220152621975354_n.jpg',
            'dir' => 'documentos/privados/ingenieria-en-computacion-e-informatica/matematica-ii/valencia-godoy-cecilia',
            'size' => '50078',
            'extension' => 'jpg',
            'seguridad' => 1,
            'id_usuario_ramo_docente' => $urd->id,
            'type' => 1,
            'file_name' => '161489171674.jpg',
            'name' => 'Mi Primer Archivo',
            'description' => 'Este es el primer que subo a la plataforma de Sophia, espero sea útil para todos'
        ]);
    }
}
