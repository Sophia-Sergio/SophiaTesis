<?php

namespace Sophia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function upload(){
        $file = \Request::file('document');

        $seguridad_id = \Request::all()['seguridad_id'];
        $type = \Request::all()['type'];

        $id_user = Session::get('user')->id;
        $id_usuario_ramo_docente = Session::get('id_usuario_ramo_docente')->id;
        $nombre_carrera = Session::get('carrera')->nombre_carrera_no_tilde;
        $nombre_ramo = Session::get('ramo')->nombre_ramo_no_tilde;
        $id_ramo = Session::get('ramo')->id;
        $nombre_docente = Session::get('docente')->apellido_paterno_no_tilde.'_'.Session::get('docente')->apellido_materno_no_tilde.'_'.Session::get('docente')->nombre_no_tilde; //Session::get('docente')->nombre_docente;

        $storagePath = storage_path().'/documentos/privados/'.$nombre_carrera.'/'.$nombre_ramo.'/'.$nombre_docente;

        $fileName = $file->getClientOriginalName();
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $fileSize = $file->getClientSize();


        $file_ = new File();
        $file_->dir = $storagePath;
        $file_->id_usuario_ramo_docente = $id_usuario_ramo_docente;
        $file_->size = $fileSize;
        $file_->name = $fileName;
        $file_->extension = $fileType;
        $file_->seguridad = $seguridad_id;
        $file_->type = $type;

        if ($file_->save())
        {
            $file->move($storagePath, $file_->id);
            $message = "Archivo guardado";
        }
        /**
         * Retornamos los archivos para poder mostrarlos
         */

        $_id_docente = Session::get('id_docente')->id_docente;

        $ramo = Ramo::find($id_ramo);
        $archivosPublicos = $ramo->getArchivosPublicos($_id_docente);
        $archivosPrivados = $ramo->getArchivosPrivados($id_usuario_ramo_docente);

        return response()->json([
            'publicos' => $archivosPublicos,
            'privados' => $archivosPrivados
        ]);
    }

    public function download($id_archivo) {
        $file = File::find($id_archivo);
        $url = trim($file->dir).'/'.$file->id;
        return response()->download($url,$file->name);
    }


    public function toggleLike($id_archivo) {

        $id_user = Session::get('user')->id;
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

    public function destroy($id)
    {
        // Eliminar likes del archivo
        LikeFiles::where('file_id', $id)->delete();

        // Eliminar archivos
        File::find($id)->delete();

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
        $idUsuarioRamoDocente = $getData->id;
        $idDocente = $getData->id_docente;

        $ramo = Ramo::find($idRamo);

        $files = $ramo->getArchivosPrivados($idUsuarioRamoDocente);

        return Datatables::of($files)
            ->filterColumn('files.id', function($query, $keyword) {
                $query->whereRaw("files.id) like ?", ["%{$keyword}%"]);
            })
            ->editColumn('name', function ($file) {
                return "<a href='/download/{$file->id}'>{$file->name}</a>";
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
                return "<a href='/download/{$file->id}'>{$file->name}</a>";
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
