<?php

Route::post('ramo/assign', [
    'uses' => 'Api\RamoController@assign',
    'as' => 'api.ramo.assign'
]);