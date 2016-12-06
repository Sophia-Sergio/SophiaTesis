<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;

class LikePost extends Model
{
    protected $table = 'like_post';

    public function addLike($userId, $postId) {

        $like = new LikePost();
        $like->user_id = $userId;
        $like->post_ramo_id = $postId;

    }

    public function remoeLike($userId, $postId) {

        $like = LikeFiles::get()
            ->where('users_id', $userId)
            ->where('post_ramo_id', $postId)
            ->delete()
        ;
    }


}