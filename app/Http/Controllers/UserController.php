<?php

namespace Sophia\Http\Controllers;


use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Sophia\CarreraRamo;
use Sophia\Comentario;
use Sophia\RamoDocente;
use Sophia\TipoInstitucion;
use Sophia\Institucion;
use Sophia\Carrera;
use Sophia\User;
use Sophia\Ramo;
use Sophia\Docente;
use Sophia\Publicidad;
use Sophia\UsuarioRamoDocente;
use Sophia\UsersSeguidos;
use Session;
use Illuminate\Support\Facades\Redirect;


use Sophia\Http\Requests\UsuarioUpdateRequest;
use Sophia\Http\Requests\CarreraUpdateRequest;
use Sophia\Http\Requests\DocenteUpdateRequest;
use Sophia\Http\Requests\InstitucionUpdateRequest;


class UserController extends Controller
{
    /**
     * Vista de sign in y sign up
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function AdmEstudianteBloquearUsuario($id_usuario)
    {
        $usuario=User::find($id_usuario);
        $usuario->estado =0;
        $usuario->save();
        return redirect()->back();
    }
    public function AdmEstudianteDesbloquearUsuario($id_usuario)
    {
        $usuario=User::find($id_usuario);
        $usuario->estado =1;
        $usuario->save();
        return redirect()->back();
    }

    //ADMINISTADROR
    public function create()
    {
        return view('admin.crearUsuarios');
    }

    public function agregarUsuarioAdmin(Request $request){

        $this->validate($request, [
            'nombre' => 'required|min:3',
            'apellido' => 'required|min:3',
            'email' => 'email|required|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
            'birth_day' => 'required',
            'birth_month' => 'required',
            'birth_year' => 'required',
        ]);

        $data = $request;

        $dia = $request['birth_day'];
        $mes = $request['birth_month'];
        $ano = $request['birth_year'];

        $usuario = new User;
        $usuario->nombre=$data["nombre"];
        $usuario->apellido=$data["apellido"];
        $usuario->email=$data["email"];
        $usuario->fecha_nacimiento= $ano."-".$mes."-".$dia;
        $usuario->password=$data["password"];
        $usuario->estado=$data["estado"]; //input de formulario

        //calculo edad

        $dia_actual=date("j");
        $mes_actual=date("n");
        $ano_actual=date("Y");
        if (($mes == $mes_actual) && ($dia > $dia_actual)) {
            $ano_actual=($ano_actual-1); }
        if ($mes > $mes_actual) {
            $ano_actual=($ano_actual-1);}
        $age=($ano_actual-$ano);

        $usuario->edad = $age;
        $usuario->reintentos = 0;
        $resul = $usuario->save();

        Session::flash('message','Usuario Creado Correctamente');
        return Redirect::to('/dashboard')->with(['id'=>Session::get('perfil')->id_perfil]);
    }



    public function agregarInstitucionAdmin(Request $request){

        $this->validate($request, [
            'nombre_institucion' => 'required|min:3',
            'id_tipo_institucion' => 'required|max:1',

        ]);

        $data = $request;


        $institucion = new Institucion;
        $institucion->nombre_institucion=$data["nombre_institucion"];
        $institucion->nombre_institucion_html=$data["nombre_institucion"];
        $institucion->nombre_institucion_no_tilde=$data["nombre_institucion"];
        $institucion->id_tipo_institucion=$data["id_tipo_institucion"];

        $resul = $institucion->save();

        Session::flash('message','Institucion Agregada Correctamente');
        return Redirect::to('/dashboard')->with(['id'=>Session::get('perfil')->id_perfil]);
    }

    public function agregarCarreraAdmin(Request $request){

        $this->validate($request, [
            'nombre_carrera' => 'required|min:3',
        ]);

        $data = $request;


        $carrera = new Carrera;
        $carrera->nombre_carrera=$data["nombre_carrera"];
        $carrera->nombre_institucion_html=$data["nombre_carrera"];
        $carrera->nombre_institucion_no_tilde=$data["nombre_carrera"];
        $resul = $carrera->save();

        Session::flash('message','Institucion Agregada Correctamente');
        return Redirect::to('/dashboard')->with(['id'=>Session::get('perfil')->id_perfil]);
    }

    public function agregarDocenteAdmin(Request $request){

        $this->validate($request, [
            'nombre' => 'required|min:3',
            'apellido_paterno' => 'required|min:3',
            'apellido_materno' => 'required|min:3',
            'email' => 'required|min:3',
            'estado' => 'required',
        ]);

        $data = $request;


        $docente = new Docente;
        $docente->nombre=$data["nombre"];

        $docente->apellido_paterno=$data["apellido_paterno"];
        $docente->apellido_materno=$data["apellido_materno"];
        $docente->nombre_html=$data["nombre"];
        $docente->apellido_paterno_html=$data["apellido_paterno"];
        $docente->apellido_materno_html=$data["apellido_materno"];
        $docente->nombre_no_tilde=$data["nombre"];
        $docente->apellido_paterno_no_tilde=$data["apellido_paterno"];
        $docente->apellido_materno_no_tilde=$data["apellido_materno"];
        $docente->email=$data["email"];
        $docente->estado=$data["estado"];

        $resul = $docente->save();

        Session::flash('message','Docente Agregado Correctamente');
        return Redirect::to('/dashboard')->with(['id'=>Session::get('perfil')->id_perfil]);
    }


    public function edit($id)
    {
        $usuarioEditar = \Sophia\User::find($id);
        $perfilUsuarioEditar = DB::table('users')
            ->join('usuario_perfils', 'usuario_perfils.id_usuario', '=', 'users.id')
            ->select('id_perfil')
            ->where('usuario_perfils.id_usuario', '=', $id)
            ->distinct()
            ->first();
        return view('admin.editUsuario',['usuarioEditar'=>$usuarioEditar, 'perfilUsuarioEditar'=>$perfilUsuarioEditar]);
    }
    public function editInstitucion($id)
    {
        $institucionEditar = \Sophia\Institucion::find($id);
        return view('admin.editInstitucion',['institucionEditar'=>$institucionEditar]);
    }
    public function editCarrera($id)
    {
        $carreraEditar = \Sophia\Carrera::find($id);
        return view('admin.editCarrera',['carreraEditar'=>$carreraEditar]);
    }
    public function editDocente($id)
    {
        $docenteEditar = \Sophia\Docente::find($id);
        return view('admin.editDocente',['docenteEditar'=>$docenteEditar]);
    }


    public function update(UsuarioUpdateRequest $request, $id)
    {
        $usuario = \Sophia\User::find($id);
        $usuario->fill($request->all());
        $usuario->save();

        DB::table('usuario_perfils')
        ->where('id_usuario', $usuario->id)
        ->update([
            'id_perfil' => $request['perfil'],
        ]);


        Session::flash('message','Usuario Actualizado Correctamente');
        return Redirect::to('/dashboard')->with(['id'=>Session::get('perfil')->id_perfil]);
    }

    public function updateInstitucion(InstitucionUpdateRequest $request, $id)
    {
        $institucion = \Sophia\Institucion::find($id);
        $institucion->fill($request->all());
        $institucion->save();
        Session::flash('message','Institucion Actualizada Correctamente');
        return Redirect::to('/dashboard')->with(['id'=>Session::get('perfil')->id_perfil]);
    }
    public function updateCarrera(CarreraUpdateRequest $request, $id)
    {
        $carrera = \Sophia\Carrera::find($id);
        $carrera->fill($request->all());
        $carrera->save();
        Session::flash('message','Carrera Actualizada Correctamente');
        return Redirect::to('/dashboard')->with(['id'=>Session::get('perfil')->id_perfil]);
    }
    public function updateDocente(DocenteUpdateRequest $request, $id)
    {
        $docente = \Sophia\Docente::find($id);
        $docente->fill($request->all());
        $docente->save();
        Session::flash('message','Docente Actualizado Correctamente');
        return Redirect::to('/dashboard')->with(['id'=>Session::get('perfil')->id_perfil]);
    }
    public function verUsuarios()
    {
        $usuario = Session::get('user');
        //$usuarios = \Sophia\User::All();

        $usuarios = DB::table('users')
            ->join('usuario_perfils', 'usuario_perfils.id_usuario', '=', 'users.id')
            ->join('perfils', 'usuario_perfils.id_perfil', '=', 'perfils.id')
            ->select('users.id', 'users.estado', 'id_perfil', 'id_usuario', 'nombre', 'apellido', 'fecha_nacimiento', 'email', 'descripcion_perfil')
            ->distinct()
            ->get();

        return view('admin.verUsuarios',['user'=>$usuario], compact('usuarios'));
    }
    public function verInstituciones()
    {
        $usuario = Session::get('user');
        $instituciones = \Sophia\Institucion::All();
        return view('admin.verInstituciones',['user'=>$usuario], compact('instituciones'));
    }

    public function verCarreras()
    {
        $usuario = Session::get('user');
        $carreras = \Sophia\Carrera::All();
        return view('admin.verCarreras',['user'=>$usuario], compact('carreras'));
    }

    public function verDocentes()
    {
        $usuario = Session::get('user');
        $docentes = \Sophia\Docente::All();
        return view('admin.verDocentes',['user'=>$usuario], compact('docentes'));
    }


    public function crearUsuarios()
    {
        $usuario = Session::get('user');
        return view('admin.crearUsuarios', ['user'=>$usuario]);
    }
    public function crearInstituciones()
    {
        $usuario = Session::get('user');
        return view('admin.crearInstituciones', ['user'=>$usuario]);
    }
    public function crearCarreras()
    {
        $usuario = Session::get('user');
        return view('admin.crearCarreras', ['user'=>$usuario]);
    }

    public function crearDocentes()
    {
        $usuario = Session::get('user');
        return view('admin.crearDocentes', ['user'=>$usuario]);
    }

    /**
     * Vista de perfil
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showProfile()
    {
        $user   =   Auth::user();
        return view ('user.profile', compact('user'));
    }

    /**
     * Modificar perfil
     *
     * @param Request $request
     * @return mixed
     */
    public function updateProfile(Request $request)
    {
        $product = User::find(Auth::user()->id);
        $product->fill($request->all());
        $product->save();

        return redirect()->route('user.profile');
    }

    public function crearPublicidad()
    {
        return view('publicidad.crearPublicidad');
    }

    public function agregarPublicidadAdmin(Request $request)
    {
        $publicidad = new Publicidad();
        $storagePath = storage_path();
        $file = \Request::file('image');
        $publicidad->name = $file->getClientOriginalName();
        $publicidad->size = $file->getClientSize();
        $publicidad->dir = $storagePath;
        $fileType = pathinfo($publicidad->name, PATHINFO_EXTENSION);
        $publicidad->extension = $fileType;
        $publicidad->url = $request['url'];
        $publicidad->empresa = $request['empresa'];

        if ($publicidad->save()){
            $filename = 'id'.$publicidad->id.'_publicidad.jpg';
            Storage::disk()->put($filename, File::get($file));
        }
        return redirect()->back();
    }
    public function comentarPosteoCarrera(Request $request, $id_posteo_carrera)
    {
        $id_usuario= Auth::user()->id;
        $comentario = new Comentario();
        $comentario->id_usuario = $id_usuario;
        $comentario->id_post_carrera = $id_posteo_carrera;
        $comentario->contenido = $request['comentario'];
        $comentario->id_post_ramo = 0;
        $comentario->save();
        return redirect()->route('dashboard');
    }

    public function comentarPosteoRamo(Request $request, $id_posteo_ramo)
    {
        $id_usuario= Auth::user()->id;
        $comentario = new Comentario();
        $comentario->id_usuario = $id_usuario;
        $comentario->id_post_carrera = 0;
        $comentario->contenido = $request['comentario'];
        $comentario->id_post_ramo = $id_posteo_ramo;
        $comentario->save();


        $id_ramo= DB::table('post_ramos')
            ->join('usuario_ramo_docentes', 'post_ramos.id_usuario_ramo_docente', '=', 'usuario_ramo_docentes.id')
            ->join('ramo_docentes', 'usuario_ramo_docentes.id_ramo_docente', '=', 'ramo_docentes.id')
            ->join('ramos', 'ramo_docentes.id_ramo', '=', 'ramos.id')
            ->select('ramos.id')
            ->where('post_ramos.id', $id_posteo_ramo)
            ->distinct()
            ->first();
        return redirect()->back();
    }

    public function getUserImage($filename)
    {
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }

    public function getPublicidadImage($filename)
    {
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }

    /**
     * Dashboard de la carrera
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDashboard()
    {

    }

    public function getLogout(){
        Session::flush();
        //Auth::logout(); //decidi irme por flush, porque as� se borran los datos de sesi�n
        return redirect()->route('home');
    }

    /**
     * Registro Académico
     *
     * Segundo paso, luego de registrarse
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tomaCarrera(Request $request)
    {
        $ramos      =   CarreraRamo::getByCareer($request['carrera']);
        $semesters  =   CarreraRamo::getNumberOfSemesters($request['carrera'], $request['anio']);

        return view('user.registroAcademicoRamos', compact('semesters', 'ramos'));
    }

    /**
     * Seleccionar Ramo
     *
     * Seleccionar un ramo y un profesor asociado a dicho ramo
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tomaRamos(Request $request)
    {
        $ramosTomados = $request['ramo'];

        $ramoDocentes = RamoDocente::getByRamos($ramosTomados);

        $ramos = Ramo::find($ramosTomados);

        return view ('user.registroAcademicoDocentes', compact('ramoDocentes', 'ramos'));
    }

    /**
     * Generar el vínculo de usuario, ramo y docentes
     *
     * @param Request $request
     * @return mixed
     */
    public function tomaDocentes(Request $request)
    {
        $sizeDocentes   =   sizeof($request['ramo_docente']);

        for ($x = 0; $x < $sizeDocentes; $x++) {
            UsuarioRamoDocente::insert([
                'id_usuario'        =>  Auth::user()->id,
                'id_ramo_docente'   =>  $request['ramo_docente'][$x]
            ]);
        }

        return redirect()->route('dashboard');
    }

    /**
     * Función para obtener los usuarios de un ramo específico
     */
    public function byRamo($ramo)
    {
        $id_user = Auth::user()->id;
        $usuario = User::find($id_user);

        $users = DB::table('usuario_ramo_docentes')
            ->join('ramo_docentes', 'usuario_ramo_docentes.id_ramo_docente', '=', 'ramo_docentes.id')
            ->join('ramos', 'ramo_docentes.id_ramo', '=', 'ramos.id')
            ->join('users', 'usuario_ramo_docentes.id_usuario', '=', 'users.id')
            ->where('ramos.id', $ramo)
            ->distinct()
            ->orderBy('nombre_ramo')
            ->get();

        $seguidos_ids = $usuario->getArrayIdsUserSeguidos();

        foreach($users as $us) {
            if(in_array($us->id, $seguidos_ids)) {
                $us->siguiendo = true;
            } else {
                $us->siguiendo = false;
            }
        }

        return view('user.by_ramo', compact('users'));
    }


    /**
     * Agregamos o eliminamos seguir a un usuario
     */
    public function toggleLikeSeguirUsuario ($user_seguido_id) {

        $id_user = Session::get('user')->id;

        $userActual = User::find($id_user);

        $actuales = UsersSeguidos::where('user_seguido_id', $user_seguido_id)
            ->where('user_id', $id_user)
            ->get()
        ;
        $siguiendo = false;

        if(count($actuales) > 0) {
            $userActual->deleteSeguirUser($user_seguido_id);
        } else {
            $userActual->addSeguirUser($user_seguido_id);
            $siguiendo = true;
        }

        return response()->json([
            'siguiendo' => $siguiendo
        ]);
    }
}
