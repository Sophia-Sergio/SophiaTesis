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

                    <h4>3 últimos archivos subidos</h4>

                    <table class="table table-bordered table-striped table-hover">.
                        <caption>Documentos P&uacute;blicos</caption>
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Creado</th>
                            <th>Tamaño</th>
                            <th>Tipo</th>
                            <th>Usuario</th>
                            <th>Likes</th>
                        </tr>
                        </thead>
                        <tbody id="tablePublic">
                        @foreach($files as $file)
                            <tr>
                                <td><a href="/download/{{$file->id}}">{{$file->name}}</a></td>
                                <td>{{$file->created_at}}</td>
                                <td>{{$file->size}}</td>
                                <td>{{$file->extension}}</td>
                                <td>{{$file->nombre}} {{$file->apellido}}</td>
                                <td>

                                    <span id="{{$file->id}}_cont" class="badge badge_like">{{ $file->n_like }}</span>

                                    @if ($file->is_like == true)
                                        <span id="{{$file->id}}" class="like like_active glyphicon glyphicon-thumbs-up"></span>
                                    @else
                                        <span id="{{$file->id}}" class="like glyphicon glyphicon-thumbs-up"></span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


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

                                    <div class="fb-status-container fb-border fb-gray-bg">

                                        <div class="fb-time-action like-info">
                                            <span>A</span>
                                            <a href="#" id="{{$post->id}}_cont" >{{ $post->n_like_str }}</a>
                                            <span>les gusta esto</span>
                                        </div>

                                        <ul class="fb-comments">
                                            <li>
                                                <a href="#" class="cmt-thumb">
                                                    <img src="http://bootdey.com/img/Content/avatar/avatar3.png" alt="">
                                                </a>
                                                <div class="cmt-details">
                                                    <a href="#">Jhone due</a>
                                                    <span> is world famous professional photographer.  with forward thinking clients to create beautiful, </span>
                                                    <p>40 minutes ago - <a href="#" class="like-link">Like</a></p>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="#" class="cmt-thumb">
                                                    <img src="http://bootdey.com/img/Content/avatar/avatar3.png" alt="">
                                                </a>
                                                <div class="cmt-details">
                                                    <a href="#">Tawseef</a>
                                                    <span> is world famous professional photographer.  with forward thinking clients to create beautiful, </span>
                                                    <p>34 minutes ago - <a href="#" class="like-link">Like</a></p>
                                                </div>
                                            </li>

                                            <li>
                                                <a href="#" class="cmt-thumb">
                                                    <img src="http://bootdey.com/img/Content/avatar/avatar4.png" alt="">
                                                </a>
                                                <div class="cmt-details">
                                                    <a href="#">Jhone due</a>
                                                    <span> is world famous professional photographer.   </span>
                                                    <p>15 minutes ago - <a href="#" class="like-link">Like</a></p>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="#" class="cmt-thumb">
                                                    <img src="http://bootdey.com/img/Content/avatar/avatar5.png" alt="">
                                                </a>
                                                <div class="cmt-details">
                                                    <a href="#">Tawseef</a>
                                                    <span> thinking clients to create beautiful world famous professional photographer.  </span>
                                                    <p>2 minutes ago - <a href="#" class="like-link">Like</a></p>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="#" class="cmt-thumb">
                                                    <img src="http://bootdey.com/img/Content/avatar/avatar8.png" alt="">
                                                </a>
                                                <div class="cmt-form">
                                                    <textarea class="form-control" placeholder="Write a comment..." name=""></textarea>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
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