<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Message extends Model
{
    protected $fillable = [
        'uuid', 'sender', 'receiver', 'message', 'read', 'ramo_id'
    ];

    /**
     * Relación DB users
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function users()
    {
        return $this->hasOne('Sophia\User', 'id', 'id_user');
    }

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

    public static function getChatsByUser($ramos, $currentUser)
    {
        // Obtener compañeros
        $users = DB::table('usuario_ramo_docentes')
            ->join('ramo_docentes', 'usuario_ramo_docentes.id_ramo_docente', '=', 'ramo_docentes.id')
            ->join('ramos', 'ramo_docentes.id_ramo', '=', 'ramos.id')
            ->join('users', 'usuario_ramo_docentes.id_usuario', '=', 'users.id')
            ->whereIn('ramos.id', $ramos)
            ->distinct()
            ->orderBy('nombre_ramo')
            ->get();

        $uniqueUsers = [];

        foreach ($users as $user) {
            if (!array_key_exists($user->id, $uniqueUsers) && $user->id != $currentUser) {
                $uniqueUsers[$user->id] = $user->id;
            }
        }

        // Obtener conversaciones con los compañeros
        $conversations = Message::where(function ($query) use ($currentUser, $uniqueUsers) {
            $query->where('sender', '=', $currentUser)
                ->whereIn('receiver', $uniqueUsers)
                ->where('message', '<>', '-');
        })->orWhere(function ($query) use ($currentUser, $uniqueUsers) {
            $query->where('receiver', '=', $currentUser)
                ->whereIn('sender', $uniqueUsers)
                ->where('message', '<>', '-');
        })->orderBy('created_at', 'desc')
            ->get();

        $uniqueConversation = [];

        foreach ($conversations as $conversation) {
            if (!array_key_exists($conversation->uuid, $uniqueUsers)) {
                $conversation->sender   =   User::find($conversation->sender);
                $conversation->receiver =   User::find($conversation->receiver);

                $uniqueConversation[$conversation->uuid] = $conversation;
            }
        }

        return $uniqueConversation;
    }
}
