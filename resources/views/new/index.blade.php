@extends('layout.masterUsuario')

@section('title')
    Sophia | Registro Académico
@endsection

<?php
if (Session::has('perfil')) {
    $perfil = Session::get('perfil')->id_perfil;
}
?>

@section('content')
    <div class="row" style="padding-top: 50px;">
        <div class="col-sm-10">
            <div class="panel panel-default">
                <div class="panel-body" style="padding-left:50px;  padding-top:25px; padding-right:50px; padding-bottom:30px" >

                    <h3>Noticias </h3>

                    <h4>Últimos archivos relevantes</h4>

                    @if(isset($files) && !empty($files->count()))
                        <table class="table table-bordered table-striped table-hover">.
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Creado</th>
                                <th>Tamaño</th>
                                <th>Tipo</th>
                                <th>Usuario</th>
                            </tr>
                            </thead>
                            <tbody id="tablePublic">
                            @foreach($files as $file)
                                <tr>
                                    <td><a href="/download/{{$file->id_file}}">{{$file->name}}</a></td>
                                    <td>{{$file->created_at}}</td>
                                    <td>{{$file->size}}</td>
                                    <td>{{$file->extension}}</td>
                                    <td>{{$file->nombre}} {{$file->apellido}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Actualmente no existen archivos relevantes</p>
                    @endif

                    <h4 style="margin-top: 50px;">Últimos post más relevantes</h4>

                    @if(isset($posts) && !empty($posts->count()))
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
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>No existen post relevantes</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript" src="<?php echo e(URL::asset('js/ramo/contenido/controller.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('js/ramo/muro/controller.js')); ?>"></script>
@endpush