<?php

namespace Sophia\Http\Controllers;

use Illuminate\Http\Request;
use Sophia\File;
use Sophia\Http\Requests;
use Session;
use Sophia\UsuarioRamoDocente;
use Sophia\Ramo;
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

        $file->move($storagePath, $fileName);

        $file_ = new File();
        $file_->dir = $storagePath;
        $file_->id_usuario_ramo_docente = $id_usuario_ramo_docente;
        $file_->size = $fileSize;
        $file_->name = $fileName;
        $file_->extension = $fileType;
        $file_->seguridad = $seguridad_id;
        if ($file_->save())
        {
            $message = "Archivo guardado";
        };
        //return $file->move($storagePath, $fileName);
        //return redirect()->action('RamoController@contenido', ['ramo' => $id_ramo])->with(['message_positivo' => $message]);


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
        $url = trim($file->dir).'/'.$file->name;
        return response()->download($url);
    }
}
