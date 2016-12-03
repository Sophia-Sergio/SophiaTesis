/**
 * Created by Ricardo on 03-12-2016.
 */

'use strict';

$(document).ready(function()
{
    var $fileupload = $('#fileupload'),
        $upload_success = $('#upload-success');

    $fileupload.bind('fileuploadsubmit', function (e, data) {
        // The example input, doesn't have to be part of the upload form:
        data.formData = {_token: $fileupload.data('token'), user_id: $fileupload.data('userId'), seguridad_id: $('#selSeguridad').val()};
    });

    $fileupload.fileupload({
        url: '/upload',
        dataType: 'json',
        formData: {_token: $fileupload.data('token'), user_id: $fileupload.data('userId'), seguridad_id: $('#selSeguridad').val()},

        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        },
        fail: function(e, data) {
            alert('Fail!');
        },
        done: function (e, data) {
            $upload_success.removeClass('hide').hide().slideDown('fast');
            $('#progress .progress-bar').css('width',0);

            var cadPub = '';
            data.result.publicos.forEach(function (item, index) {

                var cadena = '<td><a href="/download/'+item.id+'">'+item.name+'</a></td>';
                cadena += '<td>'+item.created_at+'</td>';
                cadena += '<td>'+item.size+'</td>';
                cadena += '<td>'+item.extension+'</td>';
                cadena += '<td>'+item.nombre+'</td>';
                cadena += '<td><span id="'+item.id+'_cont" class="badge badge_like">'+item.n_like+'</span><span id="'+item.id+'" class="like glyphicon glyphicon-thumbs-up"></span></td>';
                cadena = '<tr>'+cadena+'</tr>';

                cadPub = cadPub+cadena;
            });
            $('#tablePublic').html(cadPub);


            var cadPriv = '';
            data.result.privados.forEach(function (item, index) {
                var cadena = '<td><a href="/download/'+item.id+'">'+item.name+'</a></td>';
                cadena += '<td>'+item.created_at+'</td>';
                cadena += '<td>'+item.size+'</td>';
                cadena += '<td>'+item.extension+'</td>';
                cadena = '<tr>'+cadena+'</tr>';
                cadPriv = cadPriv+cadena;
            });
            $('#tablePrivate').html(cadPriv);
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
