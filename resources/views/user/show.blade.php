<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//js.pusher.com/3.0/pusher.min.js"></script>
<script>
    Pusher.log = function(msg) {
        console.log(msg);
    };

    var pusher = new Pusher("{{env("PUSHER_KEY")}}")
    var channel = pusher.subscribe('test-channel');
    channel.bind('test-event', function(data) {
        //alert(data.text);
        $('#test-notif').append(data.text);
    });
</script>

<div id="test-notif"></div>

<div style="display: inline-block; width: 18%; height: 100%;">
    Mi Perfil
    <br>
    <img src="{{ $user->avatar }}" alt="{{ $user->getFullName() }}" width="150px">
    <br>
    {{ $user->getFullName() }}

    <br><br>

    Necum sam fugit quoditam,
    quaecus et erfererchit,
    esedipsum abo. Fic tore late
    voles mi, optat qui totatquatem
    alit am dellic tota sita cor simet
    quam, quam illab ipsania cus.
    Et ulparis none volorrunti
    volorat.Onsequiam, eseritibus
    di dolupta tempore quos es
    doluptassit maiorro que qui
    quatur maiosandiam lame
    nia ventis doloribus essimag
    nihilis modio doloreiunt,
    illatem etusam, qui utas
    aborepu dipiendunt duntibus
    enimoluptae.
</div>

<div style="display: inline-block; width: 38%; height: 100%;">
    MI MURO

    <div>
        <img src="{{ $user->avatar }}" alt="{{ $user->getFullName() }}" width="50px">
        <input type="text">
        <input type="button" value="Comentar">
    </div>

    <div>
        <a href="#"><small>Subir desde PC</small></a>
        / <a href="#"><small>Compartir desde biblioteca</small></a>
        / <a href="#"><small>Compartir Link</small></a>
        / <a href="#"><small>Grupo de estudio</small></a>
    </div>

    <div>
        @foreach($posts as $post)
            {{ $post->users->getFullName() }} <br>
            {{ $post->created_at }} <br>
            {{ $post->contenido }}
        @endforeach
    </div>

</div>

<div style="display: inline-block; width: 38%; height: 100%;">
    Archivos


</div>