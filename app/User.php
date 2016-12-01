<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    protected $fillable = [
        'nombre', 'apellido', 'email', 'password', 'fecha_nacimiento', 'edad', 'estado', 'reintentos'
    ];

    public function findOrCreateByEmail()
    {

    }
}
