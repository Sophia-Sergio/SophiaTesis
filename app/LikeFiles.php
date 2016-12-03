<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;

class LikeFiles extends Model
{

    public function addLike($userId, $fileId) {

        $like = new LikeFiles();
        $like->user_id = $userId;
        $like->file_id = $fileId;

    }

    public function remoeLike($userId, $fileId) {

        $like = LikeFiles::get()
            ->where('users_id', $userId)
            ->where('files_id', $fileId)
            ->delete()
        ;

    }


}