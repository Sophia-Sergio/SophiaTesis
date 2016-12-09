<?php

namespace Sophia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Sophia\Http\Requests\StoreMessage;
use Sophia\Message;
use Sophia\OauthIdentity;
use Sophia\User;
use Carbon\Carbon;

class MessageController extends Controller
{
    public function __construct()
    {
        if(!Auth::user())
            redirect('/');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function myMessages($ramo)
    {
        $users = DB::table('usuario_ramo_docentes')
            ->join('ramo_docentes', 'usuario_ramo_docentes.id_ramo_docente', '=', 'ramo_docentes.id')
            ->join('ramos', 'ramo_docentes.id_ramo', '=', 'ramos.id')
            ->join('users', 'usuario_ramo_docentes.id_usuario', '=', 'users.id')
            ->where('ramos.id', $ramo)
            ->distinct()
            ->orderBy('nombre_ramo')
            ->get();

        $messages = [];
        $count = 0;
        foreach ($users as $user) {
            $query1 = Message::where('sender', $user->id)
                ->where('receiver', Auth::user()->id)
                ->get();

            $query2 = Message::where('sender', Auth::user()->id)
                ->where('receiver', $user->id)
                ->get();

            if ($count == 0)
                $messages = $query1->merge($query2);
            else
                $messages = $messages->merge($query1)->merge($query2);

            $count++;
        }

        foreach ($messages as $message) {
            $senderName = User::find($message->sender);
            $message->sender_name = $senderName->getFullName();

            $receiverName = User::find($message->receiver);
            $message->receiver_name = $receiverName->getFullName();
        }

        return view('message.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($request['uuid']) && !empty($request['uuid']))
            $uuid = $request['uuid'];
        else
            $uuid = substr(md5(microtime()),rand(0,26),10);

        $message = Message::where('uuid', $uuid)->first();

        Message::create([
            'uuid' => $request['uuid'],
            'sender' => Auth::user()->id,
            'receiver' => Auth::user()->id != $message->receiver ? $message->receiver : $message->sender,
            'message' => $request['message']
        ]);

        return response()->json(['status' => 1], 200);

        //return redirect()->route('messages.show', ['id' => $uuid]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Actualizar los mensajes a leídos
        Message::where('uuid', $id)
            ->where('receiver', Auth::user()->id)
            ->update(['read' => 1]);

        $messages = Message::where('uuid', $id)->orderBy('created_at', 'desc')->get();

        foreach ($messages as $message) {
            // Set sender name
            $senderName = User::find($message->sender);
            $message->sender_name = $senderName->getFullName();

            // Set receiver name
            $receiverName = User::find($message->receiver);
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

        return view('message.show', compact('messages'));
    }

    public function chats($uuid)
    {
        $messages = Message::where('uuid', $uuid)
            ->where('message', '<>', '-')
            ->orderBy('created_at', 'asc')
            ->get();

        foreach ($messages as $message) {
            // Set sender name
            $senderName = User::find($message->sender);
            $message->sender_name = $senderName->getFullName();

            // Set receiver name
            $receiverName = User::find($message->receiver);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function checkmsg($user1, $user2)
    {
        $messages = Message::where('sender', $user1)
            ->where('receiver', $user2)
            ->first();

        if (!empty($messages)) {
            return redirect()->route('messages.show', ['id' => $messages->uuid]);
        }

        $messages = Message::where('sender', $user2)
            ->where('receiver', $user1)
            ->first();

        if (!empty($messages)) {
            return redirect()->route('messages.show', ['id' => $messages->uuid]);
        }

        $uuid = substr(md5(microtime()),rand(0,26),10);

        Message::create([
            'uuid' => $uuid,
            'sender' => $user1,
            'receiver' => $user2,
            'message' => '-'
        ]);

        return redirect()->route('messages.show', ['id' => $uuid]);
    }

    /**
     * Marcar mensaje como leído
     *
     * @param $id
     */
    public function markAsRead($id)
    {
        Message::where('uuid', $id)
            ->where('receiver', Auth::user()->id)
            ->update(['read' => 1]);
    }
}
