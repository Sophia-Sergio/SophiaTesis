<?php
if (Session::has('perfil'))
{
	$perfil = Session::get('perfil')->id_perfil;
}

?>
<div class="col-sm-2">
</div>
<div class="col-sm-8">
	<div class="panel" style="padding-left:15px; padding-right:15px; text-align:center ">
		<h3><i class="fa fa-shield"></i> Creación de Usuarios</h3>
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
			<label class="control-label" for="">Activar o Desactivar usuario</label>
			<select class="form-control" name="estado" id="estado">
				<option  value="0" selected="selected" disabled="disabled">Seleccione...</option>
				<option  value="1"  <?php if ($usuarioEditar->estado == 1) echo "selected='selected'";?>>Activo</option>
				<option  value="0" <?php if ($usuarioEditar->estado == 0) echo "selected='selected'";?>>Inactivo</option>
			</select>
		</div>
		<div class="form-group">
			<label class="control-label" for="">Activar o Desactivar usuario</label>
			<select class="form-control" name="perfil" id="perfil">
				<option  value="0" selected="selected" disabled="disabled">Seleccione...</option>
				<option  value="1"  <?php if ($perfilUsuarioEditar->id_perfil== 1) echo "selected='selected'";?>>Administrador</option>
				<option  value="2" <?php if ($perfilUsuarioEditar->id_perfil == 2) echo "selected='selected'";?>>Estudiante</option>
				<option  value="3" <?php if ($perfilUsuarioEditar->id_perfil == 3) echo "selected='selected'";?>>Administrador de Ramo</option>
			</select>
		</div>

		{!!Form::submit('Actualizar',['class'=>'btn btn-primary', 'style'=>'width:100%'])!!}

		<hr>
	</div>
</div>