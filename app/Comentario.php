<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    public static function getByCareer($career)
    {
        return Comentario::join('post_carreras as pc', 'comentarios.id_post_carrera', '=', 'pc.id')
            ->join('users as u', 'comentarios.id_usuario', '=', 'u.id')
            ->where('pc.id_carrera', $career)
            ->select('u.nombre','u.apellido','comentarios.contenido', 'comentarios.created_at', 'comentarios.id_post_carrera', 'comentarios.id_post_ramo')
            ->distinct()
            ->get();
    }
}
