<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Sophia\PostCarrera;
use Session;

class Carrera extends Model
{
    protected $fillable = [
        'nombre_carrera'
    ];

    public function getPost() {
        $id_user = Session::get('user')->id;

        $posteosCarrera = PostCarrera::join('carreras', 'id_carrera', '=', 'carreras.id')
            ->join('users', 'id_user', '=', 'users.id')
            ->select('id_carrera', 'contenido', 'id_user',  'post_carreras.id', 'nombre_carrera', 'nombre', 'apellido', 'post_carreras.created_at')
            ->where('id_carrera', $this->id)
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

            $post->is_like = $post->isLikeUer($id_user);
        }


        return $posteosCarrera;
    }


    public function getElementoSeguidores( $user_id ) {

        $carrera_id = $this->id;

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
                where users_seguidos.user_id = ".$user_id."
                and post_ramos.estado = 1
                and usuario_ramo_docentes.id_ramo_docente in (
                    select usuario_ramo_docentes.id_ramo_docente from usuario_ramo_docentes
                    where usuario_ramo_docentes.id_usuario = ".$user_id."
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
                    carreras.nombre_carrera as 'nom_lugar',
                    'publicacion_carrera' as 'tipo_elemento'
                from post_carreras
                inner join users_seguidos
                on users_seguidos.user_seguido_id = post_carreras.id_user
                inner join users
                on users.id = users_seguidos.user_seguido_id
                inner join carreras
                on carreras.id = post_carreras.id_carrera
                where users_seguidos.user_id = ".$user_id."
                and post_carreras.estado = 1
                and post_carreras.id_carrera = ".$carrera_id."

                ) union (


                select
                    files.id as 'id',
                    files.created_at as 'created_at',
                    files.updated_at, files.name as 'contenido',
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
                    where usuario_ramo_docentes.id_usuario = ".$user_id."
                )
                and usuario_ramo_docentes.id_usuario != ".$user_id."

            )
            order by created_at desc
            limit 10
        ");

        foreach($data as $dato) {
        }


        return $data;

    }

}
