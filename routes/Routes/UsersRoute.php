<?php

/**
 * UserController's Routes
 */


Route::get('/', function () {

    if (Auth::check()) {
        return redirect('/dashboard');
    } else {
        return view('welcome');
    }

});

Route::post('/signin', [
    'uses' => 'UserController@postSignIn',
    'as' => 'signin'
]);

Route::group(['middleware' => ['web', 'auth']], function() {

    // Registro académico de nuevo usuario
    Route::post('/tomaCarrera', [
        'uses' => 'UserController@tomaCarrera',
        'as' => 'tomaCarrera'
    ]);

    Route::post('/tomaRamos', [
        'uses' => 'UserController@tomaRamos',
        'as' => 'tomaRamos',
        'middleware' => 'auth'
    ]);

});