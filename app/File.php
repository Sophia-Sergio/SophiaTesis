<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public function usuarioRamoDocente()
    {
        return $this->belongsTo('Sophia\UsuarioRamoDocente', 'id_usuario_ramo_docente');
    }

    public function likes() {
        return $this->hasMany('Sophia\LikeFiles');
    }
}
