@extends('layout.user')

@section('content')
    Seleccionar Año de ingreso
    <select name="selectDate" id="selectDate">
        <option value="0"> Seleccionar Año</option>
        @for($i=2010; $i<=date('Y'); $i++)
            <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    </select>

    <br><br>

    <button id="next">Siguiente</button>

    <br><br>

    <div style="background: blue; width: 40%; right: 0; top: 0;">
        <h3>Ramos Seleccionados</h3>
        <div id="selected-ramos">
            @foreach($qRamos as $q)
                <div id="selected-semestre-{{ $q->id_semestre }}">
                    <h4 class="selected-title"></h4>
                </div>
            @endforeach
        </div>
    </div>

    <div style="background: red; width: 40%;">
        <h3>Seleccionar Ramo</h3>
        <div id="all-ramos"></div>
    </div>


    <!-- TEMPLATES -->
    <script id="add_template" type="text/template">
        <div class="container-ramo" style="margin-bottom: 30px;">
            <div class="data">
                <span class="ramo-name"></span>
                <br>
                <input type="button" class="btn-add"/>
                <select class="teacher-select"></select>
            </div>
        </div>
    </script>

    <script id="selected_template" type="text/template">
        <div class="container-ramo selected-ramo" style="margin-bottom: 30px;">
            <span class="ramo-name">Ramo</span>
            <br>
            <span class="teacher-name">Teacher</span>
            <br>
            <input type="button" class="btn-action" value="Quitar"/>
        </div>
    </script>

@endsection

@push('scripts')
<script>
    var usrToken    =   "{{ JWTAuth::fromUser(Auth::user()) }}",
        usrID       =   "{{ $currentUser->id }}",
        usrRamos    =   jQuery.parseJSON('{!! $currentUser->getRamos() !!}');

    jQuery.each(usrRamos, function(k, v) {
        let id = v.r_id,
            semestreId      =   v.semestre_id,
            ramoName        =   v.r_name,
            teacherName     =   v.docente_nombre,
            semestreYear    =   v.semestre_year,
            semestreName    =   v.semestre_name,
            ramoDocenteId   =   v.rd_id;

        let template = $('#selected_template').text();
        let el = $(template);

        el.find('.ramo-name').text(ramoName);
        el.find('.teacher-name').text(teacherName).attr('has-selected', v.rd_id);
        el.find('.btn-action').attr('id', 'btn-action-'+id);

        $( "#selected-ramos" ).append( "<div id='selected-semestre-"+semestreId+"'></div>" );

        $( "#selected-semestre-"+semestreId+" .selected-title").text( semestreYear + ' ' + semestreName );

        $("#selected-semestre-"+semestreId).append(el);

    });

    /**
     * Obtener ramos a seleccionar
     */
    function getAllRamos(year) {
        $.ajax({
            method: "POST",
            url: "/api/carrera/"+user.career+"/ramos",
            data: {
              year: year
            },
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "bearer " + usrToken);
            }
        }).done(function( res ) { console.log(res);
            $("#all-ramos").empty();
            $.each( res, function (k, v) {
                if ( $( "#add-semestre-"+v.s_id ).length == 0 ) {
                    let semestreContainer = '<div id="add-semestre-'+v.s_id+'">' +
                        '<h4 class="ramo-semestre-'+v.s_id+' semestre-title-'+v.s_id+'" data-year="'+v.cr_year+'" data-s-name="'+v.s_name+'">'+v.cr_year+' '+v.s_name+'</h4></div>';
                    $('#all-ramos').append(semestreContainer);
                }

                let template = $('#add_template').text(),
                    el = $(template),
                    options = '';

                el.find('.data').addClass('data-'+v.r_id);
                el.find('.ramo-name').text(v.r_name).attr('id', 'ramo-name-'+v.r_id);
                el.find('.btn-add').val('Agregar').attr('id', 'btn-add-'+v.r_id).attr('s_id',+v.s_id);

                let selectDisabled = [];

                $.each( v.docentes, function (kd, vd) {
                    options += '<option value="'+vd.rd_id+'">'+vd.d_full_name+'</option>';

                    $.each($( ".selected-ramo .teacher-name"), function (){
                        if( $(this).attr('has-selected')  == vd.rd_id ) {
                            el.find('.btn-add').prop("disabled", true).val('Agregado');
                            selectDisabled[v.r_id] = true;
                        }
                    });
                });

                el.find('.teacher-select')
                    .append(options).attr('id', 'teacher-selected-'+v.r_id)
                    .prop('disabled', selectDisabled[v.r_id]);


                $("#all-ramos #add-semestre-"+v.s_id).append(el);
            });
        });
    }

    /**
     * Cambiar año de ingreso
     */
    $( "#selectDate" ).change(function() {
        if ($(this).val() == 0) {
            return false;
        }

        getAllRamos($(this).val());
    });

    /**
     * Agregar ramo
     */
    $(document).on('click', '.btn-add',function () {

        let idExpl = this.id.split('-');
        let id = idExpl[2];
        let semestreId = $(this).attr('s_id');

        $(this).prop("disabled", true).val('Agregado');
        $('#teacher-selected-'+id).prop("disabled", true);

        let ramoName = $('#ramo-name-'+id).text();
        let teacherName = $('#teacher-selected-'+id+' option:selected').text();

        let template = $('#selected_template').text();
        let el = $(template);

        el.find('.ramo-name').text(ramoName);
        el.find('.teacher-name').text(teacherName).attr('has-selected', $('#teacher-selected-'+id).val());
        el.find('.btn-action').attr('id', 'btn-action-'+id);

        $( "#selected-semestre-"+semestreId+" .selected-title").text( $( ".ramo-semestre-"+semestreId).attr('data-year')+' '+$( ".ramo-semestre-"+semestreId).attr('data-s-name') );

        $("#selected-semestre-"+semestreId).append(el);

    });

    /**
     * Quitar ramo
     */
    $(document).on('click', '.btn-action', function() {
        let idExpl = this.id.split('-');
        let id = idExpl[2];

        $(this).parent().remove();
        $('#btn-add-'+id).prop("disabled", false).val('Agregar');
        $('#teacher-selected-'+id).prop("disabled", false);
    });

    $(document).on('click', '#next', function() {
        if (!$( ".selected-ramo .teacher-name").attr('has-selected')) {
            alert('Debes seleccionar al menos un ramo');
            return false;
        }

        let selects = [];

        $( ".selected-ramo .teacher-name").each(function( index ) {
            if ( $(this).attr('has-selected') ) {
                selects.push($(this).attr('has-selected'));
            }
        });

        $.ajax({
            method: "POST",
            url: "/api/ramo/assign",
            data: {
                user: usrID,
                ramos: selects
            },
            beforeSend: function (xhr) {
                xhr.setRequestHeader ("Authorization", "bearer " + usrToken);
            }
        }).done(function( res ) {
            if (res.status) {
                window.location.href = '/dashboard';
            }
        });
    });
</script>
@endpush