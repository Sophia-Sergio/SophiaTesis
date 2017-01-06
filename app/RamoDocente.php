<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;

class RamoDocente extends Model
{
    /**
     * Obtener información según un listado de ramos
     *
     * @param $ramos
     * @return mixed
     */
    public static function getByRamos($ramos)
    {
        return RamoDocente::join('ramos', 'ramo_docentes.id_ramo', '=', 'ramos.id')
            ->join('docentes', 'ramo_docentes.id_docente', '=', 'docentes.id')
            ->select('ramo_docentes.id','id_ramo','id_docente', 'id_regimen', 'nombre_ramo', 'nombre', 'apellido_paterno', 'apellido_materno')
            ->whereIn('ramo_docentes.id_ramo', $ramos)
            ->get();
    }
}
