<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;

class Usuario_Perfil extends Model
{
    protected $table = 'usuario_perfils';

    protected $fillable = [
        'id_usuario', 'id_perfil'
    ];
}
