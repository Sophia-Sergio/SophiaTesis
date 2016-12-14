<?php

namespace Sophia\Http\Controllers;


use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Sophia\Comentario;
use Sophia\Http\Requests;
use Sophia\TipoInstitucion;
use Sophia\Institucion;
use Sophia\Carrera;
use Sophia\Perfil;
use Sophia\Usuario_Perfil;
use Sophia\User;
use Sophia\Post;
use Sophia\Ramo;
use Sophia\Docente;
use Sophia\Publicidad;
use Sophia\UsuarioRamoDocente;
use Sophia\UsersSeguidos;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;
use Sophia\Http\Requests\UsuarioCreateRequest;


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

    public function signInUp()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        } else {
            return view('welcome');
        }
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

    public function getProfile()
    {
        return view ('user.profile');
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
        $id_usuario= Session::get('user')->id;
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
        $id_usuario= Session::get('user')->id;
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

    public function updateProfile(Request $request)
    {


        $this->validate($request, [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|min:3',
        ]);

        $data = $request;

        $usuario = Session::get('user');



        DB::table('users')
            ->where('id', $usuario->id)
            ->update([
                'nombre' => $request['first_name'],
                'apellido' => $request['last_name'],
                'email' => $request['email'],
                'fecha_nacimiento' => $request['fecha_nacimiento'],
            ]);
        $usuario=User::find($usuario->id);
        Session::set('user',$usuario );
        $usuario = Session::get('user');

        $file = $request->file('image');
        $filename = $usuario->id.'.jpg';
        if ($file){
            Storage::disk()->put($filename, File::get($file));
        }
        return redirect()->route('profile');
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

    public function postSignUp(Request $request)
    {

        //validation de inputs
        $this->validate($request, [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'email|required|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
            'birth_day' => 'required',
            'birth_month' => 'required',
            'birth_year' => 'required',
        ]);

        $first_name = $request['first_name'];
        $last_name = $request['last_name'];
        $email = $request['email'];
        $password = bcrypt($request['password']);
        $dia = $request['birth_day'];
        $mes = $request['birth_month'];
        $ano = $request['birth_year'];

        //calculo edad

        $dia_actual=date("j");
        $mes_actual=date("n");
        $ano_actual=date("Y");
        if (($mes == $mes_actual) && ($dia > $dia_actual)) {
            $ano_actual=($ano_actual-1); }
        if ($mes > $mes_actual) {
            $ano_actual=($ano_actual-1);}
        $age=($ano_actual-$ano);

        //fin calculo edad

        $user = new User();
        $user->nombre = $first_name;
        $user->apellido = $last_name;
        $user->email = $email;
        $user->password = $password;
        $user->fecha_nacimiento = $ano."-".$mes."-".$dia;
        $user->edad = $age;
        $user->estado = 1;
        $user->reintentos = 0;
        $user->save();


        $user = User::where('email', $email)->first();

        $perfil = new Usuario_Perfil();
        $perfil->id_usuario = $user->id;
        $perfil->id_perfil = 2;
        DB::table('usuario_perfils')->insert([
            ['id_usuario' => $user->id, 'id_perfil' => 2]
        ]);


        Auth::login($user); //logear a usuario
        Session::put('user', $user);
        return redirect()->route('dashboard');

    }
    public function postSignIn(Request $request)
    {
        $this->validate($request, [
            'email_' => 'email|required',
            'password_' => 'required'
        ]);

        if(Auth::attempt(['email'=> $request['email_'], 'password'=> $request['password_']])){
            $email = $request['email_'];
            $user = User::where('email', $email)->first();
            Session::put('user', $user);
            Auth::login($user);
            return redirect()->route('dashboard');
        }else{
            $message = "Debe Registrarse antes de iniciar";
            return redirect()->back()->with(['message' => $message]); //le entrego a la sesi�n un mensaje de error
        }
    }




    public function getDashboard()
    {
   
     // se retorna una vista, seg�n tipo de usuario
        $id = Session::get('user')->id;
        $usuario = Session::get('user');

        $comentarioCarreraPosts =  DB::table('comentarios')
            ->join('post_carreras', 'comentarios.id_post_carrera', '=', 'post_carreras.id')
            ->join('users', 'comentarios.id_usuario', '=', 'users.id')
            ->select('users.nombre','users.apellido','comentarios.contenido', 'comentarios.created_at', 'comentarios.id_post_carrera', 'comentarios.id_post_ramo')
            ->distinct()
            ->get();

        $perfil = DB::table('users')
                ->join('usuario_perfils', 'usuario_perfils.id_usuario', '=', 'users.id')
                ->select('id_perfil')
                ->where('usuario_perfils.id_usuario', '=', $id)
                ->distinct()
                ->first();
        $publicidad = DB::table('publicidads')
            ->select('id', 'url')
            ->orderBy('id', 'desc')
            ->first();

        Session::put('perfil', $perfil);
        if ($perfil->id_perfil==1)
        {
            return view('admin.index', [

                'user' => $usuario]);
        }

     // se retorna una vista, seg�n haya ingresado alg�n ramo o no


        //consultamos si existe registro en tabla usuario ramo docente
        if (UsuarioRamoDocente::where('id_usuario', $id )->count()==0) {
            // si no existe redireccionamos nuevamente a la pagina de registro academico
            //cargamos en variable los tipos de institucion
            $tipos_institucion = TipoInstitucion::all();
            
            //cargamos en variable session la lista con los tipos de institucion
            Session::put('tipos_institucion', $tipos_institucion);

            //retornamos la vista de registro academico
            return view('user.registroAcademico');
        }else {
            // en caso de que el alumno ya este registrado
            // comenzamos a cargar la información para el dashboard
            // cargamos los ramos seleccionados por el alumno
            $ramos = DB::table('usuario_ramo_docentes')
                ->join('ramo_docentes', 'usuario_ramo_docentes.id_ramo_docente', '=', 'ramo_docentes.id')
                ->join('ramos', 'ramo_docentes.id_ramo', '=', 'ramos.id')
                ->select('ramos.*', 'id_ramo', 'nombre_ramo', 'nombre_ramo_html')
                ->where('usuario_ramo_docentes.id_usuario', '=', $id)
                ->distinct()
                ->orderBy('nombre_ramo')
                ->get();

            // cargamos la carrera seleccionada por el alumno
            $carrera = DB::table('usuario_ramo_docentes')
                ->join('ramo_docentes', 'usuario_ramo_docentes.id_ramo_docente', '=', 'ramo_docentes.id')
                ->join('carrera_ramos', 'ramo_docentes.id_ramo', '=', 'carrera_ramos.id_ramo')
                ->join('carreras', 'carrera_ramos.id_carrera', '=', 'carreras.id')
                ->select('id_carrera', 'nombre_carrera', 'nombre_carrera_no_tilde')
                ->where('usuario_ramo_docentes.id_usuario', '=', $id)
                ->distinct()
                ->first();

            //cargamos en variable session la carrera seleccionada por el alumno
            Session::put('carrera', $carrera);


            $id_carrera = $carrera->id_carrera;

            $carreraObj = Carrera::find($id_carrera);

            //cargamos lista de posteos asociados a la carrera
            $posteosCarrera = $carreraObj->getPost();

            // cargamos en variable session la lista de ramos
            Session::put('ramos', $ramos);
            // cargamos en varaible session los posteos asociados a la cerra
            Session::put('posteosCarrera', $posteosCarrera);
            //Session::put('posteosRamo', $posteosRamo);


            /**
             * Obtenemos la informacion de las actividades de los usuarios seguidos
             */

            $elementosSeguidos = $carreraObj->getElementoSeguidores($id);

            // retornamos la vista index
            return view('user.index', [
                'elementosSeguidos' => $elementosSeguidos
            ])->with(['perfil' => $perfil,
            'publicidad' => $publicidad,
            'comentarioCarreraPosts' => $comentarioCarreraPosts,
            ]);
        }
    }
    public function getLogout(){
        Session::flush();
        //Auth::logout(); //decidi irme por flush, porque as� se borran los datos de sesi�n
        return redirect()->route('home');
    }

    public function tomaCarrera(Request $request){
        $institucion = $request['institucion'];
        $id_carrera = $request['carrera'];
        $anio = $request['anio'];
        $regimen = $request['regimen'];

        $ramos = DB::table('carrera_ramos')
            ->join('ramos', 'carrera_ramos.id_ramo', '=', 'ramos.id')
            ->select('id_ramo', 'nombre_ramo', 'nombre_ramo_html', 'id_semestre')
            ->where('carrera_ramos.id_carrera', '=', $id_carrera)
            ->distinct()
            ->orderBy('nombre_ramo')
            ->get();

        $cant_semestres = DB::table('carrera_ramos')
            ->select('id_semestre')
            ->where('id_carrera', $id_carrera)
            ->where('anio', $anio)
            ->max('id_semestre');
        Session::put('cant_semestres', $cant_semestres);
        Session::put('ramos', $ramos);
        return view('user.registroAcademicoRamos');
    }
    public function tomaRamos(Request $request){
        $ramosTomados = $request['ramo'];
        foreach ($ramosTomados AS $index => $value)
            $ramosTomados[$index] = (int)$value;

        $ramo_docentes = DB::table('ramo_docentes')
                ->join('ramos', 'ramo_docentes.id_ramo', '=', 'ramos.id')
                ->join('docentes', 'ramo_docentes.id_docente', '=', 'docentes.id')
                ->select('ramo_docentes.id','id_ramo','id_docente', 'id_regimen', 'nombre_ramo', 'nombre', 'apellido_paterno', 'apellido_materno')
                ->whereIn('ramo_docentes.id_ramo', $ramosTomados)
                ->get();

        $ramos = Ramo::find($ramosTomados);
        Session::put('docentes', $ramo_docentes );
        Session::put('ramos_nombre', $ramos);
        return view ('user.registroAcademicoDocentes');
    }

    public function tomaDocentes(Request $request){
        $ramo_docenteTomados = $request['ramo_docente'];
        foreach ($ramo_docenteTomados AS $index => $value)
            $ramo_docenteTomados[$index] = (int)$value;
        for($x = 0; $x < sizeof($ramo_docenteTomados); $x++)
        {
            $usuarioRamoDocente = new UsuarioRamoDocente();
            $usuarioRamoDocente->id_usuario = Session::get('user')->id;
            $usuarioRamoDocente->id_ramo_docente = $ramo_docenteTomados[$x];
            $usuarioRamoDocente->save();
        }
        return redirect()->route('dashboard');
    }

    /**
     * Función para obtener los usuarios de un ramo específico
     */
    public function byRamo($ramo)
    {
        $id_user = Session::get('user')->id;
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
