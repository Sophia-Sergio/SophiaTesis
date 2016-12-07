@extends('layout.masterUsuario')

@section('content')
    <?php
    $carrera = Session::get('carrera');
    $ramos = Session::get('ramos');
    $ramo = Session::get('ramo');
    $usuario = Session::get('user');
    $posteosRamos= Session::get('posteosRamo');
    ?>

    <script type="text/javascript" src="{{ URL::asset('js/ramo/contenido/controller.js') }}"></script>

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
                    <input id="fileupload" type="file" name="document" data-token="{{ Session::token() }}" data-user-id="{{$usuario->id  }}"> <!-- Para seleccionar m?ltiples archivos !! <input id="fileupload" type="file" name="files[]" multiple> -->

                </span>
                <br>
                <br>
                <!-- The global progress bar -->
                <div id="progress" class="progress">
                    <div class="progress-bar progress-bar-success"></div>
                </div>

                <div class="form-group col-md-6" style="padding-left: 0px;">
                    <label for="selSeguridad">Seguridad</label>
                    <select class="form-control" id="selSeguridad">
                        <option value="1" selected>Publico</option>
                        <option value="2">Privado</option>
                    </select>
                </div>
                <div class="form-group col-md-6" style="padding-left: 0px;">
                    <label for="selTipo">Tipo Archivo</label>
                    <select class="form-control" id="selSeguridad">
                        <option value="0">Seleccione...</option>
                        <option value="1">Prueba</option>
                        <option value="2">Trabajo o Tarea</option>
                        <option value="3">Apunte de Clases</option>
                        <option value="4">Tesis</option>
                    </select>
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
                    <tbody id="tablePrivate">
                    @foreach($archivos_privados as $file)
                        <tr>
                            <td><a href="/download/{{$file->id}}">{{$file->name}}</a></td>
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
            <div class="form-group col-md-6" style="padding-left: 15px; padding-top:15px">
                <label for="selTipo">Tipo Contenido</label>
                <select class="form-control" id="selSeguridad">
                    <option value="0">Seleccione...</option>
                    <option value="1">Prueba</option>
                    <option value="2">Trabajo o Tarea</option>
                    <option value="3">Apunte de Clases</option>
                    <option value="4">Tesis</option>
                </select>
            </div>
            <div class="form-group col-md-6" style="padding-left: 15px; padding-top:15px">
                <label for="selTipo">Ordenar</label>
                <select class="form-control" id="selSeguridad">
                    <option value="0">Seleccione...</option>
                    <option value="1">Más valorados</option>
                    <option value="2">Más descargados</option>
                    <option value="3">Por fecha ascendentes</option>
                    <option value="4">Por fecha descendente</option>

                </select>
            </div>
            <div class="panel" Style="padding-left:15px; padding-right:15px; padding-top:15px">
                <table class="table table-bordered table-striped table-hover">.
                    <caption>Documentos P&uacute;blicos</caption>
                    <thead>
                    <tr>
                        <th>Tipo Contenido</th>
                        <th>Nombre</th>
                        <th>Creado</th>
                        <th>Tamaño</th>
                        <th>Tipo</th>
                        <th>Usuario</th>
                        <th>Likes</th>
                    </tr>
                    </thead>
                    <tbody id="tablePublic">
                    @foreach($archivos_publicos as $file)
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
                <hr/>
            </div>
        </div>
    </div>

@endsection
