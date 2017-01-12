@extends('layout.masterUsuario')

@section('title')
    Sophia | Perfil
@endsection

@section('content')
    <div class="container bootstrap snippet" style="width:80%">
        <div class="row">
            <div class="panel">
                <section class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <header><h3>Tu Perfil </h3></header>
                        {!! Form::open(['route' => 'user.update_profile', $user->id, 'files' => true]) !!}

                        <div class="form-group" style="display:none;">
                            {{ Form::text('edad', $user->edad, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('nombre', 'Nombre') }}
                            {!! Form::text('nombre', $user->nombre, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <label for="last_name">Apellido</label>
                            <input type="text" name="apellido" class="form-control" value="{{ $user->apellido }}" id="apellido">
                        </div>

                        <div class="form-group">
                            <label for="fecha_nacimiento">Fecha Nacimiento</label>
                            <input type="text" name="fecha_nacimiento" class="form-control" value="{{ $user->fecha_nacimiento }}" id="fecha_nacimiento">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}">
                        </div>

                        <div class="form-group">
                            <label for="image">Seleccione Imagen (solamente .jpg)</label>
                            {{ Form::file('avatar', ['class' => 'form-control']) }}
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar</button>

                        {!! Form::close() !!}
                    </div>
                </section>
                <br/>
                <section class="row">
                    <div class="col-md-6 col-md-offset-3" style="text-align: center; padding-bottom: 20px" >
                        <img class="img-circle"  src="{{ $user->avatar }}" alt="" style="width:250px; height:250px">
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection