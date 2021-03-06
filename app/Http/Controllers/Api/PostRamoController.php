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
        $postId =   $request->idPost;
        $userId =   Auth::user()->id;
        $post   =   PostRamo::find($postId);

        $like   =   LikePost::where('post_ramo_id', $postId)
            ->where('user_id', $userId)
            ->first();

        if (count($like) > 0) {
            $like->delete();
        } else {
            LikePost::create([
                'post_ramo_id'  =>  $postId,
                'user_id'       =>  $userId
            ]);
        }

        $totalLikes =   $post->likes()->count();
        $isLike     =   $post->isLikeUser($userId);

        return response()->json([
            'totalLikes'    =>  $totalLikes,
            'isLike'        =>  $isLike
        ]);
    }
}
