<div class="col-sm-2">
</div>
<div class="col-sm-8">
	<div class="panel" style="padding-left:15px; padding-right:15px; text-align:center ">

		<h3><i class="fa fa-shield"></i>Edición de Carreras</h3>
	  	<hr>

		<div class="form-group">
		  <label class="control-label" for="">Nombre</label>
		  <input type="text" class="form-control" name="nombre_carrera" placeholder="nombre_carrera" value="{{$carreraEditar->nombre_carrera}}">
		</div>
		{!!Form::submit('Actualizar',['class'=>'btn btn-primary', 'style'=>'width:100%'])!!}
		<hr>
	</div>
</div>