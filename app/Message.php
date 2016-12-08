<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'uuid', 'sender', 'receiver', 'message', 'read'
    ];

    public function getAllMessagesByUser($user)
    {
        $messages = Message::where('sender', $user)
            ->orWhere('receiver', $user)
            ->get();

        if(empty($messages))
            return null;

        foreach ($messages as $message) {
            $senderName = User::find($message->sender);
            $message->sender_name = $senderName->getFullName();

            $receiverName = User::find($message->receiver);
            $message->receiver_name = $receiverName->getFullName();
        }

        return $messages;
    }
}
