@extends('layout.masterAdmin')
@section('content')
	<br>
	<br>
	<br>
	<table class="table">
		<thead>
			<th>id</th>
			<th>Nombre</th>
			<th>Apellido Paterno</th>
			<th>Apellido Materno</th>
			<th>Email</th>
			<th>estado</th>
			<th>Operacion</th>
		</thead>
		@foreach($docentes as $docente)
			<tbody>
				<td>{{$docente->id}}</td>
				<td>{{$docente->nombre}}</td>
				<td>{{$docente->apellido_paterno}}</td>
				<td>{{$docente->apellido_materno}}</td>
				<td>{{$docente->email}}</td>
				<td>{{$docente->estado}}</td>
				<td>
					<a href="{{ route('editDocente', $docente->id ) }}" class="btn btn-primary">Editar
					</a>
				</td>
			</tbody>
		@endforeach
	</table>
</div>
@endsection