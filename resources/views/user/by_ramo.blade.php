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

<script type="text/javascript" src="{{ URL::asset('js/users/ramo/controller.js') }}"></script>

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
                                <th>Seguir</th>
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
                                        <td>
                                            <a href="javascript:" id="{{ $user->id }}" class="btn btn-success btn-seguir" style="width:130px">
                                            @if ($user->siguiendo == true)
                                                Dejar de seguir
                                            @else
                                                Seguir
                                            @endif
                                            </a>
                                        </td>
                                        @if ($perfil=='3')
                                            @if ($user->estado==1)
                                                <form action="{{ route('AdmEstudianteBloquearUsuario', ['id_user'=>$user->id]) }}" method="post">
                                                    <td>
                                                        <input type="hidden" value="{{ Session::token() }}" name="_token" id="_token">
                                                        <button class="btn btn-success btn-seguir" style="width:130px" type="submit">Bloquear</button>                                               </button>
                                                    </td>

                                                </form>
                                            @endif
                                                @if ($user->estado==0)
                                                    <form action="{{ route('AdmEstudianteDesbloquearUsuario', ['id_user'=>$user->id]) }}" method="post">
                                                        <td>
                                                            <input type="hidden" value="{{ Session::token() }}" name="_token" id="_token">
                                                            <button class="btn btn-success btn-seguir" style="width:130px" type="submit">Bloqueado</button>                                               </button>
                                                        </td>

                                                    </form>
                                                @endif
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