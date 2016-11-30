var postId = 0;
var postBodyElement = null;

$('.post').find('.edit').on('click', function(event){
    event.preventDefault();
    var postBody = event.target.parentNode.childNodes[1].textContent;
    $('#contenido_editar').val(postBody);
    $('#editPost').modal();
});

$('#modal-save').on('click', function () {
    $.ajax({
        method: 'POST',
        url: urlEdit,
        data: {body: $('#post-body').val(), postId: postId, _token: token}
    })
        .done(function (msg) {
            $(postBodyElement).text(msg['new_body']);
            $('#edit-modal').modal('hide');
        });
});