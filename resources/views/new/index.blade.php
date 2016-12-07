@extends('layout.masterUsuario')

@section('title')
    Sophia | Registro Académico
@endsection


@section('content')
    <div class="row" style="padding-top: 50px;">
        <div class="col-sm-10">
            <div class="panel panel-default">
                <div class="panel-body" style="padding-left:50px;  padding-top:25px; padding-right:50px; padding-bottom:30px" >

                    <h3>Noticias </h3>

                    <h4>3 últimos post que han recibido likes</h4>

                    <div id="postContent">
                        @foreach($posts as $post)
                            <div class="panel" >
                                <div class="panel-body">
                                    <div class="fb-user-thumb">
                                        <img src="{{ \Sophia\User::getAvatar($post->id_user) }}" alt="" class="img-circle">
                                    </div>

                                    <div class="fb-user-details">
                                        <h3><a href="#" class="#"> {{ \Sophia\User::find($post->id_user)->getFullName() }}</a></h3>
                                        <p>{{ $post->created_at}}</p>
                                    </div>

                                    <div class="clearfix"></div>

                                    <p class="fb-user-status">
                                        {{ $post->contenido }}
                                    </p>

                                    <div class="fb-status-container fb-border">
                                        <div class="fb-time-action">
                                            <article class="post" data-postid="{{ $post->id }}">
                                                <a style="display:none">{{ $post->contenido }}</a>

                                                @if ($post->is_like == true)
                                                    <a href="javascript:" id="{{$post->id}}" class="setLike" title="Ya no me gusta!!">Ya no me gusta</a>
                                                @else
                                                    <a href="javascript:" id="{{$post->id}}" class="setLike" title="Me gusta!!">Me gusta</a>
                                                @endif

                                                <span>-</span>
                                                <a href="#" title="Deja un comentario">Comentar</a>
                                                <span>-</span>
                                                <a href="#" title="Comparte con tus compañeros">Compartir</a>
                                                @if($post->id_user == Auth::user()->id  || $perfil=='3' )
                                                    <span>-</span>
                                                    <a href="#" class="edit" title="Edita tu comentario">Editar</a>
                                                    <span>-</span>
                                                    <a href="{{ route('postCarrera.delete', ['id_posteo' => $post->id]) }}" title="Eliminar">Eliminar</a>
                                                @endif
                                            </article>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection