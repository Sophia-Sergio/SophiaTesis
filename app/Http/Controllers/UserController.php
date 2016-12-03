<?php

namespace Sophia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Sophia\Http\Requests;
use Sophia\TipoInstitucion;
use Sophia\User;
use Sophia\Post;
use Sophia\Ramo;
use Sophia\Docente;
use Sophia\UsuarioRamoDocente;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;

class UserController extends Controller
{
    //ADMINISTADROR
    public function create()
    {
        return view('admin.crearUsuarios');
    }

    public function agregarUsuarioAdmin(){
        $data = Request::all();
        $dia = $data['dia_nacimiento'];
        $mes = $data['mes_nacimiento'];
        $ano = $data['ano_nacimiento'];

        $usuario = new User;
        $usuario->nombre=$data["nombre"];
        $usuario->apellido=$data["apellido"];
        $usuario->email=$data["email"];
        $usuario->fecha_nacimiento= $ano."-".$mes."-".$dia;
        $usuario->password=$data["password"];
        $usuario->estado=$data["estado"]; //input de formulario
        $resul = $usuario->save();

        if($resul){
            return view("mensajes.msj_correcto")->with("msj", "Usuario Registrado Correctamente");
        }else
        {
            return view("mensajes.msj_rechazado")->with("msj", "Hubo un Erorr, vuelva a intentarlo");
        }  
    }

    public function edit($id)
    {
        $usuario = \Sophia\User::find($id);
        return view('admin.edit',['usuario'=>$usuario]);
    }

    public function update(UsuarioUpdateRequest $request, $id)
    {
        $usuario = \Sophia\User::find($id);
        $usuario->fill($request->all());
        $usuario->save();
        Session::flash('message','Usuario Actualizado Correctamente');
        return Redirect::to('/admin');
    }

    public function verUsuarios()
    {
        $usuario = Session::get('user');
        $usuarios = \Sophia\User::All();
        return view('admin.verUsuarios',['user'=>$usuario], compact('usuarios'));
    }

    public function crearUsuarios()
    {
        /*
        if($request->ajax()){
            Genre::create($request->all());
            return response()->json([
                "mensaje" => "creado"
            ]);
        }
        */
        return view('admin.crearUsuarios');
    }

    public function getProfile()
    {
        return view ('user.profile');
    }

    public function updateProfile(Request $request)
    {
    $this->validate($request, [
        'first_name' => 'required|min:3',
        /* 'last_name' => 'required|min:3',
         'email' => 'email|required|unique:users',
         'password' => 'required|min:6|confirmed',
         'password_confirmation' => 'required',
         'birth_day' => 'required',
         'birth_month' => 'required',
         'birth_year' => 'required',*/
    ]);

    $usuario = Auth::user();
    $usuario->nombre = $request['first_name'];
    $usuario->update();
    $file = $request->file('image');
    $filename = $request['first_name'].'-'.$usuario->id.'.jpg';
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

        Auth::login($user); //logear a usuario
        Session::put('user', $user);
        //Session::put('idRamo', $idRamo);
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

        $perfil = DB::table('users')
                ->join('usuario_perfils', 'usuario_perfils.id_usuario', '=', 'users.id')
                ->select('id_perfil')
                ->where('usuario_perfils.id_usuario', '=', $id)
                ->distinct()
                ->first();

        if ($perfil->id_perfil==1)
        {
            return view('admin.index', [
                'user'=>$usuario,
                'perfil'=>$perfil->id_perfil]);
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
            
            $id_carrera = Session::get('carrera')->id_carrera;

            //cargamos lista de posteos asociados a la carrera
            $posteosCarrera = DB::table('post_carreras')
                ->join('carreras', 'id_carrera', '=', 'carreras.id')
                ->join('users', 'id_user', '=', 'users.id')
                ->select('id_carrera', 'contenido', 'id_user',  'post_carreras.id', 'nombre_carrera', 'nombre', 'post_carreras.created_at')
                ->where('id_carrera', $id_carrera)
                ->where('post_carreras.estado', '=', 1)
                ->distinct()
                ->orderBy('created_at', 'desc')
                ->get();

            //$id_ramo = Session::get('ramo')->id;
            /*
            $posteosRamo = DB::table('post_ramos')
                ->join('carreras', 'id_carrera', '=', 'carreras.id')
                ->join('users', 'id_user', '=', 'users.id')
                ->select('id_carrera', 'contenido', 'id_user',  'posts.id', 'nombre_carrera', 'nombre', 'posts.created_at')
                ->where('id_carrera', $id_carrera)
                ->where('id_usuario_ramo_docente', $id_usuario_ramo_docente)
                ->where('posts.estado', '=', 1)
                ->distinct()
                ->orderBy('created_at', 'desc')
                ->get();
            */

            // cargamos en variable session la lista de ramos
            Session::put('ramos', $ramos);
            // cargamos en varaible session los posteos asociados a la cerra
            Session::put('posteosCarrera', $posteosCarrera);
            //Session::put('posteosRamo', $posteosRamo);

            // retornamos la vista index
            return view('user.index',
             ['perfil'=>$perfil]);
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


}
