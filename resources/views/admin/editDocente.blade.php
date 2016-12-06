@extends('layout.masterAdmin')
	@section('content')
	@include('alerts.request')
		{!!Form::model($docenteEditar,['route'=> ['updateDocente', $docenteEditar], 'method'=>'GET'])!!}
		@include('docente.forms.docente')
		{!!Form::close()!!}
	@endsection
