/**
 * Created by Ricardo on 10-12-2016.
 */

'use strict';

$(document).ready(function()
{
    $('.btn-seguir').on('click', function() {


        var idUserDestino = $(this).attr('id');

        $.ajax({
                url: "/user/seguir_usuario/"+idUserDestino
            })
            .done(function( data ) {

                if(data.siguiendo === true) {
                    $('#'+idUserDestino).text('Dejar de seguir');
                } else {
                    $('#'+idUserDestino).text('Seguir');
                }

            });

    });

});
