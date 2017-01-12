<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Sophia\LikePost;

class PostRamo extends Model
{
    protected $fillable = ['contenido', 'id_user', 'id_carrera', 'id_usuario_ramo_docente', 'estado'];

    public function users()
    {
        return $this->hasOne('Sophia\User', 'id', 'id_user');
    }

    public function carreras()
    {
        return $this->hasOne('Sophia\Carrera', 'id', 'id_carrera');
    }

    public function usuarioRamoDocentes()
    {
        return $this->hasOne('Sophia\UsuarioRamoDocente', 'id', 'id_usuario_ramo_docente');
    }

    public function likes()
    {
        return $this->hasMany('Sophia\LikePost');
    }

    /**
     * Verificar si el usuario ha hecho like en post
     *
     * @param $idUser
     * @return bool
     */
    public function isLikeUser ($idUser)
    {
        $actuales = LikePost::where('post_ramo_id', $this->id)
            ->where('user_id', $idUser)
            ->get();

        if(count($actuales) > 0) {
            return true;
        } else {
            return false;
        }
    }
}
