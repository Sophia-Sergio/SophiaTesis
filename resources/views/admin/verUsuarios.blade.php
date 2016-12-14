@extends('layout.masterAdmin')
@section('content')


	<div class="panel" style="padding-left:15px; padding-right:15px; text-align:center ">
	<h3><i class="fa fa-shield"></i> Usuarios</h3>
	<hr>
	<table class="table  table-striped table-hover table-condensed " id="usuarios" name="usuarios">
		<thead>
			<th class="header" style=" text-align:center; padding-right: 12px">id usuario</th>
			<th class="header" style=" text-align:center; padding-right: 12px">Nombre</th>
			<th class="header" style=" text-align:center; padding-right: 12px">Apellido</th>
			<th class="header" style=" text-align:center; padding-right: 12px">Fecha Nacimiento</th>
			<th class="header" style=" text-align:center; padding-right: 12px">Email</th>
			<th class="header" style=" text-align:center; padding-right: 12px">Perfil</th>
			<th class="header" style=" text-align:center; padding-right: 12px">Estado</th>
			<th class="header" style=" text-align:center; padding-right: 12px">Operacion</th>
		</thead>
		<tbody>
		@foreach($usuarios as $usuario)
			<tr>
				<td>{{$usuario->id}}</td>
				<td>{{$usuario->nombre}}</td>
				<td>{{$usuario->apellido}}</td>
				<td>{{$usuario->fecha_nacimiento}}</td>
				<td>{{$usuario->email}}</td>
				<td>{{$usuario->descripcion_perfil}}</td>
				<td><?php if ($usuario->estado == 1) echo "Activo";
					if ($usuario->estado == 0) echo "Inactivo";;?></td>
				<td>
					<a href="{{ route('editUser', $usuario->id ) }}" class="btn btn-primary">Editar
					</a>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>

@endsection
