<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Sophia\PostRamo;
use Session;

class Ramo extends Model
{
    public function getArchivosPublicos($_id_docente) {
        $id_user = Session::get('user')->id;

        $archivos_publicos = File::join('usuario_ramo_docentes', 'id_usuario_ramo_docente', '=', 'usuario_ramo_docentes.id')
            ->join('ramo_docentes', 'id_ramo_docente', '=', 'ramo_docentes.id')
            ->join('users', 'id_usuario', '=', 'users.id')
            ->select(
                \DB::raw(
                    'ramo_docentes.id_docente, ramo_docentes.id_ramo, files.*, users.nombre, users.apellido,
                    CASE type
                        WHEN 1 then "Prueba"
                        WHEN 2 then "Tarea o Trabajo"
                        WHEN 3 then "Apunte"
                        WHEN 4 then "Tesis"
                        END AS type'
                )
            )
            ->where('id_ramo', $this->id)
            ->where('id_docente', $_id_docente)
            ->where('seguridad', 1)
            ->distinct()
            ->get();

        foreach($archivos_publicos as $file) {
            $file->n_like = $file->likes()->count();
            $file->is_like = $file->isLikeUer($id_user);
        }

        return $archivos_publicos;
    }

    public function getArchivosPrivados($id_usuario_ramo_docente) {
        $files = File::where('id_usuario_ramo_docente',$id_usuario_ramo_docente)
            ->select(
                \DB::raw(
                    'id, created_at, updated_at, name, dir, size, extension, seguridad, id_usuario_ramo_docente,
                    CASE type
                        WHEN 1 then "Prueba"
                        WHEN 2 then "Tarea o Trabajo"
                        WHEN 3 then "Apunte"
                        WHEN 4 then "Tesis"
                        END AS type'
                )
            )
            ->whereIn('seguridad', [1, 2])
            ->get();

        return $files;
    }


    public function getPost ($id_carrera, $id_ramo) {
        $id_user = Session::get('user')->id;

        $posteosRamo = PostRamo::join('carreras', 'id_carrera', '=', 'carreras.id')
            ->select('id_carrera', 'contenido', 'id_user',  'post_ramos.id', 'nombre_carrera', 'nombre', 'apellido', 'post_ramos.created_at')
            ->join('users', 'id_user', '=', 'users.id')
            ->join('usuario_ramo_docentes', 'id_usuario_ramo_docente', '=', 'usuario_ramo_docentes.id')
            ->join('ramo_docentes', 'usuario_ramo_docentes.id_ramo_docente', '=', 'ramo_docentes.id')
            ->where('id_carrera', $id_carrera)
            ->where('ramo_docentes.id_ramo', $this->id)
            ->where('post_ramos.estado', '=', 1)
            ->distinct()
            ->orderBy('created_at', 'desc')
            ->get();

//        dd($posteosRamo);

        foreach($posteosRamo as $post) {
            $post->n_like = $post->likes()->count();

            $post->n_like_str = $post->n_like;
            if($post->n_like == 1) {
                $post->n_like_str .= ' persona';
            } else {
                $post->n_like_str .= ' personas';
            }

            $post->is_like = $post->isLikeUer($id_user);
        }

        return $posteosRamo;
    }
}
