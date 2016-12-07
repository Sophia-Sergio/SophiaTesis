<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    protected $fillable = [
        'nombre', 'apellido', 'email', 'password', 'fecha_nacimiento', 'edad', 'estado', 'reintentos'
    ];

    public function findOrCreateByEmail()
    {

    }

    public function getFullName()
    {
        return ucfirst($this->nombre) . ' ' . ucfirst($this->apellido);
    }

    public static function getAvatar($id)
    {
        $noAvatar = URL::to('img/man_avatar.jpg');

        // Set Avatar
        $fromProvider = OauthIdentity::where('user_id', $id)->first();

        if (Storage::disk('local')->has( $id . '.jpg')) {
            $avatar = route('profile.image', ['filename' => $id . '.jpg']);
        }elseif (isset($fromProvider->avatar) && !empty($fromProvider->avatar)){
            $avatar = $fromProvider->avatar;
        } else {
            $avatar = $noAvatar;
        }

        return $avatar;
    }
}
