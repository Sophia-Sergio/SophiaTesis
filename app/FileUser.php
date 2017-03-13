<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;

class FileUser extends Model
{
    public $timestamps = false;

    protected $table = 'file_user';
    protected $fillable = ['user_id', 'file_id', 'downloaded', 'shared', 'rating', 'favorite'];
}
