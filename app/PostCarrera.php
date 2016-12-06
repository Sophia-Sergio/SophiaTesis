<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;

class PostCarrera extends Model
{
    public function likes() {
        return $this->hasMany('Sophia\LikePostCarrera');
    }


    public function isLikeUer ($idUser) {

        $actuales = LikePostCarrera::where('post_carrera_id', $this->id)
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
