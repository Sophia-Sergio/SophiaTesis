<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;

class LikePostCarrera extends Model
{
    protected $table = 'like_post_carrera';

    public function addLike($userId, $postId) {

        $like = new LikePostCarrera();
        $like->user_id = $userId;
        $like->post_carrera_id = $postId;

    }

    public function remoeLike($userId, $postId) {

        $like = LikeFiles::get()
            ->where('users_id', $userId)
            ->where('post_carrera_id', $postId)
            ->delete()
        ;
    }


}