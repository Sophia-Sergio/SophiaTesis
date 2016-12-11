<?php

Route::get('/users/{ramo}/ramo', [
    'as' => 'users.by_ramo',
    'uses' => 'UserController@byRamo'
]);

Route::post('/users/{id_usuario}', [
    'uses' => 'FileController@privateTable',
    'as' => 'user.verUsuariosDataTable',
]);