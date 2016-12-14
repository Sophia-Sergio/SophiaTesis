@extends('layout.masterUsuario')


@section('title')
    Sophia | Muro Carrera
@endsection

    @section('content')
<?php
$carrera = Session::get('carrera');
$ramos = Session::get('ramos');
$usuario = Session::get('user');
$posteosCarrera= Session::get('posteosCarrera');
if (Session::has('perfil'))
{
    $perfil = Session::get('perfil')->id_perfil;
}
?>
<!-- http://bootdey.com/snippets/view/social-network-wall // de aquí saqué el template-->
<script type="text/javascript" src="{{ URL::asset('js/carrera/dashboard/controller.js') }}"></script>
<link rel="stylesheet" href="{{asset('css/index_UsuarioMuro.css')}}">
<div class="container bootstrap snippet" Style="width:95%">
  <div class="row">
      <div class="col-sm-8">

        <div class="panel" Style="padding-left:15px; padding-right:15px; text-align:center">
            <h2> Muro de {{ $carrera->nombre_carrera }} </h2>
            <hr/>
        </div>
          <div id="postContent">
              @include('ramo.forms.postCarrera')
              @foreach($posteosCarrera as $posteoCarrera)
              <div class="panel" id="post_{{ $posteoCarrera->id }}">

                <div class="panel-body">

                    <div class="fb-user-thumb">
                        @if (Storage::disk('local')->has($posteoCarrera->id_user. '.jpg'))
                            <img src="{{ route('profile.image', ['filename' => $posteoCarrera->id_user. '.jpg']) }}" alt="" class="img-circle">
                        @else
                            <img src="{{ URL::to('img/man_avatar.jpg')   }}" alt="" class="img-circle">
                        @endif
                    </div>
                    <div class="fb-user-details">
                        <h3><a href="#" class="#"> {{ $posteoCarrera->nombre}} {{ $posteoCarrera->apellido }} </a></h3>
                        <p>{{ $posteoCarrera->created_at}}, USA</p>
                    </div>
                    <div class="clearfix"></div>
                    <p class="fb-user-status"> {{ $posteoCarrera->contenido }}
                                </p>
                    <div class="fb-status-container fb-border">
                        <div class="fb-time-action">
                            <article class="post">
                                <a style="display:none">{{ $posteoCarrera->contenido }}</a>

                                @if ($posteoCarrera->is_like == true)
                                    <a href="javascript:" id="{{$posteoCarrera->id}}" class="setLike" title="Ya no me gusta!!">Ya no me gusta</a>
                                @else
                                    <a href="javascript:" id="{{$posteoCarrera->id}}" class="setLike" title="Me gusta!!">Me gusta</a>
                                @endif

                                <span>-</span>
                                <a href="#" title="Deja un comentario" data-toggle="collapse" data-target="#ver-comentarios-{{$posteoCarrera->id}}" aria-expanded="false" aria-controls="collapseExample">Comentar</a>
                                <span>-</span>
                                @if($posteoCarrera->id_user == $usuario->id || $perfil=='3' )
                                    <span>-</span>
                                    <a href="#" class="edit" title="Edita tu comentario">Editar</a>
                                    <span>-</span>
                                    <a href="{{ route('postCarrera.delete', ['id_posteo' => $posteoCarrera->id]) }}" title="Eliminar">Eliminar</a>
                                @endif
                            </article>
                        </div>
                    </div>

                    <div class="fb-status-container fb-border fb-gray-bg">
                        <div class="fb-time-action like-info">
                            <span>A</span>
                            <a href="#" id="{{$posteoCarrera->id}}_cont" >{{ $posteoCarrera->n_like_str }}</a>
                            <span>les gusta esto</span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                  <div class="collapse" id="ver-comentarios-{{$posteoCarrera->id}}">
                      <ul class="fb-comments">
                      @foreach($comentarioCarreraPosts as $comentarioCarreraPost)
                          @if ($comentarioCarreraPost->id_post_carrera==$posteoCarrera->id)
                          <li>
                              <div class="cmt-details">
                                  <a href="#">{{$comentarioCarreraPost->nombre}}</a>
                                  <span> {{$comentarioCarreraPost->contenido}}  </span>
                                  <p>{{$comentarioCarreraPost->created_at}}</p>
                              </div>
                          </li>
                          @endif
                      @endforeach
                      </ul>
                      <div class="well">
                            <form action="{{ route('comentarPosteoCarrera', ['id_posteo_carrera' => $posteoCarrera->id]) }}" method="post">
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
      <div class="col-sm-4">
          <div class="panel" Style="padding-left:15px; padding-right:15px">
              <h2> Usuarios seguidos </h2>
              <hr>
              <div>
                  <div class="fb-status-container fb-border fb-gray-bg">
                      <ul class="fb-comments">

                          @foreach($elementosSeguidos as $elemento)
                              <li>



                                  <a href="#" class="cmt-thumb">
                                      @if (Storage::disk('local')->has($elemento->user_id. '.jpg'))
                                          <img src="{{ route('profile.image', ['filename' => $elemento->user_id. '.jpg']) }}" alt="" class="img-circle">
                                      @else
                                          <img src="{{ URL::to('img/man_avatar.jpg')   }}" alt="" class="img-circle">
                                      @endif
                                  </a>
                                  <div class="cmt-details">


                                      <a href="#"> {{ $elemento->user_nombre }}  {{ $elemento->user_apellido }}</a> <span style="color: #c3c3c3;">
                                      @if ($elemento->tipo_elemento == 'publicacion_ramo' || $elemento->tipo_elemento == 'publicacion_carrera')
                                              publicó
                                          @else
                                              subió un archivo
                                          @endif

                                          en {{ $elemento->nom_lugar }} - {{ $elemento->created_at}}</span>
                                      <p>
                                          @if ($elemento->tipo_elemento == 'publicacion_ramo')
                                              <a href="/ramo/muro/{{ $elemento->id_lugar }}#post_{{ $elemento->id }}" class="post-normal">{{ $elemento->contenido }}</a>
                                          @elseif ($elemento->tipo_elemento == 'publicacion_carrera')
                                              <a href="#post_{{ $elemento->id }}" class="post-normal">{{ $elemento->contenido }}</a>
                                          @else
                                              <a href="/download/{{ $elemento->id }}">{{ $elemento->contenido }}</a>
                                          @endif
                                      </p>
                                  </div>
                              </li>
                          @endforeach
                      </ul>
                  </div>
              </div>
          </div>
          <div class="panel" Style="padding-left:15px; padding-right:15px; text-align:center ">
              <h2> Publicidad</h2>
              <hr/>
              @if ($publicidad)
                @if (Storage::disk('local')->has('id'.$publicidad->id.'_publicidad.jpg'))
                  <section class="row" style="text-align:center">
                      <div class="" style="text-align: center; padding-bottom: 20px ;padding-left:15px; padding-right:15px; margin:auto" >
                          <a href="{{$publicidad->url}}">
                          <img class="img-responsive"  src="{{ route('publicidad.image', ['filename' => 'id'.$publicidad->id.'_publicidad.jpg']) }}" alt="" style="width:100%; height:250px">
                          </a>
                      </div>
                  </section>
                @endif
              @endif
          </div>
      </div>
  </div>
</div>
@endsection
<div class="modal fade" tabindex="-1" role="dialog" id="editPost">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edita </h4>
            </div>
            <div class="modal-body">
                <form>
                    <textarea type="text" id="contenido_editar" name="contenido_editar" class="form-control" rows="2"></textarea>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar cambios</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
