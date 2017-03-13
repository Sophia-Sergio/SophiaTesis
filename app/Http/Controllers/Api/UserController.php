<?php

namespace Sophia\Http\Controllers\Api;

use Illuminate\Http\Request;
use Sophia\Http\Controllers\Controller;
use Sophia\User;

class UserController extends Controller
{
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user   =   User::find($id);
        return $user;
    }
}
