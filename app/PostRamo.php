<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;
use Sophia\LikePost;

class PostRamo extends Model
{
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
