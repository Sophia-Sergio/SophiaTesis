@extends('layout.masterAdmin')
@section('content')
	<br>
	<br>
	<br>
	<table class="table">
		<thead>
			<th>id</th>
			<th>Nombre Carrera</th>
			<th>Operacion</th>
		</thead>
		@foreach($carreras as $carrera)
			<tbody>
				<td>{{$carrera->id}}</td>
				<td>{{$carrera->nombre_carrera}}</td>
				<td>
					<a href="{{ route('editCarrera', $carrera->id ) }}" class="btn btn-primary">Editar
					</a>
				</td>
			</tbody>
		@endforeach
	</table>
</div>
@endsection