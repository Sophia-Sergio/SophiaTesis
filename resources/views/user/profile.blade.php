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
                        <header><h3>Tu Perfil</h3></header>
                        <form action="{{ route('updateProfile') }}" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="first_name">Nombre</label>
                                <input type="text" name="first_name" class="form-control" value="{{ $usuario->nombre }}" id="first_name">
                            </div>
                            <div class="form-group">
                                <label for="first_name">Apellido</label>
                                <input type="text" name="first_name" class="form-control" value="{{ $usuario->apellido }}" id="first_name">
                            </div>
                            <div class="form-group">
                                <label for="first_name">Fecha Nacimiento</label>
                                <input type="text" name="first_name" class="form-control" value="{{ $usuario->fecha_nacimiento }}" id="first_name">
                            </div>
                            <div class="form-group">
                                <label for="first_name">Email</label>
                                <input type="text" name="first_name" class="form-control" value="{{ $usuario->email }}" id="first_name">
                            </div>
                            <div class="form-group">
                                <label for="image">Seleccione Imagen (solamente .jpg)</label>
                                <input type="file" name="image" class="form-control" id="image">
                            </div>
                            <button type="submit" class="btn btn-primary">Save Account</button>
                            <input type="hidden" value="{{ Session::token() }}" name="_token">
                        </form>
                    </div>
                </section>
                <br/>
                @if (Storage::disk('local')->has( $usuario->nombre . '-' . $usuario->id . '.jpg'))
                    <section class="row">
                        <div class="col-md-6 col-md-offset-3" style="text-align: center">
                            <img class="img-rounded" style="width:60%; padding-bottom: 20px" src="{{ route('profile.image', ['filename' => $usuario->nombre . '-' . $usuario->id . '.jpg']) }}" alt="" class="img-responsive">
                        </div>
                    </section>
                @endif
            </div>
        </div>
    </div>
@endsection