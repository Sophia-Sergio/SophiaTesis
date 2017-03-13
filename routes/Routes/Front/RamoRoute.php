<?php

Route::get('/ramo/asignar', [
    'as' => 'ramo.assign',
    'uses' => 'RamoController@assign'
]);