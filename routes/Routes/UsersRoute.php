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