<div class="col-sm-2">
</div>
<div class="col-sm-8">
	<div class="panel" style="padding-left:15px; padding-right:15px; text-align:center ">
		<h3><i class="fa fa-shield"></i>Edición de Docentes</h3>
	  	<hr>
		<div class="form-group">
		  <label class="control-label" for="">Nombre</label>
		  <input type="text" class="form-control" name="nombre" placeholder="nombre" value="{{$docenteEditar->nombre}}">
		</div>
		<div class="form-group">
			<label class="control-label" for="">Apellido Paterno</label>
			<input type="text" class="form-control" name="apellido_paterno" placeholder="apellido_paterno" value="{{$docenteEditar->apellido_paterno}}">
		</div>
		<div class="form-group">
			<label class="control-label" for="">Apellido Materno</label>
			<input type="text" class="form-control" name="apellido_materno" placeholder="apellido_materno" value="{{$docenteEditar->apellido_materno}}">
		</div>
		<div class="form-group">
			<label class="control-label" for="">Email</label>
			<input type="text" class="form-control" name="email" placeholder="email" value="{{$docenteEditar->email}}">
		</div>
		<div class="form-group">
			<label class="control-label" for="">Activar o Desactivar usuario</label>
			<select class="form-control" name="estado" id="estado">
				<option  value="0" selected="selected" disabled="disabled">Seleccione...</option>
				<option  value="1"  <?php if ($docenteEditar->estado == 1) echo "selected='selected'";?>>Activo</option>
				<option  value="0" <?php if ($docenteEditar->estado == 0) echo "selected='selected'";?>>Inactivo</option>
			</select>
		</div>
		{!!Form::submit('Actualizar',['class'=>'btn btn-primary', 'style'=>'width:100%'])!!}
		<hr>
	</div>
</div>