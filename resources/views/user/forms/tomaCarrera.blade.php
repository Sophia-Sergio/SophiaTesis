<?php
$tipos_institucion = Session::get('tipos_institucion');
?>


<form action="{{ route('tomaCarrera') }}" method="post" name="tomaCarrera" id="tomaCarrera">
    <div class="form-group">
    <label >Selecciona tipo de Institución</label>
        <div>
            <Select class="form-control input-sm" name="tipo_institucion" id="tipo_institucion">
                <option value="0" disabled selected>Elija Tipo Instituci&oacute;n</option>
                @foreach($tipos_institucion as $tipo_inst)
                    <option value=" {{ @$tipo_inst->id }}">{{ @$tipo_inst->descripcion }}</option>
                @endforeach
            </Select>
        </div>
    </div>
    <div class="form-group">
        <label>Selecciona Institución</label>
        <div>
            <Select class="form-control input-sm" name="institucion" id="institucion">
                <option value="0" disabled selected>Elija Instituci&oacute;n</option>
            </Select>

        </div>
    </div>
    <div class="form-group">
        <label >Selecciona Carrera</label>
        <div >
            <Select class="form-control input-sm" name="carrera" id="carrera">
                <option value="0" disabled selected>Elija Carrera</option>
            </Select>
        </div>
    </div>
    <div class="form-group">
        <label >Selecciona Modalidad o R&eacute;gimen</label>
        <div >
            <Select class="form-control input-sm" name="regimen" id="regimen">
                <option value="0" disabled selected>Elija R&eacute;gimen</option>
                <option value="1">Diurno</option>
                <option value="2">Vespertino</option>
                <option value="3">Online</option>
            </Select>
        </div>
    </div>
    <div class="form-group">
        <label>Selecciona a&ntilde;o de inicio de esta Carrera</label>
        <div class="col-sm-16 multibox">
            <select class="form-control" name="anio" id ="anio">
                <option value="0" disabled="disabled" selected >Elija a&ntilde;o de inicio</option>
                <option value="2016">2016</option>
                <option value="2015">2015</option>
                <option value="2014">2014</option>
                <option value="2013">2013</option>
                <option value="2012">2012</option>
            </select>
        </div>
    </div>
    <input type="hidden" name="_token" value="{{ Session::token() }}">
    <button   type="submit" class="btn btn-primary">Siguiente</button>
</form>
<script>
    $('#tipo_institucion').on('change', function(e) {
        console.log(e);
        var tipo_institucion_id= e.target.value;

        $.get('/tomaInstitucion?tipo_institucion='+ tipo_institucion_id, function(data){
            console.log(data);
            $.each(data, function(index, institucionesObj){
                $('#institucion').append('<option value="'+institucionesObj.id+'">'+institucionesObj.nombre_institucion+'</option>');
            });
        });
        //ajax
    });
    $('#institucion').on('change', function(e) {
        console.log(e);
        var institucion_id= e.target.value;

        $.get('/tomaCarreras?institucion='+ institucion_id, function(data){
            console.log(data);
            $.each(data, function(index, carreraObj){
                $('#carrera').append('<option value="'+carreraObj.id+'">'+carreraObj.nombre_carrera+'</option>');
            });
        });
        //ajax
    });

</script>