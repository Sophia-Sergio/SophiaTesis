<?php

namespace Sophia\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Sophia\Http\Requests;
use Sophia\LikePost;
use Sophia\LikePostCarrera;
use Sophia\PostCarrera;
use Sophia\PostRamo;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    public function postCreatePostCarrera(Request $request){
        //Validaci�n
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


    public function deletePostCarrera($id_posteo)
    {
        $postCarrera = PostCarrera::where('id', $id_posteo)->get();
        dd($postCarrera);
        $postCarrera->estado = 0;
        $postCarrera->save();
        return redirect()->route('dashboard');
    }


    public function postCreatePostRamo(Request $request){
        //Validacion
        /*$this->validate($request, [
            'contenido' => 'required|max:1000',
        ]);*/

        $request['id_user']     =   Auth::user()->id;
        $request['estado']      =   1;
        $request['id_carrera']  =   Auth::user()->getCareers()->id;

        PostRamo::create($request->all());

        return back();
    }
    public function deletePostRamo($id_posteo){
        $postRamo = PostRamo::where('id', $id_posteo)->first();
        $postRamo->estado=0;
        $postRamo->save();
        return back();
    }
    public function postEditPost(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        DB::table('post_ramos')
            ->where('id', $request['postId'])
            ->update([
                'contenido' => $request['body'],
            ]);
         Redirect::back();
    }

    public function toggleLikeCarrera($id_post) {

        $id_user = Auth::user()->id;
        $post = PostCarrera::find($id_post);

        $actuales = LikePostCarrera::where('post_carrera_id', $id_post)
            ->where('user_id', $id_user)
            ->get()
        ;

        if(count($actuales) > 0) {
            foreach($actuales as $actual) {
                $actual->delete();
            }
        } else {
            $nuevoLike = new LikePostCarrera();
            $nuevoLike->post_carrera_id = $id_post;
            $nuevoLike->user_id = $id_user;
            $nuevoLike->save();
        }

        $totalLikes = $post->likes()->count();
        $is_like = $post->isLikeUser($id_user);

        return response()->json([
            'totalLikes' => $totalLikes,
            'isLike' => $is_like
        ]);
    }

}
