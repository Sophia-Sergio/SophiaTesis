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

    Route::get('login', function () {
        return view('welcome');
    })->name('home');

    Route::get('/', function () {
        return view('welcome');
    })->name('home');


    Route::post('/signup', [
        'uses' => 'UserController@postSignUp',
        'as' => 'signup'
    ]);

    Route::post('/signin', [
        'uses' => 'UserController@postSignIn',
        'as' => 'signin'
    ]);

    Route::post('/updateProfile', [
        'uses' => 'UserController@updateProfile',
        'as' => 'updateProfile'
    ]);

    Route::get('/userimage/{filename}', [
        'uses' => 'UserController@getUserImage',
        'as' => 'profile.image'
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

    Route::get('ramo/muro/{ramo}', 'RamoController@index');
    Route::get('ramo/contenido/{ramo}', 'RamoController@contenido');
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

    require 'Routes/Social.php';
});
