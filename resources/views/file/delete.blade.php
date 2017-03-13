@extends('layout.user')

@section('content')

    <img src="http://lorempixel.com/50/50/technics/" alt="Tipo de Archivo">
    <br>
    <a id="favorite-link" href="#">Like</a>
    <br>
    Subido por {{ $file->owner }}
    <br>
    {{ $file->uploadedTime }}
    <br>
    <a href="">Reportar Problema</a> / <a href="">Denunciar Archivo</a>
    <br>
    Privacidad: {{ $file->seguridad }}
    <br><br>
    <strong>{{ $file->name }}</strong>
    <br>
    {{ $file->description }}

    <br><br>

    <a id="download-link" href="/api/file/{{ $file->id }}?token={{ JWTAuth::fromUser(Auth::user()) }}">Descargar</a>
    <br>
    <a id="shared-link" href="#">Compartir</a>

    <br><br>

    Descargas: {{ $file->analytic['downloaded'] }}
    <br>
    Compartidos: {{ $file->analytic['shared'] }}
    <br>
    Comentarios:
    <br>
    Favorito: {{ $file->analytic['favorite'] }}

    <br><br>

    Valorar: {{ $file->analytic['rating'] }} |
    <a class="rating" href="#">1</a> <a class="rating" href="#">2</a> <a class="rating" href="#">3</a>

    <br><br>

    ¿Por qué eliminas este archivo?

    <br>
    {{ Form::radio('for-what', 1) }} Ya no lo quiero compartir <br>
    {{ Form::radio('for-what', 2) }} Existe una versión actualizada <br>
    {{ Form::radio('for-what', 3) }} El contenido es irrelevante <br>
    {{ Form::radio('for-what', 4) }} Otro {{ Form::text('another') }} <br>

    <br>

    <input type="button" value="Eliminar" id="delete-file">

@endsection

@push('scripts')
<script>
    let file = JSON.parse('{!! $file !!}');

    function deleteFile() {
        $.ajax({
            method: "DELETE",
            url: "/api/file/"+file.id,
            data: {
                reason: $('input[name=for-what]:checked').val(),
                desc: $('input[name=another]').val(),
            },
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "bearer " + user.token);
            }
        }).done(function( res ) {
            console.log(res);
        });
    }

    $(document).on('click', '#delete-file', function() {
        deleteFile();
    });
</script>
@endpush