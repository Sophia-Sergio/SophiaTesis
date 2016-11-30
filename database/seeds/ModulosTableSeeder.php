<?php

use Illuminate\Database\Seeder;



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ModulosTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
        public function run()
        {
                //modulo administración de usuarios
                $id = \DB::table('modulos')->insertGetId(array(
                    'codigo_modulo'         => 'MOD001',
                    'descripcion_modulo'    => 'Administración de usuarios',
                    'estado_modulo'         => 'ACTIVO'
                ));
                
                //insertamos relacion perfil modulo
                \DB::table('perfil_modulos')->insert(array(
                    'id_modulo'         => $id,
                    'id_perfil'         => 1 //perfil administrador
                ));
                
                //insertamos roles asociados al modulo
                //rol crear usuarios
                \DB::table('rols')->insert(array(
                    'codigo_rol'         => 'ROL001' ,
                    'descripcion_rol'    => 'Crear usuarios' ,
                    'id_modulo'          => $id
                ));
                
                //rol modificar usuarios
                \DB::table('rols')->insert(array(
                    'codigo_rol'         => 'ROL002' ,
                    'descripcion_rol'    => 'Modificar usuarios' ,
                    'id_modulo'          => $id
                ));
                
                //rol eliminar usuarios
                \DB::table('rols')->insert(array(
                    'codigo_rol'         => 'ROL003' ,
                    'descripcion_rol'    => 'Eliminar usuarios' ,
                    'id_modulo'          => $id
                ));
                
                //rol bloquear y desbloquear usuarios
                \DB::table('rols')->insert(array(
                    'codigo_rol'         => 'ROL004' ,
                    'descripcion_rol'    => 'Bloquear/desbloquear usuarios' ,
                    'id_modulo'          => $id
                ));
                
                //rol resetear contraseñ
                \DB::table('rols')->insert(array(
                    'codigo_rol'         => 'ROL005' ,
                    'descripcion_rol'    => 'Resetear contraseña' ,
                    'id_modulo'          => $id
                ));
                
                //modulo administración de perfiles
                $id = \DB::table('modulos')->insertGetId(array(
                    'codigo_modulo'         => 'MOD002',
                    'descripcion_modulo'    => 'Administración de perfiles',
                    'estado_modulo'         => 'ACTIVO'
                ));
                
                //insertamos relacion perfil modulo
                \DB::table('perfil_modulos')->insert(array(
                    'id_modulo'         => $id,
                    'id_perfil'         => 1 //perfil administrador
                ));
                
                //insertamos los roles relacionados al modulo
                //rol ingresar perfil
                \DB::table('rols')->insert(array(
                    'codigo_rol'         => 'ROL006' ,
                    'descripcion_rol'    => 'Ingresar perfil' ,
                    'id_modulo'          => $id
                ));
                
                //rol modificar perfil
                \DB::table('rols')->insert(array(
                    'codigo_rol'         => 'ROL007' ,
                    'descripcion_rol'    => 'Modificar perfil' ,
                    'id_modulo'          => $id
                ));
                
                //rol eliminar perfil
                \DB::table('rols')->insert(array(
                    'codigo_rol'         => 'ROL008' ,
                    'descripcion_rol'    => 'Eliminar perfil' ,
                    'id_modulo'          => $id
                ));
                
                //modulo administración de modulos
                $id = \DB::table('modulos')->insertGetId(array(
                    'codigo_modulo'         => 'MOD003',
                    'descripcion_modulo'    => 'Administración de modulos',
                    'estado_modulo'         => 'ACTIVO'
                ));
                
                //insertamos relacion perfil modulo
                \DB::table('perfil_modulos')->insert(array(
                    'id_modulo'         => $id,
                    'id_perfil'         => 1 //perfil administrador
                ));
                
                //rol ingresar modulo
                \DB::table('rols')->insert(array(
                    'codigo_rol'         => 'ROL009' ,
                    'descripcion_rol'    => 'Ingresar modulos' ,
                    'id_modulo'          => $id
                ));
                
                //rol modificar modulo
                \DB::table('rols')->insert(array(
                    'codigo_rol'         => 'ROL010' ,
                    'descripcion_rol'    => 'Modificar modulos' ,
                    'id_modulo'          => $id
                ));
                
                //rol eliminar modulo
                \DB::table('rols')->insert(array(
                    'codigo_rol'         => 'ROL011' ,
                    'descripcion_rol'    => 'Eliminar modulos' ,
                    'id_modulo'          => $id
                ));
                
                //modulo administración de roles
                $id = \DB::table('modulos')->insertGetId(array(
                    'codigo_modulo'         => 'MOD004',
                    'descripcion_modulo'    => 'Administración de roles',
                    'estado_modulo'         => 'ACTIVO'
                ));
                
                //insertamos relacion perfil modulo
                \DB::table('perfil_modulos')->insert(array(
                    'id_modulo'         => $id,
                    'id_perfil'         => 1 //perfil administrador
                ));
                
                //rol ingresar roles
                \DB::table('rols')->insert(array(
                    'codigo_rol'         => 'ROL012' ,
                    'descripcion_rol'    => 'Ingresar roles' ,
                    'id_modulo'          => $id
                ));
                
                //rol modificar roles
                \DB::table('rols')->insert(array(
                    'codigo_rol'         => 'ROL013' ,
                    'descripcion_rol'    => 'Modificar roles' ,
                    'id_modulo'          => $id
                ));
                
                //rol eliminar roles
                \DB::table('rols')->insert(array(
                    'codigo_rol'         => 'ROL014' ,
                    'descripcion_rol'    => 'Eliminar roles' ,
                    'id_modulo'          => $id
                ));
                
                //modulo configuracion  personal general
                $id = \DB::table('modulos')->insertGetId(array(
                    'codigo_modulo'         => 'MOD005',
                    'descripcion_modulo'    => 'Configuración personal general',
                    'estado_modulo'         => 'ACTIVO'
                ));
                
                //insertamos relacion perfil modulo
                \DB::table('perfil_modulos')->insert(array(
                    'id_modulo'         => $id,
                    'id_perfil'         => 2 //perfil usuario
                ));
                
                //rol modificar datos
                \DB::table('rols')->insert(array(
                    'codigo_rol'         => 'ROL015' ,
                    'descripcion_rol'    => 'Modificar información' ,
                    'id_modulo'          => $id
                ));
                
                //modulo configuracion  personal seguridad
                $id = \DB::table('modulos')->insertGetId(array(
                    'codigo_modulo'         => 'MOD006',
                    'descripcion_modulo'    => 'Configuración personal seguridad',
                    'estado_modulo'         => 'ACTIVO'
                ));
                
                //insertamos relacion perfil modulo
                \DB::table('perfil_modulos')->insert(array(
                    'id_modulo'         => $id,
                    'id_perfil'         => 2 //perfil usuario
                ));
                
                //modulo configuracion  personal privacidad
                $id = \DB::table('modulos')->insertGetId(array(
                    'codigo_modulo'         => 'MOD007',
                    'descripcion_modulo'    => 'Configuración personal privacidad',
                    'estado_modulo'         => 'ACTIVO'
                ));
                
                //insertamos relacion perfil modulo
                \DB::table('perfil_modulos')->insert(array(
                    'id_modulo'         => $id,
                    'id_perfil'         => 2 //perfil usuario
                ));
                
                //modulo configuracion  personal bloqueos
                $id = \DB::table('modulos')->insertGetId(array(
                    'codigo_modulo'         => 'MOD008',
                    'descripcion_modulo'    => 'Configuración personal bloqueos',
                    'estado_modulo'         => 'ACTIVO'
                ));
                
                //insertamos relacion perfil modulo
                \DB::table('perfil_modulos')->insert(array(
                    'id_modulo'         => $id,
                    'id_perfil'         => 2 //perfil usuario
                ));
                
              //rol Bloquear usuarios
                \DB::table('rols')->insert(array(
                    'codigo_rol'         => 'ROL016' ,
                    'descripcion_rol'    => 'Bloquear usuarios' ,
                    'id_modulo'          => $id
                ));
                
                //modulo configuracion  personal notificaciones
                $id = \DB::table('modulos')->insertGetId(array(
                    'codigo_modulo'         => 'MOD009',
                    'descripcion_modulo'    => 'Configuración personal notificaciones',
                    'estado_modulo'         => 'ACTIVO'
                ));
                
                //insertamos relacion perfil modulo
                \DB::table('perfil_modulos')->insert(array(
                    'id_modulo'         => $id,
                    'id_perfil'         => 2 //perfil usuario
                ));
                
                //modulo solicitudes de amistad o solicitudes de seguidores
                $id = \DB::table('modulos')->insertGetId(array(
                    'codigo_modulo'         => 'MOD010',
                    'descripcion_modulo'    => 'Solicitudes de amistad',
                    'estado_modulo'         => 'ACTIVO'
                ));
                
                //insertamos relacion perfil modulo
                \DB::table('perfil_modulos')->insert(array(
                    'id_modulo'         => $id,
                    'id_perfil'         => 2 //perfil usuario
                ));
                
                //rol Buscar usuarios
                \DB::table('rols')->insert(array(
                    'codigo_rol'         => 'ROL017' ,
                    'descripcion_rol'    => 'Buscar usuarios' ,
                    'id_modulo'          => $id
                ));
                
                //rol agregar usuarios
                \DB::table('rols')->insert(array(
                    'codigo_rol'         => 'ROL018' ,
                    'descripcion_rol'    => 'Agregar usuarios' ,
                    'id_modulo'          => $id
                ));
                
                //modulo mensajes
                $id = \DB::table('modulos')->insertGetId(array(
                    'codigo_modulo'         => 'MOD011',
                    'descripcion_modulo'    => 'Mensajes',
                    'estado_modulo'         => 'ACTIVO'
                ));
                
                //insertamos relacion perfil modulo
                \DB::table('perfil_modulos')->insert(array(
                    'id_modulo'         => $id,
                    'id_perfil'         => 2 //perfil usuario
                ));
                
                //rol nuevo mensaje 
                \DB::table('rols')->insert(array(
                    'codigo_rol'         => 'ROL019' ,
                    'descripcion_rol'    => 'Enviar mensaje a un usuario' ,
                    'id_modulo'          => $id
                ));
                
                //modulo notificaciones
                $id = \DB::table('modulos')->insertGetId(array(
                    'codigo_modulo'         => 'MOD012',
                    'descripcion_modulo'    => 'Notificaciones',
                    'estado_modulo'         => 'ACTIVO'
                ));
                
                //insertamos relacion perfil modulo
                \DB::table('perfil_modulos')->insert(array(
                    'id_modulo'         => $id,
                    'id_perfil'         => 2 //perfil usuario
                ));
                
                //rol ver notificaciones
                \DB::table('rols')->insert(array(
                    'codigo_rol'         => 'ROL020' ,
                    'descripcion_rol'    => 'Ver notificaciones' ,
                    'id_modulo'          => $id
                ));
                
                //modulo perfil personal
                $id = \DB::table('modulos')->insertGetId(array(
                    'codigo_modulo'         => 'MOD013',
                    'descripcion_modulo'    => 'Editar perfil',
                    'estado_modulo'         => 'ACTIVO'
                ));
                
                //insertamos relacion perfil modulo
                \DB::table('perfil_modulos')->insert(array(
                    'id_modulo'         => $id,
                    'id_perfil'         => 2 //perfil usuario
                ));
                
                //rol modificar información de perfil
                \DB::table('rols')->insert(array(
                    'codigo_rol'         => 'ROL021' ,
                    'descripcion_rol'    => 'Modificar información de perfil' ,
                    'id_modulo'          => $id
                ));
                
                
                //modulo ramos
                $id = \DB::table('modulos')->insertGetId(array(
                    'codigo_modulo'         => 'MOD014',
                    'descripcion_modulo'    => 'Mis ramos',
                    'estado_modulo'         => 'ACTIVO'
                ));
                
                //insertamos relacion perfil modulo
                \DB::table('perfil_modulos')->insert(array(
                    'id_modulo'         => $id,
                    'id_perfil'         => 2 //perfil usuario
                ));
                
                //rol ingresar información de ramos
                \DB::table('rols')->insert(array(
                    'codigo_rol'         => 'ROL022' ,
                    'descripcion_rol'    => 'Ingresar información de ramos' ,
                    'id_modulo'          => $id
                ));
                
                //modulo noticias
                $id = \DB::table('modulos')->insertGetId(array(
                    'codigo_modulo'         => 'MOD015',
                    'descripcion_modulo'    => 'Noticias',
                    'estado_modulo'         => 'ACTIVO'
                ));
                
                //insertamos relacion perfil modulo
                \DB::table('perfil_modulos')->insert(array(
                    'id_modulo'         => $id,
                    'id_perfil'         => 2 //perfil usuario
                ));
                
                //rol ver noticias
                \DB::table('rols')->insert(array(
                    'codigo_rol'         => 'ROL023' ,
                    'descripcion_rol'    => 'Ver noticias' ,
                    'id_modulo'          => $id
                ));
                
                //modulo administración de archivos
                $id = \DB::table('modulos')->insertGetId(array(
                    'codigo_modulo'         => 'MOD016',
                    'descripcion_modulo'    => 'Administración de archivos',
                    'estado_modulo'         => 'ACTIVO'
                ));
                
                //insertamos relacion perfil modulo
                \DB::table('perfil_modulos')->insert(array(
                    'id_modulo'         => $id,
                    'id_perfil'         => 2 //perfil usuario
                ));
                
                //rol agregar archivos
                \DB::table('rols')->insert(array(
                    'codigo_rol'         => 'ROL024' ,
                    'descripcion_rol'    => 'Agregar archivos' ,
                    'id_modulo'          => $id
                ));
                
                //rol ver archivos
                \DB::table('rols')->insert(array(
                    'codigo_rol'         => 'ROL025' ,
                    'descripcion_rol'    => 'Ver archivos' ,
                    'id_modulo'          => $id
                ));
                
                //rol compartir archivos
                \DB::table('rols')->insert(array(
                    'codigo_rol'         => 'ROL025' ,
                    'descripcion_rol'    => 'Compartir archivos' ,
                    'id_modulo'          => $id
                ));
                
        }

}
