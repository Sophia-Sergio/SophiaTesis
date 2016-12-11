@extends('layout.masterAdmin')
@section('content')
	<div class="panel" style="padding-left:15px; padding-right:15px; text-align:center; margin:auto ">
		<h3><i class="fa fa-shield"></i> Docentes</h3>
		<hr>
		<table class="table  table-striped table-hover table-condensed " id="docentes" name="docentes">
		<thead>
			<th>id</th>
			<th>Nombre</th>
			<th>Apellido Paterno</th>
			<th>Apellido Materno</th>
			<th>Email</th>
			<th>estado</th>
			<th>Operacion</th>
		</thead>
		<tbody>
		@foreach($docentes as $docente)
			<tr>
				<td>{{$docente->id}}</td>
				<td>{{$docente->nombre}}</td>
				<td>{{$docente->apellido_paterno}}</td>
				<td>{{$docente->apellido_materno}}</td>
				<td>{{$docente->email}}</td>
				<td><?php if ($docente->estado == 1) echo "Activo";
			if ($docente->estado == 0) echo "Inactivo";?></td>
				<td>
					<a href="{{ route('editDocente', $docente->id ) }}" class="btn btn-primary">Editar
					</a>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>
@endsection