@extends('layout.masterUsuario')

@section('title')
    Sophia | Registro Académico
@endsection


@section('content')
    <div class="row" style="padding-top: 50px;">
        <div class="col-sm-10">
            <div class="panel panel-default">
                <div class="panel-body" style="padding-left:50px;  padding-top:25px; padding-right:50px; padding-bottom:30px" >

                    <div class="row current-chat-area">
                        <div class="col-md-12">
                            <ul class="media-list">
                                @foreach ($messages as $message)
                                    @if ($message->message != '-')
                                        <li class="media">
                                            <div class="media-body">
                                                <div class="media">
                                                    <a class="pull-left" href="#">
                                                        <img class="media-object img-circle" src="{{ URL::to('img/man_avatar.jpg') }}">
                                                    </a>
                                                    <div class="media-body">
                                                        {{ $message->message }}
                                                        <br>
                                                        <small class="text-muted">{{ $message->sender_name }} | {{ $message->formated_date }}</small>
                                                        <hr>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    {!! Form::open(['route' => 'messages.store']) !!}
                        <div style="display:none;">
                            <input type="text" id="uuid" name="uuid" value="{{ Request::segment(2) }}" readonly class="form-control">
                        </div>

                        <textarea name="message" id="message" cols="30" rows="10" class="form-control" required></textarea>


                        <br>
                        {{ Form::submit('Nuevo mensaje', ['class' => 'btn btn-success', 'style' => 'width: 100%']) }}
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection