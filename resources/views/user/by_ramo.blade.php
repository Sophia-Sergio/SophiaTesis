@extends('layout.masterUsuario')

@section('title')
Sophia | Registro Académico
@endsection
<?php
if (Session::has('perfil'))
{
$perfil = Session::get('perfil')->id_perfil;
}
?>
@section('content')
<div class="row" style="padding-top: 50px;">
    <div class="col-sm-10">
        <div class="panel panel-default">
            <div class="panel-body" style="padding-left:50px;  padding-top:25px; padding-right:50px; padding-bottom:30px" >

                <h3>Compañeros </h3>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Mensaje</th>
                                @if ($perfil=='3')
                                    <th>Bloquear</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                @if ($user->id != Auth::user()->id)
                                    <tr>
                                        <td>{{ $user->nombre }}</td>
                                        <td>{{ $user->apellido }}</td>
                                        <td><a href="{{ route('messages.check_msg', ['user1' => $user->id, 'user2' => Auth::user()->id]) }}" class="btn btn-success">Enviar Mensaje</a></td>
                                        @if ($perfil=='3')
                                        <td>
                                            <select class="form-control" name="perfil" id="perfil">
                                                <option  value="0" selected="selected" disabled="disabled">Seleccione...</option>
                                                <option  value="1"  <?php if ($user->estado== 1) echo "selected='selected'";?>>Activo</option>
                                                <option  value="0" <?php if ($user->estado == 0) echo "selected='selected'";?>>Inactivo</option>
                                            </select>
                                        </td>
                                        @endif
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
@endsection