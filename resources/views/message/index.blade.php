@extends('layout.masterUsuario')

@section('title')
Sophia | Registro Académico
@endsection


@section('content')
<div class="row" style="padding-top: 50px;">
    <div class="col-sm-10">
        <div class="panel panel-default">
            <div class="panel-body" style="padding-left:50px;  padding-top:25px; padding-right:50px; padding-bottom:30px" >

                <h3>Chats </h3>

                @if (count($messages) < 1)
                <p>
                    Actualmente no posees mensajes
                </p>
                @else
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Conversación con</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $used = []; ?>

                            @foreach ($messages as $message)
                                <tr>
                                    @if ($message->sender != Auth::user()->id && !in_array($message->sender, $used) && $message->message != '-')
                                        <?php array_push($used, $message->sender); ?>
                                        <td>{{ $message->sender_name }}</td>
                                        <td>
                                            <a href="{{ route('messages.show', [$message->uuid]) }}" class="btn btn-success">Ver Conversación</a>
                                        </td>
                                    @elseif($message->receiver != Auth::user()->id && !in_array($message->receiver, $used) && $message->message != '-')
                                        <?php array_push($used, $message->receiver); ?>
                                        <td>{{ $message->receiver_name }}</td>
                                        <td>
                                            <a href="{{ route('messages.show', [$message->uuid]) }}" class="btn btn-success">Ver Conversación</a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection