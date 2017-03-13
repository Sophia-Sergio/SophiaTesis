<?php

namespace Sophia\Http\Controllers\Api;

use Illuminate\Http\Request;
use Sophia\File;
use Sophia\FileUser;
use Sophia\Http\Controllers\Controller;

class FileUserController extends Controller
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
        $fu = FileUser::firstOrCreate([
            'user_id' => $request->user,
            'file_id' => $request->file,
        ]);

        if (is_null($fu)) {
            return false;
        }

        $data = $request->data;

        if (isset($data['downloaded'])) {
            $fu->increment('downloaded');
        } elseif (isset($data['shared'])) {
            $fu->increment('shared');
        } elseif (isset($data['rating'])) {
            $fu->update(['rating' => $data['rating']]);
        } elseif (isset($data['favorite'])) {
            ($fu->favorite == 0) ? $fu->update(['favorite' => 1]) : $fu->update(['favorite' => 0]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
