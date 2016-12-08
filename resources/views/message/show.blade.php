@extends('layout.masterUsuario')

@section('title')
    Sophia | Registro Académico
@endsection


@section('content')
    <div class="row" style="padding-top: 50px;">
        <div class="col-sm-10">
            <div class="panel panel-default">
                <div class="panel-body" style="padding-left:50px;  padding-top:25px; padding-right:50px; padding-bottom:30px" >

                    <div class="row current-chat-area">
                        <div id="msg-container" class="col-md-12" style="height: 200px; overflow-y: scroll;">
                            <ul class="media-list"></ul>
                        </div>
                    </div>

                    {!! Form::open(['route' => 'messages.store', 'id' => 'new-message']) !!}
                        <div style="display:none;">
                            <input type="text" id="uuid" name="uuid" value="{{ Request::segment(2) }}" readonly class="form-control">
                        </div>

                        <textarea name="message" id="message" cols="30" rows="10" class="form-control" required></textarea>


                        <br>
                        {{ Form::submit('Nuevo mensaje', ['class' => 'btn btn-success', 'style' => 'width: 100%']) }}
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const endPointCreateMessage = siteUrl + "messages";
    const endPointGetMessages = siteUrl + "messages/{{ Request::segment(2) }}/chat";

    $("#msg-container").animate({ scrollTop: 9999 }, 2000);

    $( "#new-message" ).submit(function( event ) {
        event.preventDefault();

        $.ajaxSetup({
            header:$('meta[name="_token"]').attr('content')
        });

        $.ajax({

            type:"POST",
            url: endPointCreateMessage,
            data: $(this).serialize(),
            dataType: 'json',
            success: function(data){
                $("#message").val("");
                getNewMessage();
                $("#msg-container").animate({ scrollTop: 9999 }, 2000);
            },
            error: function(data){

            }
        });

    });

    // La primera vez se llama inmediatamente
    getNewMessage();

    // Buscar mensajes cada 3 segundos
    window.setInterval(function(){
        getNewMessage();
    }, 3000);


    function getNewMessage() {
        $.get( endPointGetMessages, function( response ) {

            $.each( response, function( key, value ) {
                if ($("#li-" + value.id).length == 0) {
                    createElement(value);
                }

            });

        });
    }

    function createElement(value) {

        var html = '';

        html += '<li id="li-'+value.id+'" class="media">';
        html +=     '<div class="media-body">';
        html +=         '<div class="media">';
        html +=             '<a class="pull-left" href="#">';
        html +=                 '<img class="media-object img-circle" src="'+value.sender_avatar+'">';
        html +=             '</a>';
        html +=             '<div class="media-body">';
        html +=                 value.message;
        html +=                 '<br>';
        html +=                 '<small class="text-muted">'+value.sender_name+' | '+value.formated_date+'</small>';
        html +=                 '<hr>';
        html +=             '</div>';
        html +=         '</div>';
        html +=     '</div>';
        html += '</li>';

        $(".media-list").append(html);

        $("#msg-container").animate({ scrollTop: 9999 }, 2000);

        if(value.read == 0 || value.read == "0") {
            $.get( "{{ route('messages.markAsRead', ['id' => Request::segment(2)]) }}", function( data ) {
                console.log('aca' + value.id);
            });
        }
    }
</script>
@endpush