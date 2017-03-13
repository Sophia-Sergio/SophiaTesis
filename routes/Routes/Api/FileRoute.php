<?php

Route::post('file/create', [
    'uses' => 'Api\FileController@create',
    'as' => 'api.file.create'
]);

Route::get('file/{id}', [
    'uses' => 'Api\FileController@show',
    'as' => 'api.file.show'
]);