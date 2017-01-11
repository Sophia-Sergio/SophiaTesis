/**
 * Created by Ricardo on 03-12-2016.
 */

'use strict';

/**
 * Eliminar un archivo
 *
 * @param id
 */
function deleteFile(id) {
    $.ajax({
        method: "POST",
        url: siteUrl+"files/"+id,
        data: {
            _method: 'delete',
            _token : token,
            idFile: id
        }
    }).done(function( response ) {
        if (response.status == 1) {
            genPrivateTable()
            genPublicTable();
        }
    });
}

/**
 * Aquitar o agregar un like a archivo
 *
 * @param id
 */
function toggleLikeFile(id) {
    $.ajax({
        method: "GET",
        url: siteUrl+"/likeFile/"+id,
        data: {
            _token : token,
            idFile: id
        }
    }).done(function( response ) {
        $("."+id+"_cont").empty().text(response.totalLikes);

        if ($(".like-"+id).hasClass('like_active')) {
            $(".like-"+id).removeClass('like_active');
        } else {
            $(".like-"+id).addClass('like_active');
        }
    });
}

/**
 * Generar la tabla de "mis archivos"
 */
function genPrivateTable() {

    $('#private-files-table').DataTable({
        processing: true,
        serverSide: true,
        "bDestroy": true,
        "language": {
            "url": '/js/dataTables-es.json'
        },
        ajax: {
            method: 'POST',
            url: '/files/'+idRamo+'/ramo/private/table',
            data: { idRamo: idRamo}
        },
        columns: [
            { data: 'client_name', name: 'client_name' },
            { data: 'created_at', name: 'created_at' },
            { data: 'size', name: 'size' },
            { data: 'extension', name: 'extension' },
            { data: 'type', name: 'type' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement("input");
                $(input).appendTo($(column.footer()).empty())
                    .on('change', function () {
                        column.search($(this).val()).draw();
                    });
            });

            // Formatos
            $('th input').addClass('form-control');
            $("#private-foot-name input").css("max-width", "130px")
            $("#private-foot-created input").css("max-width", "130px");
            $("#private-foot-size input").css("max-width", "100px");
            $("#private-foot-type input").css("max-width", "130px");
            $("#private-foot-action input").hide();
        }
    });
}

/**
 * Tabla de archivos públicos
 */
function genPublicTable() {

    $('#public-files-table').DataTable({
        processing: true,
        serverSide: true,
        "bDestroy": true,
        "language": {
            "url": '/js/dataTables-es.json'
        },
        ajax: {
            method: 'POST',
            url: '/files/'+idRamo+'/ramo/public/table',
            data: { idRamo: idRamo}
        },
        columns: [
            { data: 'name', name: 'name' },
            { data: 'created_at', name: 'created_at' },
            { data: 'size', name: 'size' },
            { data: 'extension', name: 'extension' },
            { data: 'type', name: 'type' },
            { data: 'nombre', name: 'nombre' },
            { data: 'action', name: 'action' }
        ],
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement("input");
                $(input).appendTo($(column.footer()).empty())
                    .on('change', function () {
                        column.search($(this).val()).draw();
                    });
            });

            // Formatos
            $('th input').addClass('form-control');
            $("#public-foot-name input").css("max-width", "130px")
            $("#public-foot-created input").css("max-width", "130px");
            $("#public-foot-size input").css("max-width", "100px");
            $("#public-foot-type input").css("max-width", "130px");
            $("#public-foot-action input").hide();
        }
    });
}

// Click en botón eliminar
$(document).on('click', ".btn-danger",function(){
    event.preventDefault();
    var split = this.id.split("-");
    deleteFile(split[1]);
});

// Click en el botón like
$(document).on('click', ".like",function(){
    event.preventDefault();
    var split = this.id.split("-");
    toggleLikeFile(split[1]);
});

$(document).ready(function()
{
    var $fileupload = $('#fileupload'),
        $upload_success = $('#upload-success');

    // Validar datos necesarios al subir archivo
    $('#fileupload').click(function(){
        if ($("#selSeguridad").val() == "0") {
            alert("Debes seleccionar la seguridad");
            return false;
        }

        if ($("#selTipo").val() == "0") {
            alert("Debes seleccionar el tipo de archivo");
            return false;
        }
    });

    $fileupload.bind('fileuploadsubmit', function (e, data) {
        data.formData = {
            _token: $fileupload.data('token'),
            user: $fileupload.data('userId'),
            security: $('#selSeguridad').val(),
            type: $('#selTipo').val(),
            teacher: idDocente,
            ramo: idRamo,
            usuarioRamoDocente: idUsuarioRamoDocente,
            ramoDocente: idRamoDocente
        };
    });

    $fileupload.fileupload({
        url: '/upload',
        dataType: 'json',
        formData: {
            _token: $fileupload.data('token'),
            user_id: $fileupload.data('userId'),
            seguridad_id: $('#selSeguridad').val(),
            type: $("#selTipo").val(),
        },

        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        },
        fail: function(e, data) {
            alert('Ha ocurrido un error al momento de subir el archivo!');
        },
        done: function (e, data) {
            $upload_success.removeClass('hide').hide().slideDown('fast');
            $('#progress .progress-bar').css('width',0);

            genPrivateTable();
            genPublicTable();
        }
    });


    $('#tablePublic').on('click', '.like', function() {
        $(this).toggleClass('like_active');

        var id = $(this).attr('id');

        $.ajax({
                url: "/likeFile/"+id
            })
            .done(function( data ) {
                console.log(data)
                var idContador = '#'+id+'_cont'
                $(idContador).html(data.totalLikes)
            });

    });

});
