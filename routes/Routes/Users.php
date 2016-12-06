<?php

Route::get('/users/{ramo}/ramo', [
    'as' => 'users.by_ramo',
    'uses' => 'UserController@byRamo'
]);