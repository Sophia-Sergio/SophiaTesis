@extends('layout.masterAdmin')
@section('content')
	<div class="panel" style="padding-left:15px; padding-right:15px; text-align:center; margin:auto ">
		<h3><i class="fa fa-shield"></i> Carreras</h3>
		<hr>
		<table class="table  table-striped table-hover table-condensed " id="carreras" name="carreras">
		<thead>
			<th class="header" style=" text-align:center; padding-right: 12px">id</th>
			<th class="header" style=" text-align:center; padding-right: 12px">Nombre Carrera</th>
			<th class="header" style=" text-align:center; padding-right: 12px">Operacion</th>
		</thead>
		<tbody>
		@foreach($carreras as $carrera)
			<tr>
				<td>{{$carrera->id}}</td>
				<td>{{$carrera->nombre_carrera}}</td>
				<td>
					<a href="{{ route('editCarrera', $carrera->id ) }}" class="btn btn-primary">Editar
					</a>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>
@endsection