function initNewMessage() {
    $('.send-message').click(sendMessage);
    $('.input-message').keypress(checkSend);
}

// Permitir enviar formulario con enter
function checkSend(e) {
    if (e.keyCode === 13) {
        return sendMessage();
    }
}

// Enviar el nuevo mensaje
function sendMessage() {
    let messageText = $('.input-message').val();

    $.ajax({
        type:"POST",
        url: endPointCreateMessage,
        data: $("#form-message2").serialize(),
        dataType: 'json',
        success: function(data){
            //console.log(data);
        },
        error: function(data){
            //console.log(data);
        }
    });

    // Asegurar que el evento normal del navegador no se realiza
    return false;
}

// Generar avatar
jQuery.extend({
    setUserAvatar : function (user) {

        var avatar = null;

        $.ajax({
            type:"GET",
            url: "/api/user/"+user.id,
            data: { token: userToken },
            dataType: 'json',
            async: false,
            success: function(response) {
                avatar = response.avatar;
            }
        });

        return avatar;
    }
});

// Generar HTML
function addMessage(data, order) {
    let el = createMessageEl();

    el.find('.message-body').html(data.message);
    el.find('.author').text(data.nombre + ' ' + data.apellido);

    if (data.id) {
        el.find('.avatar img').attr('src', $.setUserAvatar(data));
    } else {
        el.find('.avatar img').attr('src', data.avatar);
    }


    // Utilidad para crear un tiempo bien formateado
    el.find('.timestamp').text(data.created_at);

    let messages = $('#messages');

    if (order == 'append' || typeof order === 'undefined') {
        messages.append(el);
    } else {
        messages.prepend(el);
    }

    // Asegurar que el mensaje entrante se muestra
    messages.scrollTop(messages[0].scrollHeight);
}

// Crear un elemento desde el template
function createMessageEl() {
    let text = $('#chat_message_template').text();
    let el = $(text);

    return el;
}

$(initNewMessage);

let channel = pusher.subscribe( chatChannel );

channel.bind('new-message', addMessage);