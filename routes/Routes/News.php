<?php

Route::get('/news/{ramo}/ramo', [
    'as' => 'news',
    'uses' => 'NewController@index'
]);