<div class="col-sm-2">
</div>
<div class="col-sm-8">
	<div class="panel" style="padding-left:15px; padding-right:15px; text-align:center ">
		<h3><i class="fa fa-shield"></i> Creación de Docentes</h3>
	  	<hr>
	  	<form id="f_nuevo_usuario" method="post" action="agregarDocenteAdmin" class="form_entrada" >
	  	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">    
			<div class="form-group">
			  <label class="control-label" for="" >Nombre</label>
			  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="" required >
			</div>
			<div class="form-group">
				<label class="control-label" for="" >Apellido Paterno</label>
				<input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" placeholder="Apellido Paterno" value="" required >
			</div>
			<div class="form-group">
				<label class="control-label" for="" >Apellido Materno</label>
				<input type="text" class="form-control" id="apellido_materno" name="apellido_materno" placeholder="Apellido Materno" value="" required >
			</div>
			<div class="form-group">
				<label class="control-label" for="" >Email</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="Email" value="" required >
			</div>
			<div class="form-group">
				<label class="control-label" for="">Activar o Desactivar docente</label>
				<select class="form-control" name="estado" id="estado">
					<option  value="0" selected="selected" disabled="disabled">Seleccione...</option>
					<option  value="1">ACTIVO</option>
					<option  value="0">INACTIVO</option>
				</select>
			</div>
			<div class="form-group">
			  <input type="submit" class="btn btn-primary btn-block" value="Enviar">
			</div>
		</form>
	</div>
</div>
      <!-- cargador empresa -->