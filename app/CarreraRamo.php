<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;

class CarreraRamo extends Model
{
    /**
     * Listado de ramos según una carrera
     *
     * @param $carrera
     * @return mixed
     */
    public static function getByCareer($career)
    {
        return CarreraRamo::join('ramos', 'carrera_ramos.id_ramo', '=', 'ramos.id')
            ->select('id_ramo', 'nombre_ramo', 'nombre_ramo_html', 'id_semestre')
            ->where('carrera_ramos.id_carrera', '=', $career)
            ->distinct()
            ->orderBy('nombre_ramo')
            ->get();
    }

    /**
     * Número de semestres
     *
     * @param $career
     * @param $year
     * @return mixed
     */
    public static function getNumberOfSemesters($career, $year)
    {
        return CarreraRamo::select('id_semestre')
            ->where('id_carrera', $career)
            ->where('anio', $year)
            ->max('id_semestre');
    }

}
