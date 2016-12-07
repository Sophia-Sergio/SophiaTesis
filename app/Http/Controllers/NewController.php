<?php

namespace Sophia\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Sophia\PostRamo;
use Sophia\RamoDocente;
use Sophia\UsuarioRamoDocente;

class NewController extends Controller
{
    public function index($ramo)
    {
        $startWeek = Carbon::now()->startOfWeek();
        $endWeek = Carbon::now()->endOfWeek();

        $usuarioRamoDocente = UsuarioRamoDocente::join('ramo_docentes', 'usuario_ramo_docentes.id_ramo_docente', '=', 'ramo_docentes.id')
            ->join('post_ramos', 'post_ramos.id_usuario_ramo_docente', '=', 'usuario_ramo_docentes.id')
            ->where('ramo_docentes.id_ramo', $ramo)
            ->first()->id_usuario_ramo_docente;

        $posts = PostRamo::where('id_usuario_ramo_docente', $usuarioRamoDocente)
            ->join('like_post', 'like_post.post_ramo_id', '=', 'post_ramos.id')
            ->whereBetween('like_post.created_at', [$startWeek, $endWeek])
            ->orderBy('like_post.created_at', 'desc')
            ->limit(3)
            ->get();

        return view('new.index', compact('posts'));
    }
}
