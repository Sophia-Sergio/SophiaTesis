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

				</td>
			</tbody>
		@endforeach
	</table>
</div>
@endsection