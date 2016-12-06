<div class="col-sm-2">
</div>
<div class="col-sm-6">
<div id="notificacion_resul_fanu"></div>
	<div class="">
		<h3><i class="fa fa-shield"></i> Creación de Carreras</h3>
	  	<hr>
	  	<form id="f_nuevo_usuario" method="post" action="agregarCarreraAdmin" class="form-horizontal form_entrada" >
	  	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">    
			<div class="form-group">
			  <label class="control-label" for="" >Nombre</label>
			  <input type="text" class="form-control" id="nombre_carrera" name="nombre_carrera" placeholder="Nombre" value="" required >
			</div>
			<div class="form-group">
			  <input type="submit" class="btn btn-primary btn-block" value="Enviar">
			</div>
		</form>			
	</div>
</div>
      <!-- cargador empresa -->