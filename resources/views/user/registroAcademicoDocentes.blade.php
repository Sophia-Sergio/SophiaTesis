@extends('layout.masterUsuario')

@section('title')
    Sophia | Registro Académico
@endsection


@section('content')
<div class="row" style="padding-top: 50px;">
    <div class="col-sm-10">
        <div class="panel panel-default">
            <div class="panel-body" style="padding-left:50px;  padding-top:25px; padding-right:50px; padding-bottom:30px" >

                <h3>Registro Academico - </h3>
                <p>
                    Para poder intercambiar material o comunicarte
                    con otros usuarios, es necesario que completes la siguiente informacion:
                </p>
                @include('user.forms.tomaDocentes')
            </div>
        </div>
    </div>
</div>
@endsection