
<div class="col-sm-2">
</div>
<div class="col-sm-6">
	<div class="">

		<h3><i class="fa fa-shield"></i>Edición de Instituciones</h3>
	  	<hr>

		<div class="form-group">
		  <label class="control-label" for="">Nombre</label>
		  <input type="text" class="form-control" name="nombre_institucion" placeholder="nombre_institucion" value="{{$institucionEditar->nombre_institucion}}">
		</div>
		<div class="form-group">
		  <label class="control-label" for="">ID Tipo Institucion (1 - universidad; 2 - CFT; 3 - IP)</label>
		  <input type="text" class="form-control" name="id_tipo_institucion" placeholder="id_tipo_institucion" value="{{$institucionEditar->id_tipo_institucion}}">
		</div>
		{!!Form::submit('Actualizar',['class'=>'btn btn-primary', 'style'=>'width:100%'])!!}
	</div>
</div>