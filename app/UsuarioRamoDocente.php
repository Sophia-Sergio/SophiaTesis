<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;

class UsuarioRamoDocente extends Model
{


    public function files()
    {
        return $this->hasMany('Sophia\File');
    }

    public static function getByRamoAndUser($ramo, $user)
    {
        return UsuarioRamoDocente::join('ramo_docentes', 'id_ramo_docente', '=', 'ramo_docentes.id')
            ->select('usuario_ramo_docentes.id','ramo_docentes.id_docente', 'usuario_ramo_docentes.id_ramo_docente')
            ->where('id_ramo', $ramo)
            ->where('id_usuario', $user)
            ->distinct()
            ->first();
    }

}
