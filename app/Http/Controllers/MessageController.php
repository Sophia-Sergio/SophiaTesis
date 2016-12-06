<?php

namespace Sophia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Sophia\Http\Requests\StoreMessage;
use Sophia\Message;
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

        foreach ($users as $user) {
            $query1 = Message::where('sender', $user->id)
                ->where('receiver', Auth::user()->id)
                ->get();

            $query2 = Message::where('sender', Auth::user()->id)
                ->where('receiver', $user->id)
                ->get();

            $messages = $query1->merge($query2);
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

        return redirect()->route('messages.show', ['id' => $uuid]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $messages = Message::where('uuid', $id)->orderBy('created_at', 'desc')->get();

        foreach ($messages as $message) {
            $senderName = User::find($message->sender);
            $message->sender_name = $senderName->getFullName();

            $receiverName = User::find($message->receiver);
            $message->receiver_name = $receiverName->getFullName();

            $date = Carbon::createFromFormat('Y-m-d H:i:s', $message->created_at)->format('E\l d-m-Y \a \l\a\s H:i');
            $message->formated_date = $date;
        }

        return view('message.show', compact('messages'));
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
}
