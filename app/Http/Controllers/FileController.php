<?php

namespace Sophia\Http\Controllers;

use Illuminate\Http\Request;
use Sophia\File;
use Sophia\Http\Requests;
use Session;
use Sophia\UsuarioRamoDocente;
use Sophia\Ramo;
use Sophia\LikeFiles;
use Illuminate\Support\Facades\DB;
class FileController extends Controller
{
    public function upload(){
        $file = \Request::file('document');

        $seguridad_id = \Request::all()['seguridad_id'];

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
        if ($file_->save())
        {
            $file->move($storagePath, $file_->id);
            $message = "Archivo guardado";
        };
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
            ->get()
        ;

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
}
