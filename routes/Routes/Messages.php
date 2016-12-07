<?php

// Listar conversación de 2 usuarios
Route::get('/messages/{uuid}/chat', [
    'as' => 'messages.chats',
    'uses' => 'MessageController@chats'
]);

Route::get('/messages/{user1}/{user2}', [
    'as' => 'messages.check_msg',
    'uses' => 'MessageController@checkMsg'
]);

Route::get('/my_messages/{ramo}', [
    'as' => 'messages.my_messages',
    'uses' => 'MessageController@myMessages'
]);

Route::resource('messages', 'MessageController');