@extends('layout.masterUsuario')

@section('content')
    <link rel="stylesheet" href="{{asset('css/index_UsuarioMuro.css')}}">
    @include('alerts.request')
    <div class="container bootstrap snippet" Style="width:90%">

        <section id="content-title" class="row">
            <div class="panel" Style="padding-left:15px; padding-right:15px">
                <h2> Contenidos de {{ $ramo->nombre_ramo}} </h2>
                <hr/>
            </div>
        </section>

        <section id="content-upload" class="row">
            <div class="panel" Style="padding-left:15px; padding-right:15px">
                <h4> Subir Archivos </h4>
                <hr/>

                <div class="form-group col-md-6" style="padding-left: 0px;">
                    <label for="selSeguridad">Seguridad</label>
                    <select class="form-control" id="selSeguridad">
                        <option value="1" selected>Publico</option>
                        <option value="2">Privado</option>
                    </select>
                </div>
                <div class="form-group col-md-6" style="padding-left: 0px;">
                    <label for="selTipo">Tipo Archivo</label>
                    <select class="form-control" id="selTipo">
                        <option value="0">Seleccione...</option>
                        <option value="1">Prueba</option>
                        <option value="2">Trabajo o Tarea</option>
                        <option value="3">Apunte de Clases</option>
                        <option value="4">Tesis</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-4">
                            <span class="btn btn-primary fileinput-button">
                                <i class="glyphicon glyphicon-plus"></i>
                                <span>Seleccionar Archivos</span>
                                <input id="fileupload" type="file" name="document" data-token="{{ Session::token() }}" data-user-id="{{Auth::user()->id  }}"> <!-- Para seleccionar m?ltiples archivos !! <input id="fileupload" type="file" name="files[]" multiple> -->
                            </span>
                    </div>

                    <div class="col-md-8" style="padding-top: 5px;">
                        <div id="progress" class="progress">
                            <div class="progress-bar progress-bar-success"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="row">
            <div class="panel" Style="padding-left:15px; padding-right:15px; padding-top:15px">

                <h4>Mis Archivos</h4>
                <hr>

                <table id="private-files-table" class="table table-striped table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Creado</th>
                            <th>Tamaño</th>
                            <th>Extensión</th>
                            <th>Tipo</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <section class="row">
            <div class="panel" Style="padding-left:15px; padding-right:15px; padding-top:15px">
                <h4>Archivos Públicos</h4>
                <hr>
                <table id="public-files-table" class="table table-striped table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Creado</th>
                        <th>Tamaño</th>
                        <th>Extensión</th>
                        <th>Tipo</th>
                        <th>Subido Por</th>
                        <th>Acción</th>

                    </tr>
                    </thead>
                </table>

            </div>
        </section>
    </div>

@endsection
@push('scripts')
<script>
    let idUsuarioRamoDocente    =   "{{ $data->id_usuario_ramo_docente }}",
        idDocente               =   "{{ $data->id_docente }}",
        idRamoDocente           =   "{{ $data->id_ramo_docente }}",
        idRamo                  =   "{{ $ramo->id }}",
        token                   =   "{{ Session::token() }}";

    $(function() {
        genPrivateTable();
        genPublicTable();
    });
</script>

<script type="text/javascript" src="{{ URL::asset('js/ramo/contenido/controller.js') }}"></script>
@endpush