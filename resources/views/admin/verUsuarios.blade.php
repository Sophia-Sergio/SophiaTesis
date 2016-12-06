@extends('layout.masterAdmin')
@section('content')
	<br>
	<br>
	<br>
	<table class="table">
		<thead>
			<th>id</th>
			<th>Nombre</th>
			<th>Apellido</th>
			<th>Fecha Nacimiento</th>
			<th>Email</th>
			<th>Estado</th>
			<th>Operacion</th>
		</thead>
		@foreach($usuarios as $usuario)
			<tbody>
				<td>{{$usuario->id}}</td>
				<td>{{$usuario->nombre}}</td>
				<td>{{$usuario->apellido}}</td>
				<td>{{$usuario->fecha_nacimiento}}</td>
				<td>{{$usuario->email}}</td>
				<td>{{$usuario->estado}}</td>

				<td>
					<a href="{{ route('editUser', $usuario->id ) }}" class="btn btn-primary">Editar
					</a>
				</td>
			</tbody>
		@endforeach
	</table>
</div>
@endsection