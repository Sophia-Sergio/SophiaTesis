@extends('layout.masterUsuario')

@section('content')
    <?php
    $carrera = Session::get('carrera');
    $ramos = Session::get('ramos');
    $ramo = Session::get('ramo');
    $usuario = Session::get('user');
    $posteosRamos= Session::get('posteosRamo');
    ?>

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
                                <input id="fileupload" type="file" name="document" data-token="{{ Session::token() }}" data-user-id="{{$usuario->id  }}"> <!-- Para seleccionar m?ltiples archivos !! <input id="fileupload" type="file" name="files[]" multiple> -->
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
                        <th>Subido Por</th>
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
        </section>
    </div>

@endsection
@push('scripts')
<script>
    // Validar datos necesarios al subir archivo
    $('#fileupload').click(function(){
        if ($("#selSeguridad").val() == "0") {
            alert("Debes seleccionar la seguridad");
            return false;
        }

        if ($("#selTipo").val() == "0") {
            alert("Debes seleccionar el tipo de archivo");
            return false;
        }
    });

    /**
     * Eliminar un archivo
     *
     * @param id
     */
    function deleteFile(id) {
        $.ajax({
            method: "POST",
            url: siteUrl+"files/"+id,
            data: { _method: 'delete', _token :"{{ Session::token() }}", idFile: id }
        })
                .done(function( response ) {
                    if (response.status == 1) {
                        genPrivateTable()
                        genPublicTable();
                    }
                });
    }

    function toggleLikeFile(id) {
        $.ajax({
            method: "GET",
            url: siteUrl+"/likeFile/"+id,
            data: { _token :"{{ Session::token() }}", idFile: id }
        })
        .done(function( response ) {
            $("."+id+"_cont").empty().text(response.totalLikes);

            if ($(".like-"+id).hasClass('like_active')) {
                $(".like-"+id).removeClass('like_active');
            } else {
                $(".like-"+id).addClass('like_active');
            }
        });
    }

    $(function() {
        genPrivateTable();
        genPublicTable();
    });

    function genPrivateTable() {

        $('#private-files-table').DataTable({
            processing: true,
            serverSide: true,
            "bDestroy": true,
            "language": {
                "url": "{{ URL::to('/js/dataTables-es.json') }}"
            },
            ajax: {
                url: '{!! route('files.privateDataTable', ['idRamo' => $ramo->id]) !!}',
                method: 'POST'
            },
            columns: [
                { data: 'name', name: 'name' },
                { data: 'created_at', name: 'created_at' },
                { data: 'size', name: 'size' },
                { data: 'extension', name: 'extension' },
                { data: 'type', name: 'type' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                            .on('change', function () {
                                column.search($(this).val()).draw();
                            });
                });

                // Formatos
                $('th input').addClass('form-control');
                $("#private-foot-name input").css("max-width", "130px")
                $("#private-foot-created input").css("max-width", "130px");
                $("#private-foot-size input").css("max-width", "100px");
                $("#private-foot-type input").css("max-width", "130px");
                $("#private-foot-action input").hide();
            }
        });
    }

    function genPublicTable() {

        $('#public-files-table').DataTable({
            processing: true,
            serverSide: true,
            "bDestroy": true,
            "language": {
                "url": "{{ URL::to('/js/dataTables-es.json') }}"
            },
            ajax: {
                url: '{!! route('files.publicDataTable', ['idRamo' => $ramo->id]) !!}',
                method: 'POST'
            },
            columns: [
                { data: 'nombre', name: 'nombre' },
                { data: 'name', name: 'name' },
                { data: 'created_at', name: 'created_at' },
                { data: 'size', name: 'size' },
                { data: 'extension', name: 'extension' },
                { data: 'type', name: 'type' },
                { data: 'action', name: 'action' }
            ],
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                            .on('change', function () {
                                column.search($(this).val()).draw();
                            });
                });

                // Formatos
                $('th input').addClass('form-control');
                $("#public-foot-name input").css("max-width", "130px")
                $("#public-foot-created input").css("max-width", "130px");
                $("#public-foot-size input").css("max-width", "100px");
                $("#public-foot-type input").css("max-width", "130px");
                $("#public-foot-action input").hide();
            }
        });
    }

    // Click en botón eliminar
    $(document).on('click', ".btn-danger",function(){
        event.preventDefault();
        var split = this.id.split("-");
        deleteFile(split[1]);
    });

    // Click en el botón like
    $(document).on('click', ".like",function(){
        event.preventDefault();
        var split = this.id.split("-");
        toggleLikeFile(split[1]);
    });
</script>

<!-- Lógica Upload -->
<script type="text/javascript" src="{{ URL::asset('js/ramo/contenido/controller.js') }}"></script>
@endpush