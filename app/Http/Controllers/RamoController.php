<?php

namespace Sophia\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
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
        Session::forget('ramo');

        $id_usuario = Auth::user()->id;

        $posteosRamo = $ramo->getPost(Auth::user()->getCareers()->id, $id_ramo);

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
            'comentarioRamoPosts' => $comentarioRamoPosts,
            'urd'   =>  $id_usuario_ramo_docente->id
        ]);
    }

    /**
     * Vista de los archivos de un ramo
     *
     * @param $idRamo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contenido($idRamo)
    {
        $data = UsuarioRamoDocente::getByRamoAndUser($idRamo, Auth::user()->id);
        $ramo = Ramo::find($idRamo);

        $archivosPublicos = $ramo->getArchivosPublicos($data->id_docente);
        $archivosPrivados = $ramo->byUrd($data->id_usuario_ramo_docente);

        return view("ramo.contenido", [
            'archivos_publicos' =>  $archivosPublicos,
            'archivos_privados' =>  $archivosPrivados,
            'ramo'              =>  $ramo,
            'data'              =>  $data
        ]);

    }
}
