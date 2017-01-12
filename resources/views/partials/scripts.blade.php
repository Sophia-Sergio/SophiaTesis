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

@stack('scripts')