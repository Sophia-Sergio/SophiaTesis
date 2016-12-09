<?php

use Sophia\UsuarioRamoDocente;

Route::get('/files/not_seen/', [
    'uses' => 'FileController@notSeen',
    'as' => 'files.notSeen',
]);

Route::get('/files/{idRamo}/mark_seen/{idUsuarioRamoDocente}', [
    'uses' => 'FileController@markAsSeen',
    'as' => 'files.markAsSeen',
]);

Route::post('/files/{idRamo}/ramo/private/table', [
    'uses' => 'FileController@privateTable',
    'as' => 'files.privateDataTable',
]);

Route::post('/files/{idRamo}/ramo/public/table', [
    'uses' => 'FileController@publicTable',
    'as' => 'files.publicDataTable',
]);

Route::delete('/files/{id}/', [
    'uses' => 'FileController@destroy',
    'as' => 'files.destroy',
]);