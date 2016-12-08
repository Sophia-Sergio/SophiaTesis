<?php

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