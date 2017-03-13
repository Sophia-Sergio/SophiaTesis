@extends('layout.user')

@section('content')
    {!! Form::open(['url' => 'api/file/create', 'id' => 'upload-form', 'files' => 'true']) !!}
        Archivo: {{ Form::file('document', ['id' => 'document']) }}

        <br><br>

        Nombre: <input type="text" id="fileName" name="fileName">

        <br><br>

        Ramo:
        <select name="selRamo" id="selRamo">
            <option value="0">Seleccionar</option>
        </select>

        <br><br>

        Tipo de Archivo:
        <select name="selTipo" id="selTipo">
            <option value="0">Seleccionar</option>
            <option value="1">Prueba</option>
            <option value="2">Trabajo o Tarea</option>
            <option value="3">Apunte de Clases</option>
            <option value="4">Tesis</option>
        </select>


        <br><br>

        Privacidad:
        <select name="selSeguridad" id="selSeguridad">
            <option value="0" >Seleccionar</option>
            <option value="1" >Público</option>
            <option value="2">Privado</option>
        </select>

        <br><br>

        Descripción:
        <textarea name="desc" id="desc" cols="30" rows="10"></textarea>

        <br><br>

        <input type="checkbox" name="accept" id="accept" value="1"> Acepto

        <br><br>

        <input type="submit" id="btnUpload" value="Subir">

        <input type="text" id="docenteId" name="docenteId" readonly />
        <input type="text" id="ramoId" name="ramoId" readonly />
    {!! Form::close() !!}
@endsection

@push('scripts')
<script>
    // Obtener y asignar ramos del alumno
    let usrRamos = JSON.parse('{!! $currentUser->getRamos() !!}');

    $.each(usrRamos, function(key, value) {
        $('#docenteId').val(value.docente_id);
        $('#ramoId').val(value.r_id);
        $('#selRamo').append('<option value="'+value.urd_id+'">'+value.r_name+'</option>');
    });

    // Subir Archivo
    $('#upload-form').on('submit', function(e) {
        e.preventDefault();

        if( !$('#document').val() || !$('#fileName').val() || $('#selRamo').val() == 0
            || $('#selTipo').val() == 0 || $('#selSeguridad').val() == 0 || !$('#desc').val()
            || !$('#accept').prop('checked')) {
            //alert('Todos los datos son obligatorios');
            //return false;
        }

        ajaxUploadFile();
    });

    function ajaxUploadFile() {
        var inputFileImage = document.getElementById('document');
        var file = inputFileImage.files[0];
        var data = new FormData();

        data.append('document', file);
        data.append('user', user.id);
        data.append('name', $('#fileName').val());
        data.append('ramo', $('#ramoId').val());
        data.append('type', $('#selTipo').val());
        data.append('security', $('#selSeguridad').val());
        data.append('description', $('#desc').val());
        data.append('usuarioRamoDocente', $('#selRamo').val());
        data.append('teacher', $('#docenteId').val());

        $.ajax({
            method: "POST",
            url: "/api/file/create",
            contentType:false,
            data:data,
            processData:false,
            cache:false,
            /*data: {
                user: user.id,
                name: $('#fileName').val(),
                ramo: $('#ramoId').val(),
                type: $('#selTipo').val(),
                security: $('#selSeguridad').val(),
                description: $('#desc').val(),
                usuarioRamoDocente: $('#selRamo').val(),
                teacher: $('#docenteId').val(),
                document: $('#document').val(),
                doc: file,
            },*/
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "bearer " + user.token);
            }
        }).done(function( res ) {
            console.log( res );
        });
    }

</script>
@endpush