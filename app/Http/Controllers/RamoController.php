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

        $posteosRamo = DB::table('post_ramos')
            ->join('carreras', 'id_carrera', '=', 'carreras.id')
            ->join('users', 'id_user', '=', 'users.id')
            ->join('usuario_ramo_docentes', 'id_user', '=', 'usuario_ramo_docentes.id_usuario')
            ->join('ramo_docentes', 'usuario_ramo_docentes.id_ramo_docente', '=', 'ramo_docentes.id')
            ->select('id_carrera', 'contenido', 'id_user',  'post_ramos.id', 'nombre_carrera', 'nombre', 'post_ramos.created_at')
            ->where('id_carrera', $id_carrera)
            ->where('ramo_docentes.id_ramo', $id_ramo)
            ->where('post_ramos.estado', '=', 1)
            ->distinct()
            ->orderBy('created_at', 'desc')
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
        Session::put('posteosRamo', $posteosRamo);
        Session::put('docente', $docente);




        return view("ramo.muro", ['ramo'=>$ramo]);
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


        $ramo_docente = DB::table('files')
            ->join('usuario_ramo_docentes', 'id_usuario_ramo_docente', '=', 'usuario_ramo_docentes.id')
            ->join('ramo_docentes', 'id_ramo_docente', '=', 'ramo_docentes.id')
            ->join('users', 'id_usuario', '=', 'users.id')
            ->select('ramo_docentes.id_docente', 'ramo_docentes.id_ramo', 'files.*', 'files.id as file_id', 'users.*')
            ->where('id_ramo', $id_ramo)
            ->where('id_docente', $_id_docente)
            ->where('seguridad', 1)
            ->distinct()
            ->get();


        Session::put('id_usuario_ramo_docente', $id_usuario_ramo_docente);

        $docente = Docente::find($_id_docente);
        Session::put('docente', $docente);

        $ramo = Ramo::find($id_ramo);
        Session::put('ramo', $ramo);


        Session::put('ramo_docenteFiles', $ramo_docente);

        $id_usuario_ramo_docente = Session::get('id_usuario_ramo_docente')->id;
        $usuario_ramo_docenteFiles = File::where('id_usuario_ramo_docente', $id_usuario_ramo_docente)
            ->where('seguridad', 2)
            ->get();


        Session::put('usuario_ramo_docenteFiles', $usuario_ramo_docenteFiles);

        return view("ramo.contenido");

    }



}
