
<div class="col-sm-2">
</div>
<div class="col-sm-6">
	<div class="">

		<h3><i class="fa fa-shield"></i>Edición de Carreras</h3>
	  	<hr>

		<div class="form-group">
		  <label class="control-label" for="">Nombre</label>
		  <input type="text" class="form-control" name="nombre_carrera" placeholder="nombre_carrera" value="{{$carreraEditar->nombre_carrera}}">
		</div>
		{!!Form::submit('Actualizar',['class'=>'btn btn-primary', 'style'=>'width:100%'])!!}
	</div>
</div>