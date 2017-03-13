<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;

class UsuarioRamoDocente extends Model
{
    protected $fillable = ['id_usuario', 'id_ramo_docente'];

    public function postRamos()
    {
        return $this->hasMany('Sophia\PostRamo');
    }

    public function files()
    {
        return $this->hasMany('Sophia\File', 'id_usuario_ramo_docente');
    }

    public static function getByRamoAndUser($ramo, $user)
    {
        return UsuarioRamoDocente::join('ramo_docentes', 'id_ramo_docente', '=', 'ramo_docentes.id')
            ->select(
                'usuario_ramo_docentes.id as id_usuario_ramo_docente',
                'ramo_docentes.id_docente',
                'usuario_ramo_docentes.id_ramo_docente')
            ->where('id_ramo', $ramo)
            ->where('id_usuario', $user)
            ->distinct()
            ->first();
    }

}
