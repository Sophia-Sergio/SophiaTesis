<?php

namespace Sophia\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Sophia\File;
use Sophia\PostRamo;
use Sophia\RamoDocente;
use Sophia\UsuarioRamoDocente;

class NewController extends Controller
{
    public function index($ramo)
    {

        $startWeek = Carbon::now()->startOfWeek();
        $endWeek = Carbon::now()->endOfWeek();

        $postData = UsuarioRamoDocente::join('ramo_docentes', 'usuario_ramo_docentes.id_ramo_docente', '=', 'ramo_docentes.id')
            ->join('post_ramos', 'post_ramos.id_usuario_ramo_docente', '=', 'usuario_ramo_docentes.id')
            ->where('ramo_docentes.id_ramo', $ramo)
            ->first();

        if(empty($postData)) {
            return view('new.index');
        }

        $postsWithLikes = PostRamo::where('id_usuario_ramo_docente', $postData->id_usuario_ramo_docente)
            ->join('like_post', 'like_post.post_ramo_id', '=', 'post_ramos.id')
            ->orderBy('like_post.created_at', 'desc')
            ->limit(3)
            ->get();
        //dd($postData);
        $posts = (isset($postsWithLikes)) ? $postsWithLikes : [];

        $files = UsuarioRamoDocente::join('files', 'files.id_usuario_ramo_docente', '=', 'usuario_ramo_docentes.id')
            ->join('users', 'users.id', '=','usuario_ramo_docentes.id_usuario')
            ->select('files.*', 'files.id as id_file','users.id', 'users.nombre', 'users.apellido')
            ->where('files.seguridad', 1)
            ->where('usuario_ramo_docentes.id', $postData->id_usuario_ramo_docente)
            ->orderBy('files.created_at', 'desc')
            ->limit(3)
            ->get();

        //dd($files);

        return view('new.index', compact('posts', 'files'));
    }
}
