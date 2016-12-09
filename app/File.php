<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{

    protected $casts = [
        'seen' => 'array'
    ];

    public function usuarioRamoDocente()
    {
        return $this->belongsTo('Sophia\UsuarioRamoDocente', 'id_usuario_ramo_docente');
    }

    public function likes() {
        return $this->hasMany('Sophia\LikeFiles');
    }

    public function isLikeUer ($idUser) {

        $actuales = LikeFiles::where('file_id', $this->id)
            ->where('user_id', $idUser)
            ->get()
        ;

        if(count($actuales) > 0) {
            return true;
        } else {
            return false;
        }
    }
}
