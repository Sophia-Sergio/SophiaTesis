<?php

namespace Sophia\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Sophia\File;
use Sophia\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sophia\UsuarioRamoDocente;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Se crea filter para no tener que crear un nuevo IF
        if (empty($request->filter)) {
            $filter = [1,2,3,4,5,6];
        } else {
            $filter = explode(",", $request->filter);
        }

        if (!empty($request->text)) {
            $files = File::where([
                ['id_usuario_ramo_docente', '=', 1],
                ['seguridad', '=', 1]
            ])->where(function ($query) use ($request) {
                $query->where('client_name', 'like', "%{$request->text}%")
                    ->orWhere('id_usuario_ramo_docente', 'like', "%{$request->text}%");
            })->whereIn('type', $filter)
                ->orderBy($request->by, $request->order)
                ->paginate(3);
        } else {
            $files = File::where([
                ['id_usuario_ramo_docente', '=', 1],
                ['seguridad', '=', 1]
            ])->whereIn('type', $filter)
                ->orderBy($request->by, $request->order)
                ->paginate(3);
        }

        return $files;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
