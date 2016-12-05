
<div class="col-sm-2">
</div>
<div class="col-sm-6">
	<div class="">

		<h3><i class="fa fa-shield"></i>Edición de Usuarios</h3>
	  	<hr>

		<div class="form-group">
		  <label class="control-label" for="">Nombre</label>
		  <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="{{$usuarioEditar->nombre}}">
		</div>
		<div class="form-group">
		  <label class="control-label" for="">Apellido</label>
		  <input type="text" class="form-control" name="apellido" placeholder="Apellido" value="{{$usuarioEditar->apellido}}">
		</div>
		<div class="form-group">
		  <label class="control-label" for="">Email</label>
		  <input type="email" class="form-control" name="email" placeholder="Email" value="{{$usuarioEditar->email}}">
		</div>

		<div class="form-group">
		  <label class="control-label" for="">Password</label>
		  <input type="password" class="form-control" name="password" placeholder="Password" value="{{$usuarioEditar->password}}">
		</div>
		
	  	<div class="form-group">
	  	<label>Fecha de Nacimiento</label>
		  <input type="text" class="form-control" name="dia_nacimiento" placeholder="Password" value="{{$usuarioEditar->fecha_nacimiento}}">
	  	</div>
		<div class="form-group">
		  <label class="control-label" for="">Estado</label>
		  <input type="text" class="form-control" name="estado" placeholder="Email" value="{{$usuarioEditar->estado}}">
		</div>
		{!!Form::submit('Actualizar',['class'=>'btn btn-primary', 'style'=>'width:100%'])!!}
	</div>
</div>