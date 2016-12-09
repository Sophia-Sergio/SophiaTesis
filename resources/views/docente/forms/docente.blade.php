<<<<<<< .mine

<div class="col-sm-2">
</div>
<div class="col-sm-6">
	<div class="">

		<h3><i class="fa fa-shield"></i>Edición de Carreras</h3>
	  	<hr>

		<div class="form-group">
		  <label class="control-label" for="">Nombre</label>
		  <input type="text" class="form-control" name="nombre" placeholder="nombre" value="{{$docenteEditar->nombre}}">
		</div>
		<div class="form-group">
			<label class="control-label" for="">Nombre</label>
			<input type="text" class="form-control" name="apellido_paterno" placeholder="apellido_paterno" value="{{$docenteEditar->apellido_paterno}}">
		</div>
		<div class="form-group">
			<label class="control-label" for="">Nombre</label>
			<input type="text" class="form-control" name="apellido_materno" placeholder="apellido_materno" value="{{$docenteEditar->apellido_materno}}">
		</div>
		<div class="form-group">
			<label class="control-label" for="">Nombre</label>
			<input type="text" class="form-control" name="email" placeholder="email" value="{{$docenteEditar->email}}">
		</div>
		<div class="form-group">
			<label class="control-label" for="">Nombre</label>
			<input type="text" class="form-control" name="estado" placeholder="estado" value="{{$docenteEditar->estado}}">
		</div>
		{!!Form::submit('Actualizar',['class'=>'btn btn-primary', 'style'=>'width:100%'])!!}
	</div>
</div>