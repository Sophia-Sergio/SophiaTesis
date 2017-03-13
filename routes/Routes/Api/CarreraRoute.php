<?php

Route::post('carrera/{id}/ramos', [
    'uses' => 'Api\CarreraController@ramos',
    'as' => 'api.carrera.ramos'
]);