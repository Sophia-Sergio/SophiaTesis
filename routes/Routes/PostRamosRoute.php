<?php

Route::resource('api/post_ramo', 'Api\PostRamoController', ['as' => 'api']);

Route::group(['namespace' => 'Api', 'prefix' => 'api/post_ramo'], function () {
    Route::post('toggle_like', [
        'uses' => 'PostRamoController@toggleLike',
        'as' => 'api.post_ramo.toggle_like'
    ]);
});