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

        //dd($postData);
        //echo $postData->id_usuario_ramo_docente;

        $postsWithLikes = PostRamo::where('id_usuario_ramo_docente', $postData->id_usuario_ramo_docente)
            ->join('like_post', 'like_post.post_ramo_id', '=', 'post_ramos.id')
            //->whereBetween('like_post.created_at', [$startWeek, $endWeek])
            ->orderBy('like_post.created_at', 'desc')
            ->limit(3)
            ->get();

        //dd($postsWithLikes);

        $posts = $postsWithLikes;

        $files = UsuarioRamoDocente::join('files', 'files.id_usuario_ramo_docente', '=', 'usuario_ramo_docentes.id')
            ->join('users', 'users.id', '=','usuario_ramo_docentes.id_usuario')
            ->select('files.*', 'users.id', 'users.nombre', 'users.apellido')
            ->where('files.seguridad', 1)
            ->where('usuario_ramo_docentes.id', $postData->id_usuario_ramo_docente)
            ->orderBy('files.created_at', 'desc')
            ->limit(3)
            ->get();

        //dd($files);

        return view('new.index', compact('posts', 'files'));
    }
}