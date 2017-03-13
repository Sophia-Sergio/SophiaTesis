<?php

namespace Sophia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Sophia\Carrera;
use Sophia\Comentario;
use Sophia\TipoInstitucion;
use Sophia\UsuarioRamoDocente;
use Session;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId         =   Auth::user()->id;

        if (UsuarioRamoDocente::where('id_usuario', $userId)->count() == 0) {
            return redirect()->route('uc.create');
            //$tipos_institucion = TipoInstitucion::all(); print_r($tipos_institucion);
            //return view('user.registroAcademico', compact('tipos_institucion'));
        }

        $userProfile    =   Auth::user()->getProfile()->id;

        if ($userProfile == 1) {
            return view('admin.index', [
                'user' => Auth::user()
            ]);
        }

        $userCareers    =   Auth::user()->getCareers()->id;

        // TODO: Actualmente la lógica permite 1 carrera por usuario
        $comments = Comentario::getByCareer($userCareers);

        // TODO: No se está utilizando
        $publicidad = DB::table('publicidads')->select('id', 'url')->orderBy('id', 'desc')->first();

        $posts = Carrera::getPostsByCareer($userId, $userCareers);

        $elementosSeguidos = Carrera::getElementoSeguidores($userId, $userCareers);

        return view('carrera.index', compact('elementosSeguidos', 'profile', 'publicidad', 'comments', 'posts'));
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
        //
    }
}
