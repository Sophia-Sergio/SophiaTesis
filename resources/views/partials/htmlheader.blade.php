<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<title>@yield('title')</title>

<link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
<link rel="stylesheet" href="{{ asset('bower_components/components-font-awesome/css/font-awesome.min.css') }}">

<link rel="stylesheet" href="{{ URL::to('bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::to('css/AdminLTE.min.css') }}">
<link rel="stylesheet" href="{{ URL::to('css/skins/_all-skins.min.css') }}">
<link rel="stylesheet" href="{{ URL::to('css/masterLogin.css') }}">
<link rel="stylesheet" href="{{ URL::to('css/main.css') }}">
<link rel="stylesheet" href="{{ URL::to('css/master.css') }}">
<link rel="stylesheet" href="{{ URL::to('css/index_UsuarioMuro.css') }}">
<link rel="stylesheet" href="{{ URL::to('/bower_components/jquery-file-upload/css/jquery.fileupload.css') }}">

<link rel="stylesheet" href="{{ URL::to('css/messages.css') }}">

<!-- Datatables -->
<link rel="stylesheet" href="{{ URL::to('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::to('bower_components/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}">

@stack('css')

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="{{ asset('bower_components/html5shiv/dist/html5shiv.js') }}"></script>
    <script src="{{ asset('bower_components/dest/respond.min.js') }}"></script>
<![endif]-->

<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('js/pusher.min.js') }}"></script>

<script>
    const siteUrl = "{{ URL::to('/') }}/";

        <?php list(,,,$route) = explode("\\", Route::getCurrentRoute()->getActionName()); ?>
        <?php @list($controller, $action) = explode('@', $route); ?>

    var controller = "{{ $controller }}";
    var action = "{{ $action }}";

    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
    });

    /*Pusher.log = function(msg) {
        console.log(msg);
    };*/
</script>