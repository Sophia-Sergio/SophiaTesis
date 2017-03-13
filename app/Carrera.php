<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Sophia\PostCarrera;
use Session;

class Carrera extends Model
{
    protected $fillable = [
        'nombre_carrera'
    ];

    /**
     * Obtener los ramos de una carrera en particular
     *
     * @param $idCarrera
     * @return mixed
     */
    public static function ramos($idCarrera, $year = null)
    {
        // Obtener ramos de carrera
        if ($year) {
            $ramos = CarreraRamo::select('ramos.id as r_id', 'ramos.nombre_ramo as r_name','semestres.id as s_id','semestres.desc as s_name', 'carrera_ramos.anio as cr_year')
                ->join('ramos', 'carrera_ramos.id_ramo', '=', 'ramos.id')
                ->join('semestres', 'carrera_ramos.id_semestre', '=', 'semestres.id')
                ->where('carrera_ramos.id_carrera', $idCarrera)
                ->where('carrera_ramos.anio', $year)
                ->orderBy('semestres.id')
                ->get();
        } else {
            $ramos = CarreraRamo::select('ramos.id as r_id', 'ramos.nombre_ramo as r_name', 'semestres.desc as s_name', 'carrera_ramos.anio as cr_year')
                ->join('ramos', 'carrera_ramos.id_ramo', '=', 'ramos.id')
                ->join('semestres', 'carrera_ramos.id_semestre', '=', 'semestres.id')
                ->where('carrera_ramos.id_carrera', $idCarrera)
                ->orderBy('semestres.id')
                ->get();
        }

        foreach ($ramos as $k => $v) {
            $docentes = RamoDocente::select('ramo_docentes.id as rd_id', 'docentes.id as d_id', \DB::raw('CONCAT(TRIM(nombre), " ", TRIM(apellido_paterno)) AS d_full_name'))
                ->join('docentes', 'ramo_docentes.id_docente', '=', 'docentes.id')
                ->where('id_ramo', $v->r_id)
                ->get();

            if (count($docentes)) {
                $ramos[$k]->docentes = !isset($ramos[$k]->docente) ? [] : $ramos[$k]->docente;
                $ramos[$k]->docentes = $docentes;
            } else {
                unset($ramos[$k]);
            }
        }

        return $ramos;
    }

    /**
     * Obtener post
     *
     * Obtener los post que se han escrito en una carrera específica
     *
     * @param $user
     * @param $career
     * @return mixed
     */
    public static function getPostsByCareer($user, $career)
    {
        $posteosCarrera = PostCarrera::join('carreras', 'id_carrera', '=', 'carreras.id')
            ->join('users', 'id_user', '=', 'users.id')
            ->select('id_carrera', 'contenido', 'id_user',  'post_carreras.id', 'carreras.name', 'nombre', 'apellido', 'post_carreras.created_at')
            ->where('id_carrera', $career)
            ->where('post_carreras.estado', '=', 1)
            ->distinct()
            ->orderBy('created_at', 'desc')
            ->get();

        foreach($posteosCarrera as $post) {
            $post->n_like = $post->likes()->count();

            $post->n_like_str = $post->n_like;
            if($post->n_like == 1) {
                $post->n_like_str .= ' persona';
            } else {
                $post->n_like_str .= ' personas';
            }

            $post->is_like = $post->isLikeUser($user);
        }

        return $posteosCarrera;
    }


    public static function getElementoSeguidores($userId, $careerId)
    {
        $data = DB::select("
            (
                select
                    post_ramos.id as 'id',
                    post_ramos.created_at as 'created_at',
                    post_ramos.updated_at as 'updated_at',
                    post_ramos.contenido as 'contenido',
                    post_ramos.id_user as 'user_id',
                    users.nombre as 'user_nombre',
                    users.apellido as 'user_apellido',
                    post_ramos.id_usuario_ramo_docente as 'id_usuario_ramo_docente',
                    null as 'dir',
                    null as 'size',
                    null as 'extension',
                    null as 'type',
                    ramos.id as 'id_lugar',
                    ramos.nombre_ramo as 'nom_lugar',
                    'publicacion_ramo' as 'tipo_elemento'
                from post_ramos
                inner join users_seguidos
                on users_seguidos.user_seguido_id = post_ramos.id_user
                inner join users
                on users.id = users_seguidos.user_seguido_id
                inner join usuario_ramo_docentes
                on usuario_ramo_docentes.id = post_ramos.id_usuario_ramo_docente
                inner join ramo_docentes
                on ramo_docentes.id = usuario_ramo_docentes.id_ramo_docente
                inner join ramos
                on ramos.id = ramo_docentes.id_ramo
                where users_seguidos.user_id = ".$userId."
                and post_ramos.estado = 1
                and usuario_ramo_docentes.id_ramo_docente in (
                    select usuario_ramo_docentes.id_ramo_docente from usuario_ramo_docentes
                    where usuario_ramo_docentes.id_usuario = ".$userId."
                )

                ) union (

                select
                    post_carreras.id as 'id',
                    post_carreras.created_at as 'created_at',
                    post_carreras.updated_at as 'updated_at',
                    post_carreras.contenido as 'contenido',
                    post_carreras.id_user as 'user_id',
                    users.nombre as 'user_nombre',
                    users.apellido as 'user_apellido',
                    null as 'id_usuario_ramo_docente',
                    null as 'dir',
                    null as 'size',
                    null as 'extension',
                    null as 'type',
                    carreras.id as 'id_lugar',
                    carreras.name as 'nom_lugar',
                    'publicacion_carrera' as 'tipo_elemento'
                from post_carreras
                inner join users_seguidos
                on users_seguidos.user_seguido_id = post_carreras.id_user
                inner join users
                on users.id = users_seguidos.user_seguido_id
                inner join carreras
                on carreras.id = post_carreras.id_carrera
                where users_seguidos.user_id = ".$userId."
                and post_carreras.estado = 1
                and post_carreras.id_carrera = ".$careerId."

                ) union (


                select
                    files.id as 'id',
                    files.created_at as 'created_at',
                    files.updated_at, files.client_name as 'contenido',
                    usuario_ramo_docentes.id_usuario as 'user_id',
                    users.nombre as 'user_nombre',
                    users.apellido as 'user_apellido',
                    usuario_ramo_docentes.id as 'id_usuario_ramo_docente',
                    files.dir as 'dir',
                    files.size as 'size',
                    files.extension as 'extension',
                    files.type as 'type',
                    ramos.id as 'id_lugar',
                    ramos.nombre_ramo as 'nom_lugar',
                    'archivo' as 'tipo_elemento'
                from files
                inner join usuario_ramo_docentes
                on usuario_ramo_docentes.id = files.id_usuario_ramo_docente
                inner join ramo_docentes
                on ramo_docentes.id = usuario_ramo_docentes.id_ramo_docente
                inner join ramos
                on ramos.id = ramo_docentes.id_ramo
                inner join users
                on users.id = usuario_ramo_docentes.id_usuario
                inner join users_seguidos
                on users_seguidos.user_seguido_id = usuario_ramo_docentes.id_usuario
                where files.seguridad = 1
                and usuario_ramo_docentes.id_ramo_docente in (
                    select usuario_ramo_docentes.id_ramo_docente from usuario_ramo_docentes
                    where usuario_ramo_docentes.id_usuario = ".$userId."
                )
                and usuario_ramo_docentes.id_usuario != ".$userId."

            )
            order by created_at desc
            limit 10
        ");

        foreach($data as $dato) {
        }


        return $data;

    }

}
