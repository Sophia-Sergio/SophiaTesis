<div class="col-sm-2">
</div>
<div class="col-sm-8">
<div id="notificacion_resul_fanu"></div>
	<div class="panel" style="padding-left:15px; padding-right:15px; text-align:center">
		<h3><i class="fa fa-shield"></i> Creación de Usuarios</h3>
	  	<hr>
	  	<form id="f_nuevo_usuario" method="post" action="agregarUsuarioAdmin" class="form_entrada" >
	  	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">    
			<div class="form-group">
			  <label class="control-label" for="" >Nombre</label>
			  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="{{ Request::old('nombre') }}" required >
			</div>
			<div class="form-group">
			  <label class="control-label" for="">Apellido</label>
			  <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido" value="{{ Request::old('apellido') }}"required >
			</div>
			<div class="form-group">
			  <label class="control-label" for="">Email</label>
			  <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="" required >
			</div>
			<div class="form-group">
			  <label class="control-label" for="">Password</label>
			  <input type="text" class="form-control" name="password" id="password" placeholder="Password" value="" required >
			</div>
			<div class="form-group">
				<label class="control-label" for="">Password Confirmación</label>
				<input type="text" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Password" value="" required >
			</div>
			<div class="form-group">
				<label>Fecha de Nacimiento</label>
				<div class="form-group">
					<div class="col-sm-4 multibox">
						<select class="form-control" name="birth_day" id ="birth_day">
							<option value="0" <?php if (Request::old('birth_day') == null) echo "selected='selected'";?> disabled="disabled" >D&iacute;a...</option>
							<option value="1" <?php if (Request::old('birth_day') == 1) echo "selected='selected'";?> >1</option>
							<option value="2" <?php if (Request::old('birth_day') == 2) echo "selected='selected'";?> >2</option>
							<option value="3" <?php if (Request::old('birth_day') == 3) echo "selected='selected'";?> >3</option>
							<option value="4" <?php if (Request::old('birth_day') == 4) echo "selected='selected'";?> >4</option>
							<option value="5" <?php if (Request::old('birth_day') == 5) echo "selected='selected'";?> >5</option>
							<option value="6" <?php if (Request::old('birth_day') == 6) echo "selected='selected'";?> >6</option>
							<option value="7" <?php if (Request::old('birth_day') == 7) echo "selected='selected'";?> >7</option>
							<option value="8" <?php if (Request::old('birth_day') == 8) echo "selected='selected'";?> >8</option>
							<option value="9" <?php if (Request::old('birth_day') == 9) echo "selected='selected'";?> >9</option>
							<option value="10" <?php if (Request::old('birth_day') == 10) echo "selected='selected'";?> >10</option>
							<option value="11" <?php if (Request::old('birth_day') == 11) echo "selected='selected'";?> >11</option>
							<option value="12" <?php if (Request::old('birth_day') == 12) echo "selected='selected'";?> >12</option>
							<option value="13" <?php if (Request::old('birth_day') == 13) echo "selected='selected'";?> >13</option>
							<option value="14" <?php if (Request::old('birth_day') == 14) echo "selected='selected'";?> >14</option>
							<option value="15" <?php if (Request::old('birth_day') == 15) echo "selected='selected'";?> >15</option>
							<option value="16" <?php if (Request::old('birth_day') == 16) echo "selected='selected'";?> >16</option>
							<option value="17" <?php if (Request::old('birth_day') == 17) echo "selected='selected'";?> >17</option>
							<option value="18" <?php if (Request::old('birth_day') == 18) echo "selected='selected'";?> >18</option>
							<option value="19" <?php if (Request::old('birth_day') == 19) echo "selected='selected'";?> >19</option>
							<option value="20" <?php if (Request::old('birth_day') == 20) echo "selected='selected'";?> >20</option>
							<option value="21" <?php if (Request::old('birth_day') == 21) echo "selected='selected'";?> >21</option>
							<option value="22" <?php if (Request::old('birth_day') == 22) echo "selected='selected'";?> >22</option>
							<option value="23" <?php if (Request::old('birth_day') == 23) echo "selected='selected'";?> >23</option>
							<option value="24" <?php if (Request::old('birth_day') == 24) echo "selected='selected'";?> >24</option>
							<option value="25" <?php if (Request::old('birth_day') == 25) echo "selected='selected'";?> >25</option>
							<option value="26" <?php if (Request::old('birth_day') == 26) echo "selected='selected'";?> >26</option>
							<option value="27" <?php if (Request::old('birth_day') == 27) echo "selected='selected'";?> >27</option>
							<option value="28" <?php if (Request::old('birth_day') == 28) echo "selected='selected'";?> >28</option>
							<option value="29" <?php if (Request::old('birth_day') == 29) echo "selected='selected'";?> >29</option>
							<option value="30" <?php if (Request::old('birth_day') == 30) echo "selected='selected'";?> >30</option>
							<option value="31" <?php if (Request::old('birth_day') == 31) echo "selected='selected'";?> >31</option>
						</select>
					</div>
					<div class="col-sm-4 multibox">
						<select class="form-control" name="birth_month" id ="birth_month">
							<option value="0" <?php if (Request::old('birth_month') == null) echo "selected='selected'";?> disabled="disabled">Mes...</option>
							<option value="1" <?php if (Request::old('birth_month') == 1) echo "selected='selected'";?> >Enero</option>
							<option value="2" <?php if (Request::old('birth_month') == 2) echo "selected='selected'";?> >Febrero</option>
							<option value="3" <?php if (Request::old('birth_month') == 3) echo "selected='selected'";?> >Marzo</option>
							<option value="4" <?php if (Request::old('birth_month') == 4) echo "selected='selected'";?> >Abril</option>
							<option value="5" <?php if (Request::old('birth_month') == 5) echo "selected='selected'";?> >Mayo</option>
							<option value="6" <?php if (Request::old('birth_month') == 6) echo "selected='selected'";?> >Junio</option>
							<option value="7" <?php if (Request::old('birth_month') == 7) echo "selected='selected'";?> >Julio</option>
							<option value="8" <?php if (Request::old('birth_month') == 8) echo "selected='selected'";?> >Agosto</option>
							<option value="9" <?php if (Request::old('birth_month') == 9) echo "selected='selected'";?> >Septiembre</option>
							<option value="10" <?php if (Request::old('birth_month') == 10) echo "selected='selected'";?> >Octubre</option>
							<option value="11" <?php if (Request::old('birth_month') == 11) echo "selected='selected'";?> >Noviembre</option>
							<option value="12" <?php if (Request::old('birth_month') == 12) echo "selected='selected'";?> >Diciembre</option>
						</select>
					</div>
					<div class="col-sm-4 multibox">
						<select class="form-control" name="birth_year" id ="birth_year">
							<option value="0" <?php if (Request::old('birth_year') == null) echo "selected='selected'";?>  disabled="disabled">A&ntilde;o...</option>
							<option value="1970" <?php if (Request::old('birth_year') == 1970) echo "selected='selected'";?> >1970</option>
							<option value="1971" <?php if (Request::old('birth_year') == 1971) echo "selected='selected'";?> >1971</option>
							<option value="1972" <?php if (Request::old('birth_year') == 1972) echo "selected='selected'";?> >1972</option>
							<option value="1973" <?php if (Request::old('birth_year') == 1973) echo "selected='selected'";?> >1973</option>
							<option value="1974" <?php if (Request::old('birth_year') == 1974) echo "selected='selected'";?> >1974</option>
							<option value="1975" <?php if (Request::old('birth_year') == 1975) echo "selected='selected'";?> >1975</option>
							<option value="1976" <?php if (Request::old('birth_year') == 1976) echo "selected='selected'";?> >1976</option>
							<option value="1977" <?php if (Request::old('birth_year') == 1977) echo "selected='selected'";?> >1977</option>
							<option value="1978" <?php if (Request::old('birth_year') == 1978) echo "selected='selected'";?> >1978</option>
							<option value="1979" <?php if (Request::old('birth_year') == 1979) echo "selected='selected'";?> >1979</option>
							<option value="1980" <?php if (Request::old('birth_year') == 1980) echo "selected='selected'";?> >1980</option>
							<option value="1981" <?php if (Request::old('birth_year') == 1981) echo "selected='selected'";?> >1981</option>
							<option value="1982" <?php if (Request::old('birth_year') == 1982) echo "selected='selected'";?> >1982</option>
							<option value="1983" <?php if (Request::old('birth_year') == 1983) echo "selected='selected'";?> >1983</option>
							<option value="1984" <?php if (Request::old('birth_year') == 1985) echo "selected='selected'";?> >1984</option>
							<option value="1985" <?php if (Request::old('birth_year') == 1985) echo "selected='selected'";?> >1985</option>
							<option value="1986" <?php if (Request::old('birth_year') == 1986) echo "selected='selected'";?> >1986</option>
							<option value="1987" <?php if (Request::old('birth_year') == 1987) echo "selected='selected'";?> >1987</option>
							<option value="1988" <?php if (Request::old('birth_year') == 1988) echo "selected='selected'";?> >1988</option>
							<option value="1989" <?php if (Request::old('birth_year') == 1989) echo "selected='selected'";?> >1989</option>
							<option value="1990" <?php if (Request::old('birth_year') == 1990) echo "selected='selected'";?> >1990</option>
							<option value="1991" <?php if (Request::old('birth_year') == 1991) echo "selected='selected'";?> >1991</option>
							<option value="1992" <?php if (Request::old('birth_year') == 1992) echo "selected='selected'";?> >1992</option>
							<option value="1993" <?php if (Request::old('birth_year') == 1993) echo "selected='selected'";?> >1993</option>
							<option value="1994" <?php if (Request::old('birth_year') == 1994) echo "selected='selected'";?> >1994</option>
							<option value="1995" <?php if (Request::old('birth_year') == 1995) echo "selected='selected'";?> >1995</option>
							<option value="1996" <?php if (Request::old('birth_year') == 1996) echo "selected='selected'";?> >1996</option>
							<option value="1997" <?php if (Request::old('birth_year') == 1997) echo "selected='selected'";?> >1997</option>
							<option value="1998" <?php if (Request::old('birth_year') == 1998) echo "selected='selected'";?> >1998</option>
							<option value="1999" <?php if (Request::old('birth_year') == 1999) echo "selected='selected'";?> >1999</option>
							<option value="2000" <?php if (Request::old('birth_year') == 2000) echo "selected='selected'";?> >2000</option>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label" for="">Activar o Desactivar usuario</label>
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