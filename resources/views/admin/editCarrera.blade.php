@extends('layout.masterAdmin')
	@section('content')
	@include('alerts.request')
		{!!Form::model($carreraEditar,['route'=> ['updateCarrera', $carreraEditar], 'method'=>'GET'])!!}
		@include('carrera.forms.carr')
		{!!Form::close()!!}
	@endsection
