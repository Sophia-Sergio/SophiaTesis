<?php

// Obtener mensajes sin leer
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Sophia\OauthIdentity;

Route::get('/messages/unread', function () {
    $messages = \Sophia\Message::where('read', 0)
        ->where('receiver', \Auth::user()->id)
        ->where('message', '<>', '-')
        ->orderBy('created_at', 'desc')
        ->get();

    foreach ($messages as $message) {
        // Set sender name
        $senderName = \Sophia\User::find($message->sender);
        $message->sender_name = $senderName->getFullName();

        // Set receiver name
        $receiverName = \Sophia\User::find($message->receiver);
        $message->receiver_name = $receiverName->getFullName();

        // Set created at format
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $message->created_at)->format('E\l d-m-Y \a \l\a\s H:i');
        $message->formated_date = $date;

        $noAvatar = URL::to('img/man_avatar.jpg');

        // Set Avatar
        $fromProvider = OauthIdentity::where('user_id', $message->sender)->first();

        if (isset($fromProvider->avatar) && !empty($fromProvider->avatar)) {
            $message->sender_avatar = $fromProvider->avatar;
        } elseif (Storage::disk('local')->has( $message->sender . '.jpg')) {
            $message->sender_avatar = route('profile.image', ['filename' => $message->sender . '.jpg']);
        } else {
            $message->sender_avatar = $noAvatar;
        }
    }

    return $messages;
});

Route::get('/messages/mark_read/{id}', [
    'as' => 'messages.markAsRead',
    'uses' => 'MessageController@markAsRead'
]);

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