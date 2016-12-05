@extends('layout.masterAdmin')
	@section('content')
	@include('alerts.request')
		{!!Form::model($usuario,['route'=> ['usuario.update', $usuario], 'method'=>'PUT'])!!}
		@include('usuario.forms.usr')


		{!!Form::close()!!}
	@endsection
