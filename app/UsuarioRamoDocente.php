<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;

class UsuarioRamoDocente extends Model
{


    public function files()
    {
        return $this->hasMany('Sophia\File');
    }



}
