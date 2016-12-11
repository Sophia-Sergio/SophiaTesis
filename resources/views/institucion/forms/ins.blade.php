<div class="col-sm-2">
</div>
<div class="col-sm-8">
	<div class="panel" style="padding-left:15px; padding-right:15px; text-align:center ">
		<h3><i class="fa fa-shield"></i> Edición de Institución</h3>
		<hr>
		<div class="form-group">
		  <label class="control-label" for="">Nombre</label>
		  <input type="text" class="form-control" name="nombre_institucion" placeholder="nombre_institucion" value="{{$institucionEditar->nombre_institucion}}">
		</div>
		<div class="form-group">
			<label class="control-label" for="">Tipo de Institución</label>
			<select class="form-control" name="id_tipo_institucion" id="id_tipo_institucion">
				<option  value="1" <?php if ($institucionEditar->id_tipo_institucion== 1) echo "selected='selected'";?>>Universidad</option>
				<option  value="2" <?php if ($institucionEditar->id_tipo_institucion== 2) echo "selected='selected'";?>>Centro de Formación Técnica</option>
				<option  value="3" <?php if ($institucionEditar->id_tipo_institucion== 3) echo "selected='selected'";?>>Instituto Profesional</option>
			</select>
		</div>
		{!!Form::submit('Actualizar',['class'=>'btn btn-primary', 'style'=>'width:100%'])!!}
		<hr>
	</div>
</div>