@extends('layout.masterAdmin')
@section('content')
	<br>
	<br>
	<br>
	<table class="table">
		<thead>
			<th>id</th>
			<th>Nombre</th>
			<th>Tipo Institucion (1 - universidad; 2 - CFT; 3 - IP)</th>
			<th>Operacion</th>
		</thead>
		@foreach($instituciones as $institucion)
			<tbody>
				<td>{{$institucion->id}}</td>
				<td>{{$institucion->nombre_institucion}}</td>
				<td>{{$institucion->id_tipo_institucion}}</td>
				<td>
					<a href="{{ route('editInstitucion', $institucion->id ) }}" class="btn btn-primary">Editar
					</a>
				</td>
			</tbody>
		@endforeach
	</table>
</div>
@endsection