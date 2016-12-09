<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <link rel="stylesheet" href="{{ URL::to('bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ URL::to('css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ URL::to('css/skins/_all-skins.min.css') }}">
  <link rel="stylesheet" href="{{ URL::to('css/masterLogin.css') }}">
  <link rel="stylesheet" href="{{ URL::to('css/main.css') }}">
  <link rel="stylesheet" href="{{ URL::to('css/master.css') }}">
  <link rel="stylesheet" href="{{ URL::to('css/index_UsuarioMuro.css') }}">
  <link rel="stylesheet" href="{{ URL::to('/bower_components/jquery-file-upload/css/jquery.fileupload.css') }}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <link rel="stylesheet" href="{{ URL::to('css/messages.css') }}">

    <!-- Datatables -->
    <link rel="stylesheet" href="{{ URL::to('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('bower_components/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>

  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <script>
        const siteUrl = "{{ URL::to('/') }}/";

        <?php list(,,,$route) = explode("\\", Route::getCurrentRoute()->getActionName()); ?>
        <?php list($controller, $action) = explode('@', $route); ?>

        var controller = "{{ $controller }}";
        var action = "{{ $action }}";


    </script>
</head>
<?php
if (Session::has('carrera')) {
    $carrera = Session::get('carrera');
}
if (Session::has('perfil'))
{
  $perfil = Session::get('perfil')->id_perfil;
}

$ramos = Session::get('ramos');
$usuario = Session::get('user');
?>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper" >

//24-11-2016 CGG: nose entiende este if
//24-11-2016 CGG: se llama al header de la pagina principal
  @include('layout.panelHeader')

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
@if(Session::has('carrera') && ($perfil=='2' ||$perfil=='3') )
  @include('layout.panelUsuarioMuro')
@elseif ($perfil=='2')
  @include('layout.panelUsuarioMuroFirst')
@elseif ($perfil=='1')
  @include('layout.panelAdmin')
@endif

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content" style="padding-top: 80px">
        @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
@section('scripts')
<!-- jQuery 2.2.3 -->
<!-- Scripts -->
<script src=" {{ URL::to('dist/js/jquery-3.1.1.min.js')}}"></script>
<script src=" {{ URL::to('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src=" {{ URL::to('bootstrap/js/bootstrap.min.js')}}"></script>
<script src=" {{ URL::to('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<script src=" {{ URL::to('plugins/fastclick/fastclick.js')}}"></script>
<script src=" {{ URL::to('dist/js/app.min.js')}}"></script>
<script src=" {{ URL::to('dist/js/demo.js')}}"></script>
<script src=" {{ URL::to('js/app_new.js')}}"></script>
<script src=" {{ URL::to('/bower_components/jquery-file-upload/js/vendor/jquery.ui.widget.js')}}"></script>
<script src=" {{ URL::to('/bower_components/jquery-file-upload/js/jquery.fileupload.js')}}"></script>

<!-- Datatables -->
<script src=" {{ URL::to('/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src=" {{ URL::to('/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src=" {{ URL::to('/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src=" {{ URL::to('/bower_components/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>


<script src=" {{ URL::to('/js/notifications.js')}}"></script>
@show

<script>
    const endPointUnreadMessage = siteUrl + "messages/unread";

    // Consultar al iniciar
    getUnreadMsg();

    // Consultar nuevos mensajes cada x segundos
    window.setInterval(function(){
        getUnreadMsg();
    }, 3000);

    function getUnreadMsg() {
        $.get( endPointUnreadMessage, function( response ) {

            console.log(response);

            $('#count-new-msg').text(response.length);
            $('#title-new-msg').text('Tienes ' + response.length + ' mensajes nuevos')

            if (!$("#open-read-msg").hasClass('open')) {
                getUnreadHTML(response);
            }
        });
    }

    function getUnreadHTML(response) {

        var used = [];

        $("#unread-container").empty();

        $.each( response, function( key, value ) {

            if(used.indexOf(value.uuid) == -1) {
                var html = '';
                html +=     '<ul id="ul-unread" class="menu">';
                html +=         '<li>';
                html +=             '<a href="'+siteUrl+'messages/'+value.uuid+'">';
                html +=                 '<div class="pull-left">';
                html +=                     '<img src="'+value.sender_avatar+'" class="img-circle" alt="User Image">';
                html +=                 '</div>';
                html +=                 '<h4>';
                html +=                     value.sender_name;
                html +=                 '</h4>';
                html +=                 '<p>'+value.message+'</p>';
                html +=             '</a>';
                html +=         '</li>';
                html +=     '</ul>';

                $("#unread-container").append(html);

                used.push(value.uuid);
            }
        });
    }
</script>

@stack('scripts')
</body>
</html>
