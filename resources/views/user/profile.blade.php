@extends('layout.masterUsuario')

@section('title')
    Sophia | Perfil
@endsection

@section('content')
    <?php
    $usuario = Session::get('user');
    ?>
    <div class="container bootstrap snippet" style="width:80%">
        <div class="row">
            <div class="panel">
                <section class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <header><h3>Tu Perfil </h3></header>
                        <form action="{{ route('updateProfile') }}" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="first_name">Nombre</label>
                                <input type="text" name="first_name" class="form-control" value="{{ $usuario->nombre }}" id="first_name">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Apellido</label>
                                <input type="text" name="last_name" class="form-control" value="{{ $usuario->apellido }}" id="last_name">
                            </div>
                            <div class="form-group">
                                <label for="fecha_nacimiento">Fecha Nacimiento</label>
                                <input type="text" name="fecha_nacimiento" class="form-control" value="{{ $usuario->fecha_nacimiento }}" id="fecha_nacimiento">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control" value="{{ $usuario->email }}" id="email">
                            </div>
                            <div class="form-group">
                                <label for="image">Seleccione Imagen (solamente .jpg)</label>
                                <input type="file" name="image" class="form-control" id="image">
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <input type="hidden" value="{{ Session::token() }}" name="_token">
                        </form>
                    </div>
                </section>
                <br/>
                @if (Storage::disk('local')->has($usuario->id . '.jpg'))
                    <section class="row">
                        <div class="col-md-6 col-md-offset-3" style="text-align: center; padding-bottom: 20px" >
                            <img class="img-circle"  src="{{ route('profile.image', ['filename' => $usuario->id . '.jpg']) }}" alt="" style="width:250px; height:250px">
                        </div>
                    </section>
                @endif
            </div>
        </div>
    </div>
@endsection