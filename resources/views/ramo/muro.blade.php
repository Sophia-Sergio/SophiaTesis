@extends('layout.masterUsuario')

@section('title')
    Sophia | Muro {{ $ramo->nombre_ramo}}
@endsection



    @section('content')
<?php
$carrera = Session::get('carrera');
$ramos = Session::get('ramos');
$usuario = Session::get('user');

if (Session::has('perfil'))
{
    $perfil = Session::get('perfil')->id_perfil;
}

?>
        <!-- http://bootdey.com/snippets/view/social-network-wall // de aquí saqué el template-->
<script type="text/javascript" src="{{ URL::asset('js/ramo/muro/controller.js') }}"></script>
<link rel="stylesheet" href="{{asset('css/index_UsuarioMuro.css')}}">
<div class="container bootstrap snippet" Style="width:80%">
    <div class="row">
        <div class="panel" Style="padding-left:15px; padding-right:15px">
            <h2> Muro de {{ $ramo->nombre_ramo}} </h2>
            <h4><a href="{{ route('news', ['ramo' => $ramo->id]) }}">Noticias</a></h4>
            <hr/>
        </div>
        <div id="postContent">
            @include('ramo.forms.postRamo')
            @foreach($posteosRamos as $posteoRamo)
                <div class="panel" id="post_{{ $posteoRamo->id }}" >

                    <div class="panel-body">

                    <div class="fb-user-thumb">
                        @if (Storage::disk('local')->has($posteoRamo->id_user.'.jpg'))
                            <img src="{{ route('profile.image', ['filename' =>$posteoRamo->id_user.'.jpg']) }}" alt="" class="img-circle">
                        @else
                            <img src="{{ URL::to('img/man_avatar.jpg')   }}" alt="" class="img-circle">
                        @endif
                    </div>
                    <div class="fb-user-details">
                        <h3><a href="#" class="#"> {{ $posteoRamo->nombre }} {{ $posteoRamo->apellido }}</a></h3>
                        <p>{{ $posteoRamo->created_at}}, USA</p>
                    </div>
                    <div class="clearfix"></div>
                    <p class="fb-user-status"> {{ $posteoRamo->contenido }}
                    </p>
                    <div class="fb-status-container fb-border">
                        <div class="fb-time-action">
                            <article class="post" data-postid="{{ $posteoRamo->id }}">
                                <a style="display:none">{{ $posteoRamo->contenido }}</a>

                                @if ($posteoRamo->is_like == true)
                                    <a href="javascript:" id="{{$posteoRamo->id}}" class="setLike" title="Ya no me gusta!!">Ya no me gusta</a>
                                @else
                                    <a href="javascript:" id="{{$posteoRamo->id}}" class="setLike" title="Me gusta!!">Me gusta</a>
                                @endif

                                <span>-</span>
                                <a href="#" title="Deja un comentario"data-toggle="collapse" data-target="#ver-comentarios-{{$posteoRamo->id}}" aria-expanded="false" aria-controls="collapseExample">Comentar</a>
                                <span>-</span>
                                @if($posteoRamo->id_user == $usuario->id  || $perfil=='3' )
                                    <span>-</span>
                                    <a href="#" class="edit" title="Edita tu comentario">Editar</a>
                                    <span>-</span>
                                    <a href="{{ route('postCarrera.delete', ['id_posteo' => $posteoRamo->id]) }}" title="Eliminar">Eliminar</a>
                                @endif
                            </article>
                        </div>
                    </div>

                        <di class="fb-status-container fb-border fb-gray-bg">
                            <div class="fb-time-action like-info">
                                {{--<a href="#">Jhon Due,</a>
                                <a href="#">Danieal Kalion</a>--}}
                                <span>A</span>
                                <a href="#" id="{{$posteoRamo->id}}_cont" >{{ $posteoRamo->n_like_str }}</a>
                                <span>les gusta esto</span>
                            </div>

                            <div class="clearfix"></div>
                        </di>
                    </div>
                    <div class="collapse" id="ver-comentarios-{{$posteoRamo->id}}">
                        <ul class="fb-comments">
                            @foreach($comentarioRamoPosts as $comentarioRamoPost)
                                @if ($comentarioRamoPost->id_post_ramo==$posteoRamo->id)
                                    <li>
                                        <div class="cmt-details">
                                            <a href="#">{{$comentarioRamoPost->nombre}}</a>
                                            <span> {{$comentarioRamoPost->contenido}}  </span>
                                            <p>{{$comentarioRamoPost->created_at}}</p>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        <div class="well">
                            <form action="{{ route('comentarPosteoRamo', ['id_posteo_ramo' => $posteoRamo->id], ['id_ramo' => $ramo->id]) }}" method="post">
                                <input type="text" class="form-control" style="width:70%" id="empresa" name="comentario" placeholder="Comenta" value="" required >
                                <button type="submit" class="btn btn-info pull-right" style="width:20%; margin-top:-33px;">Comentar</button>
                                <input type="hidden" value="{{ Session::token() }}" name="_token" id="_token">
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar posteo</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="post-body">Edit the Post</label>
                        <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="modal-save">Guardar Cambios</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    var token = '{{ Session::token() }}';
    var urlEdit = '{{ route('edit') }}';
</script>
