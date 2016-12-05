@extends('layout.masterAdmin')
	@section('content')
	@include('alerts.request')
		{!!Form::model($institucionEditar,['route'=> ['updateInstitucion', $institucionEditar], 'method'=>'GET'])!!}
		@include('institucion.forms.ins')
		{!!Form::close()!!}
	@endsection
