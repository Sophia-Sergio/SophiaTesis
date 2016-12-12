@extends('layout.masterAdmin')
@section('content')
    <div class="panel" style="padding-left:15px; padding-right:15px; text-align:center ">
        <h3><i class="fa fa-shield"></i> Creación de Publicidad</h3>
        <hr>
        <form id="f_nueva_publicidad"  method="post" enctype="multipart/form-data" action="agregarPublicidadAdmin" class="form_entrada" >
            <div class="form-group">
                <label class="control-label" for="" >Empresa</label>
                <input type="text" class="form-control" id="empresa" name="empresa" placeholder="Empresa" value="" required >
            </div>
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="form-group">
                <label class="control-label" for="" >Ingrese URL</label>
                <input type="url" class="form-control" id="url" name="url" placeholder="url" value="" required >
            </div>
            <div class="form-group">
                <label for="image">Seleccione Imagen (solamente .jpg)</label>
                <input type="file" name="image" class="form-control" id="image">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-block" id="enviar" value="Enviar">
            </div>
        </form>

    </div>
@endsection
