@extends('layout.user')

@section('content')
    <h1>Editar Archivo</h1>

    {{ Form::model($file, ['route' => ['api.file.update', $file->id], 'id' => 'edit-file']) }}

    <br><br>

    {{ Form::label('name', 'Nombre') }}
    {{ Form::text('name') }}

    <br><br>

    {{ Form::label('ramo', 'Ramo') }}
    <select name="selRamo" id="selRamo">
        <option value="0">Seleccionar</option>
    </select>

    <br><br>

Tipo de Archivo:
<select name="selTipo" id="selTipo">
    <option value="0">Seleccionar</option>
    <option value="1" {{ $file->type == 1 ? 'selected' : '' }}>Prueba</option>
    <option value="2" {{ $file->type == 2 ? 'selected' : '' }}>Trabajo o Tarea</option>
    <option value="3" {{ $file->type == 3 ? 'selected' : '' }}>Apunte de Clases</option>
    <option value="4" {{ $file->type == 4 ? 'selected' : '' }}>Tesis</option>
</select>


<br><br>

Privacidad:
<select name="selSeguridad" id="selSeguridad">
    <option value="0">Seleccionar</option>
    <option value="1" {{ $file->seguridad == 'Público' ? 'selected' : '' }}>Público</option>
    <option value="2">{{ $file->seguridad == 'Privado' ? 'selected' : '' }}Privado</option>
</select>

<br><br>

Descripción:
<textarea name="desc" id="desc" cols="30" rows="10">{{ $file->description }}</textarea>

<br><br>

<input type="submit" id="update" value="Actualizar">

<input type="text" id="docenteId" name="docenteId" readonly />
<input type="text" id="ramoId" name="ramoId" readonly />

    {{ Form::close() }}

@endsection

@push('scripts')
<script>
    // Obtener y asignar ramos del alumno
    let usrRamos    =   JSON.parse('{!! $currentUser->getRamos() !!}'),
        file        =   JSON.parse('{!! $file !!}');

    file.ramo       =   JSON.parse('{!! $file->ramo !!}');

    $.each(usrRamos, function(key, value) {
        $('#docenteId').val(value.docente_id);
        $('#ramoId').val(value.r_id);

        let sel = (file.id_usuario_ramo_docente == value.urd_id) ? 'selected' : '';

        let option = '<option value="'+value.urd_id+'" '+sel+'>'+value.r_name+'</option>';

        $('#selRamo').append(option);
    });

    // Subir Archivo
    $('#edit-file').on('submit', function(e) {
        e.preventDefault();

        if( !$('#name').val() || $('#selRamo').val() == 0 || $('#selTipo').val() == 0
            || $('#selSeguridad').val() == 0 || !$('#desc').val()) {

            alert('Datos Obligatorios');
            return false;
        }

        ajaxUpdateFile();
    });

    function ajaxUpdateFile() {
        $.ajax({
            method: "PUT",
            url: "/api/file/"+file.id,
            data: {
                name: $('#name').val(),
                type: $('#selTipo').val(),
                security: $('#selSeguridad').val(),
                description: $('#desc').val(),
                usuarioRamoDocente: $('#selRamo').val()
            },
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "bearer " + user.token);
            }
        }).done(function( res ) {
            if (res.status == 1) {
                alert('Archivo actualizado');
            } else {
                alert('Hemos sufrido un error al actualizar los datos');
            }
        });
    }
</script>
@endpush