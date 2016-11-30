<?php

namespace Sophia\Http\Controllers;

use Illuminate\Http\Request;

use Sophia\Http\Requests;
use Sophia\PostCarrera;
use Sophia\PostRamo;
use Session;

class PostController extends Controller
{
    public function postCreatePostCarrera(Request $request){
        //Validación
        $this->validate($request, [
            'contenido' => 'required|max:1000',
        ]);

        //guardado de datos
        $id_carrera = Session::get('carrera')->id_carrera;
        $id_user = Session::get('user')->id;
        $postCarrera = new PostCarrera();
        $postCarrera->contenido = $request['contenido'];
        $postCarrera->id_carrera = $id_carrera;
        $postCarrera->id_user= $id_user;
        $postCarrera->estado= 1;

        $postCarrera->save();
        return redirect()->route('dashboard');
    }
    public function deletePostCarrera($id_posteo){
        $postCarrera = PostCarrera::where('id', $id_posteo)->first();
        $postCarrera->estado=0;
        $postCarrera->save();
        return redirect()->route('dashboard');
    }


    public function postCreatePostRamo(Request $request){
        //Validación
        $this->validate($request, [
            'contenido' => 'required|max:1000',
        ]);

        //guardado de datos
        $id_carrera = Session::get('carrera')->id_carrera;
        $id_user = Session::get('user')->id;



        $postRamo = new PostRamo();
        $postRamo->contenido = $request['contenido'];
        $postRamo->id_carrera = $id_carrera;
        $postRamo->id_user= $id_user;
        $postRamo->estado= 1;
        $postRamo->id_usuario_ramo_docente = Session::get('id_usuario_ramo_docente')->id;
        $postRamo->save();
        return back();
    }
    public function deletePostRamo($id_posteo){
        $postRamo = PostRamo::where('id', $id_posteo)->first();
        $postRamo->estado=0;
        $postRamo->save();
        return back();
    }

}
