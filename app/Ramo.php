<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Session;

class Ramo extends Model
{
    public function getArchivosPublicos($_id_docente) {
        $id_user = Session::get('user')->id;

        $archivos_publicos = File::join('usuario_ramo_docentes', 'id_usuario_ramo_docente', '=', 'usuario_ramo_docentes.id')
            ->join('ramo_docentes', 'id_ramo_docente', '=', 'ramo_docentes.id')
            ->join('users', 'id_usuario', '=', 'users.id')
            ->select('ramo_docentes.id_docente', 'ramo_docentes.id_ramo', 'files.*', 'users.nombre', 'users.apellido')
            ->where('id_ramo', $this->id)
            ->where('id_docente', $_id_docente)
            ->where('seguridad', 1)
            ->distinct()
            ->get();

        foreach($archivos_publicos as $file) {
            $file->n_like = $file->likes()->count();
            $file->is_like = $file->isLikeUer($id_user);
        }

        return $archivos_publicos;
    }

    public function getArchivosPrivados($id_usuario_ramo_docente) {
        $archivos_privados = File::where('id_usuario_ramo_docente',$id_usuario_ramo_docente)
            ->whereIn('seguridad', [1, 2])
            ->get();

        return $archivos_privados;
    }
}
