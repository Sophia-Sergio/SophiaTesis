@extends('layout.user')

@section('title')
    Sophia | Conversaciones
@endsection


@section('content')
    <div class="row" style="padding-top: 50px;">

        <div class="col-sm-5">

            <section class="blue-gradient-background">
                <div class="container">
                    <div class="row light-grey-blue-background chat-app">

                        <div class="action-bar">
                            {!! Form::open(['route' => 'messages.store', 'id' => 'form-message2']) !!}

                            <div style="display:none;">
                                <input type="text" id="uuid" name="uuid" value="{{ Request::segment(2) }}" readonly class="form-control">
                            </div>

                            <textarea class="input-message col-xs-10" placeholder="Your message" id="message" name="message"></textarea>

                            <div class="option col-xs-1 white-background">
                                <span class="fa fa-smile-o light-grey"></span>
                            </div>
                            <div class="option col-xs-1 green-background send-message">
                                <span class="white light fa fa-paper-plane-o"></span>
                            </div>
                            {!! Form::close() !!}
                        </div>

                    </div>
                </div>
            </section>

            <input type="button" id="charge-msg" value="Cargar Anterior">

            <div id="messages"></div>

            <!-- Template para generar Post -->
            <script id="chat_message_template" type="text/template">
                <div class="message">
                    <div class="avatar" style="display:inline-block;">
                        <img src="" style="width:100px;">
                    </div>
                    <div class="text-display" style="display:inline-block;">
                        <div class="message-data">
                            <span class="author"></span>
                            <span class="timestamp"></span>
                            <span class="seen"></span>
                        </div>
                        <p class="message-body"></p>
                    </div>
                </div>
            </script>
        </div>
    </div>
@endsection

@push('scripts')

<script>
    const endPointCreateMessage =   siteUrl + "messages";
    const endPointGetMessages   =   siteUrl + "messages/{{ Request::segment(2) }}/chat";
    const userToken             =   "{{ Auth::user()->token() }}";

    let chatChannel = "{{ $chatChannel }}";
</script>

<script src="{{ asset('js/chat.js') }}"></script>

<script>
    var page = 1,
        lastPage = null;

    console.log(page);

    $(document).on("click", "#charge-msg", function() {
        loadMsg();
    });

    function setLastPage(val) {
        lastPage = val;
    }

    function setPage() {
        page++;
    }

    function loadMsg() {

        $.get( "/api/message/{{ Request::segment(2) }}", {token: userToken, page: page} )
            .done(function( data ) {
                console.log(data);

                let messages = data.data;

                if (messages.length < 1) {
                    return false;
                }

                messages = messages.reverse();

                $.each(messages, function(key, message) {
                    if (page == 1) {
                        addMessage(message, 'append');
                    } else {
                        addMessage(message, 'prepend');
                    }
                });

                setPage();
                setLastPage(data.last_page);

                console.log('current page: ' + page);
                console.log('last page: ' + lastPage);

                if (page == lastPage) {
                    $("#charge-msg").hide();
                }
            });
    }
</script>
@endpush