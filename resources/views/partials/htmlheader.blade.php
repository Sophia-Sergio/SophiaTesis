<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<title>@yield('title')</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

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
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

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
</script>