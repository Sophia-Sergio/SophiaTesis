<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Sophia\UsersSeguidos;

class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    protected $fillable = [
        'nombre', 'apellido', 'email', 'password', 'fecha_nacimiento', 'edad', 'estado', 'reintentos'
    ];

    public function userSeguidos () {
        return $this->hasMany('Sophia\UsersSeguidos');
    }

    public function getArrayIdsUserSeguidos () {
        $users = $this->userSeguidos;
        $response = array();
        foreach ($users as $user) {
            $response[] = $user->user_seguido_id;
        }

        return $response;
    }

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

    public function addSeguirUser($user_seguido_id) {
        $siguendo = new UsersSeguidos();
        $siguendo->user_id = $this->id;
        $siguendo->user_seguido_id = $user_seguido_id;
        $siguendo->save();
    }

    public function deleteSeguirUser($user_seguido_id) {
        UsersSeguidos::where('user_id', $this->id)
            ->where('user_seguido_id', $user_seguido_id)
            ->delete();
    }
}
