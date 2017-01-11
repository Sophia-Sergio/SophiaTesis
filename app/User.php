<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Sophia\UsersSeguidos;

class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    protected $fillable = [
        'nombre', 'apellido', 'email', 'password', 'fecha_nacimiento', 'edad', 'estado', 'reintentos'
    ];

    /**
     * Obtener ramos del usuario
     *
     * @return mixed
     */
    public function getRamos()
    {
        return RamoDocente::join('usuario_ramo_docentes as urd', 'ramo_docentes.id', '=', 'urd.id_ramo_docente')
            ->join('ramos as r', 'r.id', '=', 'ramo_docentes.id_ramo')
            ->select('urd.id as urd_id', 'ramo_docentes.id as rd_id', 'r.id as r_id', 'r.nombre_ramo as r_name')
            ->where('urd.id_usuario', Auth::user()->id)
            ->get();
    }

    /**
     * Obtener carreras a la que pertenece el usuario
     *
     * @return mixed
     */
    public function getCareers()
    {
        $ramos  =   $this->getRamos();
        $ids    =   [];

        foreach ($ramos as $ramo) {
            array_push($ids, $ramo['r_id']);
        }

        return CarreraRamo::join('carreras as c', 'carrera_ramos.id_carrera', '=', 'c.id')
            ->whereIn('id_ramo', $ids)
            ->select('c.id', 'c.nombre_carrera as name', 'c.nombre_carrera_html as html_name', 'c.nombre_carrera_no_tilde as accent_name')
            ->distinct()
            ->first();
    }

    /**
     * Obtener perfil del usuario
     *
     * @return mixed
     */
    public function getProfile()
    {
        return User::join('usuario_perfils', 'usuario_perfils.id_usuario', '=', 'users.id')
            ->where('usuario_perfils.id_usuario', '=', Auth::user()->id)
            ->select('id_perfil as id')
            ->distinct()
            ->first();
    }

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
