<?php

namespace Sophia\Http\Controllers\Api;

use Illuminate\Http\Request;
use Sophia\Http\Controllers\Controller;
use Sophia\Http\Requests\Api\AssignRamo;
use Sophia\UsuarioRamoDocente;

class RamoController extends Controller
{
    public function assign(AssignRamo $request)
    {
        $user   =   $request->user;
        $ramos  =   $request->ramos;
        $assign =   false;

        foreach ($ramos as $ramo) {
            $check = UsuarioRamoDocente::where([
                ['id_usuario', '=', $user],
                ['id_ramo_docente', '=', $ramo]
            ])->get();

            if ($check->isEmpty()) {
                $assign = true;
                UsuarioRamoDocente::create([
                    'id_usuario' => $user,
                    'id_ramo_docente' => $ramo
                ]);
            }
        }

        return response()->json([
           'status' => $assign
        ]);
    }
}
