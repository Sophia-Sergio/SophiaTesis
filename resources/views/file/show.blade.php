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

    <a href="">Editar Ficha</a>
    <br>
    <a href="">Eliminar</a>

    <br>
    <br>

    Subido Por: {{ $file->owner }}
    <br>
    Subido al Ramo: {{ $file->ramo }}
    <br>
    Fecha de Subida: {{ $file->uploadedTimeFormat2 }}
    <br>
    Tipo de Archivo: {{ $file->extension }}
    <br>
    Peso: {{ $file->humanSize }}
    <br>
    Descargas: {{ $file->analytic['downloaded'] }}
    <br>
    Compartidos: {{ $file->analytic['shared'] }}
    <br>
    Comentarios:
    <br>
    Favorito: {{ $file->analytic['favorite'] }}
    <br>
    Valorar: {{ $file->analytic['rating'] }} |
    <a class="rating" href="#">1</a> <a class="rating" href="#">2</a> <a class="rating" href="#">3</a>
@endsection

@push('scripts')
<script>
    let file = JSON.parse('{!! $file !!}');

    function updateAnalytic(data) {
        $.ajax({
            method: "PUT",
            url: "/api/file_user/1",
            data: {
                user: user.id,
                file: file.id,
                data
            },
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "bearer " + user.token);
            }
        }).done(function( res ) {
            console.log(res);
        });
    }

    $(document).on('click', '#download-link', function () {
        updateAnalytic({downloaded: 1});
    });

    $(document).on('click', '#shared-link', function () {
        updateAnalytic({shared: 1});
    });

    $(document).on('click', '#favorite-link', function () {
        updateAnalytic({favorite: 1});
    });

    $(document).on('click', '.rating', function () {
        updateAnalytic({rating: $(this).text()});
    });
</script>
@endpush