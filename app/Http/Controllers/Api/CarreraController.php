<?php

namespace Sophia\Http\Controllers\Api;

use Illuminate\Http\Request;
use Sophia\Carrera;
use Sophia\Http\Controllers\Controller;

class CarreraController extends Controller
{
    /**
     * Obtener ramos de carrera dado un año
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function ramos(Request $request, $id)
    {
        $ramos = Carrera::ramos($id, $request->year);
        return response()->json($ramos);
    }
}
