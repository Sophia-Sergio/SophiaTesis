<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Sophia\LikePost;

class PostRamo extends Model
{
    protected $fillable = ['contenido', 'id_user', 'id_carrera', 'id_usuario_ramo_docente', 'estado'];

    /*public function setIdUserAttribute($value)
    {
        $this->attributes['id_user'] =   1;
    }

    public function setIdCarreraAttribute($value)
    {
        $this->attributes['id_carrera'] =   Auth::user()->getCareers();
    }*/

    public function likes() {
        return $this->hasMany('Sophia\LikePost');
    }

    public function isLikeUer ($idUser) {

        $actuales = LikePost::where('post_ramo_id', $this->id)
            ->where('user_id', $idUser)
            ->get()
        ;

        if(count($actuales) > 0) {
            return true;
        } else {
            return false;
        }
    }
}
