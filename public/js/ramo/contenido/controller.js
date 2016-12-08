/**
 * Created by Ricardo on 03-12-2016.
 */

'use strict';

$(document).ready(function()
{
    var $fileupload = $('#fileupload'),
        $upload_success = $('#upload-success');

    $fileupload.bind('fileuploadsubmit', function (e, data) {
        data.formData = {
            _token: $fileupload.data('token'),
            user_id: $fileupload.data('userId'),
            seguridad_id: $('#selSeguridad').val(),
            type: $('#selTipo').val()
        };
    });

    $fileupload.fileupload({
        url: '/upload',
        dataType: 'json',
        formData: {_token: $fileupload.data('token'), user_id: $fileupload.data('userId'), seguridad_id: $('#selSeguridad').val(), type: $("#selTipo").val()},

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
