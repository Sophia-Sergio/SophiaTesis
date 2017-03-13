<?php

namespace Sophia\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Sophia\Docente;
use Sophia\File;
use Sophia\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sophia\Http\Requests\Api\StoreFile;
use Sophia\Ramo;
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
     * Subir un archivo
     *
     * @param StoreFile $request
     * @return \Illuminate\Http\Response
     */
    public function create(StoreFile $request)
    {
        if (!$request->ajax()) {
            abort(403, 'Unauthorized action.');
        }

        $file       =   $request->file('document');
        $ramo       =   Ramo::find($request->ramo);
        $career     =   Auth::user()->getCareers();
        $teacher    =   Docente::find($request->teacher);

        $teacherName = str_slug("{$teacher->apellido_paterno} {$teacher->apellido_materno} {$teacher->nombre}");

        try {
            File::saveFile(
                $file,
                str_slug($career->name),
                str_slug($ramo->nombre_ramo),
                $teacherName,
                $request->usuarioRamoDocente,
                $request->security,
                $request->type
            );

            return response()->json(['success'], 200);
        } catch (\Exception $e) {
            return response()->json([$e], 500);
        }
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
        $file   =   File::find($id);
        $path   =   storage_path("app/{$file->dir}/{$file->file_name}");

        return response()->download($path, $file->client_name);
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
        $file = File::where('id', $id)
            ->update([
                'name' => $request->name,
                'seguridad' => $request->security,
                'id_usuario_ramo_docente' => $request->usuarioRamoDocente,
                'type' => $request->type,
                'description' => $request->description
            ]);

        if($file) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        File::where('id', $id)
            ->update([
                'deleted_reason' => $request->reason,
                'deleted_desc' => $request->desc
            ]);

        File::destroy($id);
    }
}
