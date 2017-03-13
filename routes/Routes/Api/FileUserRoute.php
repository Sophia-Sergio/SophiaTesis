<?php

Route::resource('file_user', 'Api\FileUserController', [
    'only' => [
        'update'
    ],
    'names' => [
        'update' => 'api.file_user.update'
    ],
]);