const endPointNotSeenFiles = siteUrl + "files/not_seen";

// Consultar al iniciar
getNotSeenFiles();

// Consultar nuevos mensajes cada x segundos
window.setInterval(function(){
    getNotSeenFiles();
}, 3000);

/**
 * Obtener archivos no vistos
 */
function getNotSeenFiles() {
    $.get( endPointNotSeenFiles, function( response ) {

        $('.total-notifications').text(response.length);
        $('#title-new-notifications').text('Hay ' + response.length + ' archivos nuevos')

        if (!$("#open-read-notification").hasClass('open')) {
            generateNotSeenFileHTML(response);
        }
    });
}

/**
 * Generar HTML para las notificaciones de archivo
 *
 * @param response
 */
function generateNotSeenFileHTML(response) {

    $("#notseenfile-container").empty();

    $.each( response, function( key, value ) {

        console.log(value.id);

        // Agregar el elemento sólo si no existe
        if(!$( "#li-not-seen-"+value.id ).length) {

            var html = '';
            html    += '<li id="li-not-seen-'+value.id+'">';
            html    += '<a href="'+siteUrl+'files/'+value.id_ramo+'/mark_seen/'+value.id_usuario_ramo_docente+'">';
            html    += '<i class="fa fa-users text-aqua"></i>' + value.nombre + ' ' + value.apellido + ' ha subido un archivo';
            html    += '</a>';
            html    += '</li>';

            $("#not-seen-list").append(html);
        }
    });
}