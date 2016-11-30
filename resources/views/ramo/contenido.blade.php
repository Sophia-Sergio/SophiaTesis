@extends('layout.masterUsuario')

@section('content')
    <?php
    $carrera = Session::get('carrera');
    $ramos = Session::get('ramos');
    $ramo = Session::get('ramo');
    $usuario = Session::get('user');
    $posteosRamos= Session::get('posteosRamo');
    $usuario_ramo_docenteFiles = Session::get('usuario_ramo_docenteFiles');
    $ramo_docenteFiles = Session::get('ramo_docenteFiles');
    ?>

    <link rel="stylesheet" href="{{asset('css/index_UsuarioMuro.css')}}">
    @include('alerts.request')
    <div class="container bootstrap snippet" Style="width:90%">
        <div class="row">
            <div class="panel" Style="padding-left:15px; padding-right:15px">
                <h2> Contenidos de {{ $ramo->nombre_ramo}} </h2>
                <hr/>
            </div>
            <div class="panel" Style="padding-left:15px; padding-right:15px; padding-top:15px">
                <span class="btn btn-primary fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Seleccionar Archivos</span>
                    <!-- The file input field used as target for the file upload widget -->
                    <input id="fileupload" type="file" name="document" data-token="{{ Session::token() }}" data-user-id="{{$usuario->id  }}"> <!-- Para seleccionar múltiples archivos !! <input id="fileupload" type="file" name="files[]" multiple> -->

                </span>
                <br>
                <br>
                <!-- The global progress bar -->
                <div id="progress" class="progress">
                    <div class="progress-bar progress-bar-success"></div>
                </div>

                <table class="table table-bordered table-striped table-hover">.
                    <caption>Documentos Privados</caption>
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Creado</th>
                        <th>Tamaño</th>
                        <th>Tipo</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($usuario_ramo_docenteFiles as $file)
                        <tr>
                            <td>{{$file->name}}</td>
                            <td>{{$file->created_at}}</td>
                            <td>{{$file->size}}</td>
                            <td>{{$file->extension}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <hr/>
            </div>
        </div>

        <div class="row">
            <div class="panel" Style="padding-left:15px; padding-right:15px; padding-top:15px">
                <table class="table table-bordered table-striped table-hover">.
                    <caption>Documentos P&uacute;blicos</caption>
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Creado</th>
                        <th>Tamaño</th>
                        <th>Tipo</th>
                        <th>Usuario</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ramo_docenteFiles as $file)
                        <tr>
                            <td>{{$file->name}}</td>
                            <td>{{$file->created_at}}</td>
                            <td>{{$file->size}}</td>
                            <td>{{$file->extension}}</td>
                            <td>{{$file->nombre}} {{$file->apellido}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <hr/>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@parent
<script>
   ;(function($)
    {
        'use strict';
        $(document).ready(function()
        {
            var $fileupload = $('#fileupload'),
            $upload_success = $('#upload-success');

            $fileupload.fileupload({
                url: '/upload',
                dataType: 'json',
                formData: {_token: $fileupload.data('token'), user_id: $fileupload.data('userId')},

                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#progress .progress-bar').css(
                            'width',
                            progress + '%'
                    );
                },
                done: function (e, data) {
                    $upload_success.removeClass('hide').hide().slideDown('fast');
                    setTimeout(function(){
                        location.reload();
                    }, 2000);
                }
            })
        });



    })(window.jQuery);
</script>
@stop