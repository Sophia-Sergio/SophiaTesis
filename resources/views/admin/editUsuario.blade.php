@extends('layout.masterAdmin')
	@section('content')
	@include('alerts.request')
		{!!Form::model($usuarioEditar,['route'=> ['updateUser', $usuarioEditar], 'method'=>'GET'])!!}
		@include('user.forms.usr')
		{!!Form::close()!!}
	@endsection
