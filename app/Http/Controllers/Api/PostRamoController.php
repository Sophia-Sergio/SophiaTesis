<?php

namespace Sophia\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Sophia\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sophia\LikePost;
use Sophia\PostRamo;

class PostRamoController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $post   = PostRamo::where('id', $id)->first();

        $post->estado = 0;
        $post->save();

        return back();
    }

    /**
     * Agregar o quitar like a post
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @internal param $id_post
     */
    public function toggleLike(Request $request)
    {
        $id_post    =   $request->idPost;
        $id_user = Auth::user()->id;
        $post = PostRamo::find($id_post);

        $actuales = LikePost::where('post_ramo_id', $id_post)
            ->where('user_id', $id_user)
            ->get()
        ;
        return $actuales;
        if(count($actuales) > 0) {
            foreach($actuales as $actual) {
                $actual->delete();
            }
        } else {
            $nuevoLike = new LikePost();
            $nuevoLike->post_ramo_id = $id_post;
            $nuevoLike->user_id = $id_user;
            $nuevoLike->save();
        }

        $totalLikes = $post->likes()->count();
        $is_like = $post->isLikeUer($id_user);

        return response()->json([
            'totalLikes' => $totalLikes,
            'isLike' => $is_like
        ]);
    }
}
