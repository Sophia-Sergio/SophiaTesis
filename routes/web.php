<?php
use Illuminate\Support\Facades\Input;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/




Route::group(['middleware' => ['web']], function(){

    Route::post('/AdmEstudianteBloquearUsuario/{id_user}', [
        'uses' => 'UserController@AdmEstudianteBloquearUsuario',
        'as' => 'AdmEstudianteBloquearUsuario',
    ]);
    Route::post('/AdmEstudianteDesbloquearUsuario/{id_user}', [
        'uses' => 'UserController@AdmEstudianteDesbloquearUsuario',
        'as' => 'AdmEstudianteDesbloquearUsuario',
    ]);




    Route::post('/comentarPosteoCarrera/{id_posteo_carrera}', [
        'uses' => 'UserController@comentarPosteoCarrera',
        'as' => 'comentarPosteoCarrera',
        'middleware' => 'auth'
    ]);

    Route::post('/comentarPosteoRamo/{id_posteo_ramo}', [
        'uses' => 'UserController@comentarPosteoRamo',
        'as' => 'comentarPosteoRamo',
        'middleware' => 'auth'
    ]);

    Route::get('/login', [
        'uses' => 'UserController@signInUp',
        'as' => 'home'
    ]);

    Route::get('/', [
        'uses' => 'UserController@signInUp',
        'as' => 'home'
    ]);

    /*Route::get('login', function () {
        return view('welcome');
    })->name('home');

    Route::get('/', function () {
        return view('welcome');
    })->name('home');*/

    Route::post('/signup', [
        'uses' => 'UserController@postSignUp',
        'as' => 'signup'
    ]);

    Route::post('/signin', [
        'uses' => 'UserController@postSignIn',
        'as' => 'signin'
    ]);

    Route::get('verUsuarios', 'UserController@verUsuarios');

    Route::get('crearUsuarios', 'UserController@crearUsuarios');

    Route::get('user/seguir_usuario/{user_id}', 'UserController@toggleLikeSeguirUsuario');

    Route::post('/agregarPublicidadAdmin', [
        'uses' => 'UserController@agregarPublicidadAdmin',
        'as' => 'agregarPublicidadAdmin'
    ]);


    Route::post('/agregarUsuarioAdmin', [
        'uses' => 'UserController@agregarUsuarioAdmin',
        'as' => 'agregarUsuarioAdmin'
    ]);
    Route::get('/editUser/{id}', [
        'uses' => 'UserController@edit',
        'as' => 'editUser',
        'middleware' => 'auth'
    ]);

    Route::get('/updateUser/{id}', [
        'uses' => 'UserController@update',
        'as' => 'updateUser',
        'middleware' => 'auth'
    ]);



    Route::get('verInstituciones', 'UserController@verInstituciones');

    Route::get('crearInstituciones', 'UserController@crearInstituciones');


    Route::post('/agregarInstitucionAdmin', [
        'uses' => 'UserController@agregarInstitucionAdmin',
        'as' => 'agregarInstitucionAdmin'
    ]);
    Route::get('/editInstitucion/{id}', [
        'uses' => 'UserController@editInstitucion',
        'as' => 'editInstitucion',
        'middleware' => 'auth'
    ]);
    Route::get('/updateInstitucion/{id}', [
        'uses' => 'UserController@updateInstitucion',
        'as' => 'updateInstitucion',
        'middleware' => 'auth'
    ]);



    Route::get('verCarreras', 'UserController@verCarreras');
    Route::get('crearCarreras', 'UserController@crearCarreras');
    Route::post('/agregarCarreraAdmin', [
        'uses' => 'UserController@agregarCarreraAdmin',
        'as' => 'agregarCarreraAdmin'
    ]);
    Route::get('/editCarrera/{id}', [
        'uses' => 'UserController@editCarrera',
        'as' => 'editCarrera',
        'middleware' => 'auth'
    ]);
    Route::get('/updateCarrera/{id}', [
        'uses' => 'UserController@updateCarrera',
        'as' => 'updateCarrera',
        'middleware' => 'auth'
    ]);


    Route::get('verDocentes', 'UserController@verDocentes');
    Route::get('crearDocentes', 'UserController@crearDocentes');
    Route::post('/agregarDocenteAdmin', [
        'uses' => 'UserController@agregarDocenteAdmin',
        'as' => 'agregarDocenteAdmin'
    ]);
    Route::get('/editDocente/{id}', [
        'uses' => 'UserController@editDocente',
        'as' => 'editDocente',
        'middleware' => 'auth'
    ]);
    Route::get('/updateDocente/{id}', [
        'uses' => 'UserController@updateDocente',
        'as' => 'updateDocente',
        'middleware' => 'auth'
    ]);


    Route::post('/edit', [
        'uses' => 'PostController@postEditPost',
        'as' => 'edit'
    ]);

    Route::get
    ('crearPublicidad', [
        'uses' => 'UserController@crearPublicidad',
        'as' => 'crearPublicidad',
        'middleware' => 'auth'
    ]);


    Route::post('/updateProfile', [
        'uses' => 'UserController@updateProfile',
        'as' => 'updateProfile'
    ]);

    Route::get('/userimage/{filename}', [
        'uses' => 'UserController@getUserImage',
        'as' => 'profile.image'
    ]);

    Route::get('/publicidadimage/{filename}', [
        'uses' => 'UserController@getPublicidadImage',
        'as' => 'publicidad.image'
    ]);


    Route::get('/profile', [
        'uses' => 'UserController@getProfile',
        'as' => 'profile',
        'middleware' => 'auth'
    ]);

    Route::post('/tomaCarrera', [
        'uses' => 'UserController@tomaCarrera',
        'as' => 'tomaCarrera',
        'middleware' => 'auth'
    ]);
    Route::post('/tomaRamos', [
        'uses' => 'UserController@tomaRamos',
        'as' => 'tomaRamos',
        'middleware' => 'auth'
    ]);
    Route::post('/tomaDocentes', [
        'uses' => 'UserController@tomaDocentes',
        'as' => 'tomaDocentes',
        'middleware' => 'auth'
    ]);
    Route::get('/dashboard', [
        'uses' => 'UserController@getDashboard',
        'as' => 'dashboard',
        'middleware' => 'auth'
    ]);

    Route::get('/delete-post/{id_posteo}', [
        'uses' => 'PostController@deletePostRamo',
        'as' => 'post.delete',
        'middleware' => 'auth'
    ]);
    Route::get('/delete-post/{id_posteo}', [
        'uses' => 'PostController@deletePostCarrera',
        'as' => 'postCarrera.delete',
        'middleware' => 'auth'
    ]);
    Route::post('/upload', [
        'uses' => 'FileController@upload',
        'as' => 'files.upload',
        'middleware' => 'auth'
    ]);
    Route::get('/download/{archivo}', 'FileController@download');
    Route::get('/likeFile/{archivo}', 'FileController@toggleLike');


    Route::get('/logout', [
        'uses' => 'UserController@getLogout',
        'as' => 'logout',
        'middleware' => 'auth'
    ]);

    Route::post('/createpostCarrera', [
        'uses' => 'PostController@postCreatePostCarrera',
        'as' => 'posteoCarrera.crear',
        'middleware' => 'auth'
    ]);
    Route::post('/createpostRamo', [
        'uses' => 'PostController@postCreatePostRamo',
        'as' => 'posteoRamo.crear',
        'middleware' => 'auth'
    ]);

    Route::get('/likePost/{post}', 'PostController@toggleLike');
    Route::get('/likePostCarrera/{post}', 'PostController@toggleLikeCarrera');

    Route::get('ramo/muro/{ramo}', 'RamoController@index');

    Route::get('ramo/contenido/{ramo}', [
        'uses' => 'RamoController@contenido',
        'as' => 'ramo.contenido'
    ]);

    /*
    Route::get('tomaCarrera', function () {
        return view('user.registroAcademicoRamos');
    })->name('tomaCarrera');
    */

    Route::get('/tomaInstitucion', function(){
        $tipo_institucion = Input::get('tipo_institucion');
        $institucion = \Sophia\Institucion::where('id_tipo_institucion', $tipo_institucion)->get();
        Return Response::json($institucion);
    });
    Route::get('/tomaCarreras', function(){
        $institucion = Input::get('institucion');
        $carrera = \Sophia\Institucion_carrera::
        where('id_institucion', $institucion)
            ->join('carreras', 'institucion_carreras.id_carrera', '=', 'carreras.id')->get();
        Return Response::json($carrera);
    });
});

// No requieren autenticación
require 'Routes/Social.php';

// Requieren autenticación
Route::group(['middleware' => ['web', 'auth']], function () {
    require 'Routes/Messages.php';
    require 'Routes/Users.php';
    require 'Routes/News.php';
    require 'Routes/FilesRoute.php';
});
