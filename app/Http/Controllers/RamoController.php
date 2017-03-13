<?php

namespace Sophia\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Session;
use Sophia\Carrera;
use Sophia\CarreraRamo;
use Sophia\Http\Requests;
use Sophia\PostRamo;
use Sophia\Ramo;
use Sophia\File;
use Sophia\Docente;
use Sophia\UsuarioRamoDocente;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;


class RamoController extends Controller
{
    public function index()
    {
        $file = File::first();

        return view('file.delete', compact('file'));
        //return view('file.edit', compact('file'));
        //return view('file.show', compact('file'));

        //return view('layout.partials.upload_file');

        //return view('ramo.index');
    }

    public function assign()
    {
        // TODO cuando existan más carrera, se debe modificar
        $idCarrera = 1;
        $idInstitution = 1;

        $ramos = Carrera::ramos($idCarrera);

        // Cantidad de ramos de la carrera
        $qRamos = CarreraRamo::select(\DB::raw('DISTINCT(id_semestre)'))
            ->where([
                ['id_carrera', '=', $idCarrera],
                ['id_institucion', '=', $idInstitution]
            ])->orderBy('id_semestre')
            ->get();

        return view('ramo.assign', compact('ramos', 'qRamos'));
    }

    /**
     * Dashboard del ramo
     *
     * @param $id_ramo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard($id_ramo)
    {
        $ramo = Ramo::find($id_ramo);

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
