const endPointNotSeenFiles = siteUrl + "files/not_seen",
    endPointUnreadMessage = siteUrl + "messages/unread";

// Consultar al iniciar
getNotSeenFiles();
getUnreadMsg();

// Consultar nuevos mensajes cada x segundos
window.setInterval(function(){
    getNotSeenFiles();
    getUnreadMsg();
}, 3000);


/*ARCHIVOS*/

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

        //console.log(value.id);

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


/*MENSAJES*/
function getUnreadMsg() {
    $.get( endPointUnreadMessage, function( response ) {

        $('#count-new-msg').text(response.length);
        $('#title-new-msg').text('Tienes ' + response.length + ' mensajes nuevos')

        if (!$("#open-read-msg").hasClass('open')) {
            getUnreadHTML(response);
        }
    });
}

function getUnreadHTML(response) {

    var used = [];

    $("#unread-container").empty();

    $.each( response, function( key, value ) {

        if(used.indexOf(value.uuid) == -1) {
            var html = '';
            html +=     '<ul id="ul-unread" class="menu">';
            html +=         '<li>';
            html +=             '<a href="'+siteUrl+'messages/'+value.uuid+'">';
            html +=                 '<div class="pull-left">';
            html +=                     '<img src="'+value.sender_avatar+'" class="img-circle" alt="User Image">';
            html +=                 '</div>';
            html +=                 '<h4>';
            html +=                     value.sender_name;
            html +=                 '</h4>';
            html +=                 '<p>'+value.message+'</p>';
            html +=             '</a>';
            html +=         '</li>';
            html +=     '</ul>';

            $("#unread-container").append(html);

            used.push(value.uuid);
        }
    });
}