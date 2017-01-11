<?php

namespace Sophia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Sophia\Docente;
use Sophia\File;
use Sophia\Http\Requests;
use Session;
use Sophia\UsuarioRamoDocente;
use Sophia\Ramo;
use Sophia\LikeFiles;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Facades\Datatables;

class FileController extends Controller
{
    /**
     * Subir un archivo a la plataforma
     *
     * @param Requests\StoreContentFile $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Requests\StoreContentFile $request)
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
     * Descargar un archivo
     *
     * @param $idArchivo
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * @internal param $id_archivo
     */
    public function download($idArchivo)
    {
        $file   =   File::find($idArchivo);
        $path   =   storage_path("app/{$file->dir}/{$file->file_name}");

        return response()->download($path, $file->client_name);
    }

    /**
     * Dar like a un archivo
     *
     * @param $id_archivo
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleLike($id_archivo)
    {
        $id_user = Auth::user()->id;
        $file = File::find($id_archivo);

        $actuales = LikeFiles::where('file_id', $id_archivo)
            ->where('user_id', $id_user)
            ->get();

        if(count($actuales) > 0) {
            foreach($actuales as $actual) {
                $actual->delete();
            }
        } else {
            $nuevoLike = new LikeFiles();
            $nuevoLike->file_id = $id_archivo;
            $nuevoLike->user_id = $id_user;
            $nuevoLike->save();
        }
        $totalLikes = $file->likes()->count();
        return response()->json([
            'totalLikes' => $totalLikes
        ]);
    }

    /**
     * Eliminar archivo
     *
     * Se elimina archivo tanto de la base de datos como del servidor,
     * Además, se deben eliminar los likes asociados a dicho archivo.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        LikeFiles::where('file_id', $id)->delete();

        $file   =   File::find($id);

        Storage::delete("$file->dir/$file->file_name");
        $file->delete();

        return response()->json(['status' => 1], 200);
    }

    /**
     * Generar tabla para archivos privados
     *
     * @param Request $request
     * @return mixed
     */
    public function privateTable(Request $request, $idRamo)
    {
        $getData = UsuarioRamoDocente::getByRamoAndUser($idRamo, Auth::user()->id);
        $idUsuarioRamoDocente = $getData->id_usuario_ramo_docente;

        $ramo = Ramo::find($idRamo);

        $files = $ramo->byUrd($idUsuarioRamoDocente);

        return Datatables::of($files)
            ->filterColumn('files.id', function($query, $keyword) {
                $query->whereRaw("files.id) like ?", ["%{$keyword}%"]);
            })
            ->editColumn('client_name', function ($file) {
                return "<a href='/download/{$file->id}'>{$file->client_name}</a>";
            })
            ->addColumn('action', function ($file) {
                return '<a href="#" id="remove-'.$file->id.'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i> Eliminar</a>';
            })
            ->make(true);

        return $datatables->make(true);
    }

    /**
     * Generar tabla para archivos públicos
     *
     * @param Request $request
     * @param $idRamo
     * @return mixed
     */
    public function publicTable(Request $request, $idRamo)
    {
        $getData = UsuarioRamoDocente::getByRamoAndUser($idRamo, Auth::user()->id);
        $idUsuarioRamoDocente = $getData->id;
        $idDocente = $getData->id_docente;

        $ramo = Ramo::find($idRamo);

        $files = $ramo->getArchivosPublicos($idDocente);

        return Datatables::of($files)
            ->editColumn('name', function ($file) {
                return "<a href='/download/{$file->id}'>{$file->client_name}</a>";
            })
            ->editColumn('nombre', function ($file) {
                return "{$file->nombre} {$file->apellido}";
            })
            ->addColumn('action', function ($file) {
                $statusLike = ($file->is_like) ?  'like like_active glyphicon glyphicon-thumbs-up' : 'like glyphicon glyphicon-thumbs-up';
                return "<span id='{$file->id}_cont' class='{$file->id}_cont badge badge_like'>{$file->n_like}</span>
                    <span id='like-{$file->id}' class='like-{$file->id} {$statusLike}'></span>";
            })
            ->make(true);

        return $datatables->make(true);
    }

    /**
     * Listar archivos no vistos
     *
     * @return array
     */
    public function notSeen()
    {
        $output = [];

        $postData = UsuarioRamoDocente::join('ramo_docentes', 'usuario_ramo_docentes.id_ramo_docente', '=', 'ramo_docentes.id')
            //->join('post_ramos', 'post_ramos.id_usuario_ramo_docente', '=', 'usuario_ramo_docentes.id')
            ->join('usuario_ramo_docentes as urm', 'urm.id_ramo_docente', '=', 'ramo_docentes.id')
            ->where('urm.id_usuario', Auth::user()->id)
            //->first();
            ->get();

        if(empty($postData)) {
            return $output;
        }

        $ramos = [];

        foreach($postData as $data) {
            array_push($ramos, $data->id_ramo);
        }

        $files = UsuarioRamoDocente::join('files', 'files.id_usuario_ramo_docente', '=', 'usuario_ramo_docentes.id')
            ->join('users', 'users.id', '=','usuario_ramo_docentes.id_usuario')
            ->join('ramo_docentes', 'ramo_docentes.id', '=','usuario_ramo_docentes.id_ramo_docente')
            ->select('files.*', 'users.nombre', 'users.apellido','ramo_docentes.id_ramo')
            ->where('files.seguridad', 1)
            ->where('users.id', '<>', Auth::user()->id)
            //->where('usuario_ramo_docentes.id', $postData->id_usuario_ramo_docente)
            ->whereIn('id_ramo', $ramos)
            ->orderBy('files.created_at', 'desc')
            ->get();

        if (empty($postData)) {
            return $output;
        }

        foreach ($files as $file) {

            if(!is_null($file->seen)) {
                $users = json_decode($file->seen, true);

                if(!array_key_exists(Auth::user()->id, $users)) {
                    array_push($output, $file);
                }
            } else {
                array_push($output, $file);
            }
        }

        return $output;
    }

    /**
     * Marcar como leída las notificaciones de archivos
     *
     * @param $idRamo
     * @param $idUsuarioRamoDocente
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAsSeen($idRamo, $idUsuarioRamoDocente)
    {
        $me = Auth::user()->id;

        $files = File::where('id_usuario_ramo_docente', $idUsuarioRamoDocente)->get();

        foreach ($files as $file) {

            if(is_null($file->seen) || !array_key_exists($me, $file->seen)) {
                $user = $file->seen;
                $user[$me] = $me;
                $file->seen = $user;
                $file->save();
            }
        }

        return redirect()->route('ramo.contenido', ['ramo' => $idRamo]);
    }
}
