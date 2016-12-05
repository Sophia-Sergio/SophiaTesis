<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $fillable = [
        'nombre_institucion', 'id_tipo_institucion'
    ];
}
