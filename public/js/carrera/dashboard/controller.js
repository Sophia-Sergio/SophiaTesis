/**
 * Created by Ricardo on 03-12-2016.
 */

'use strict';

$(document).ready(function()
{

    $('#postContent').on('click', '.setLike', function() {
        var id = $(this).attr('id');
        $.ajax({
                url: "/likePostCarrera/"+id
            })
            .done(function( data ) {
                var idContador = '#'+id+'_cont'

                var cadena = data.totalLikes;

                if(data.totalLikes == 1) {
                    cadena += ' persona';
                } else {
                    cadena += ' personas';
                }

                $(idContador).html(cadena);

                if(data.isLike == true) {
                    $('#'+id).html('Ya no me gusta');
                } else {
                    $('#'+id).html('Me gusta');
                }


            });
    });

});
