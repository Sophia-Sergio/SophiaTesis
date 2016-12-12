<?php

namespace Sophia\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use Sophia\Http\Requests;
use Sophia\Ramo;
use Sophia\File;
use Sophia\Docente;
use Sophia\UsuarioRamoDocente;
use Illuminate\Support\Facades\DB;


class RamoController extends Controller
{
    public function index($id_ramo)
    {
        $ramo = Ramo::find($id_ramo);
        Session::put('ramo', $ramo);
        $id_carrera = Session::get('carrera')->id_carrera;
        $id_usuario = Session::get('user')->id;

        $posteosRamo = $ramo->getPost($id_carrera, $id_ramo);

        $comentarioRamoPosts =  DB::table('comentarios')
            ->join('post_ramos', 'comentarios.id_post_ramo', '=', 'post_ramos.id')
            ->join('users', 'comentarios.id_usuario', '=', 'users.id')
            ->select('users.nombre','users.apellido','comentarios.contenido', 'comentarios.created_at', 'comentarios.id_post_carrera', 'comentarios.id_post_ramo')
            ->distinct()
            ->get();

        $id_usuario_ramo_docente = DB::table('usuario_ramo_docentes')
            ->join('ramo_docentes', 'id_ramo_docente', '=', 'ramo_docentes.id')
            ->select('usuario_ramo_docentes.id')
            ->where('id_ramo', $id_ramo)
            ->where('id_usuario', $id_usuario)
            ->distinct()
            ->first();


        $id_docente = DB::table('usuario_ramo_docentes')
            ->join('ramo_docentes', 'id_ramo_docente', '=', 'ramo_docentes.id')
            ->select('ramo_docentes.id_docente')
            ->where('id_ramo', $id_ramo)
            ->where('id_usuario', $id_usuario)
            ->distinct()
            ->first();

        Session::put('id_docente', $id_docente);
        $_id_docente = Session::get('id_docente')->id_docente;
        $docente = Docente::find($_id_docente);
        Session::put('id_usuario_ramo_docente', $id_usuario_ramo_docente);
        Session::put('docente', $docente);




        return view("ramo.muro", [
            'ramo' => $ramo,
            'posteosRamos' => $posteosRamo,
            'comentarioRamoPosts' => $comentarioRamoPosts
        ]);
    }

    public function contenido($id_ramo)
    {
        $id_usuario = Session::get('user')->id;
        $id_usuario_ramo_docente = DB::table('usuario_ramo_docentes')
            ->join('ramo_docentes', 'id_ramo_docente', '=', 'ramo_docentes.id')
            ->select('usuario_ramo_docentes.id')
            ->where('id_ramo', $id_ramo)
            ->where('id_usuario', $id_usuario)
            ->distinct()
            ->first();

        $id_docente = DB::table('usuario_ramo_docentes')
            ->join('ramo_docentes', 'id_ramo_docente', '=', 'ramo_docentes.id')
            ->select('ramo_docentes.id_docente', 'usuario_ramo_docentes.id_ramo_docente')
            ->where('id_ramo', $id_ramo)
            ->where('id_usuario', $id_usuario)
            ->distinct()
            ->first();

        Session::put('id_docente', $id_docente);
        $_id_docente = Session::get('id_docente')->id_docente;


        /**
         * Publicos
         */

        Session::put('id_usuario_ramo_docente', $id_usuario_ramo_docente);
        $docente = Docente::find($_id_docente);
        Session::put('docente', $docente);

        $ramo = Ramo::find($id_ramo);
        Session::put('ramo', $ramo);
        $id_usuario_ramo_docente = Session::get('id_usuario_ramo_docente')->id;


        $archivosPublicos = $ramo->getArchivosPublicos($_id_docente);

        // No es sólo archivos privados, son públicos y privados del usuario conectado
        $archivosPrivados = $ramo->getArchivosPrivados($id_usuario_ramo_docente);

        return view("ramo.contenido", [
            'archivos_publicos' => $archivosPublicos,
            'archivos_privados' => $archivosPrivados,
            'ramo' => $ramo
        ]);

    }



}
