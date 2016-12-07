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
}
