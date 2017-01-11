<form action="{{ route('posteoRamo.crear') }}" method="post">
    <div class="panel profile-info">
        <textarea id="contenido" name="contenido" class="form-control input-lg p-text-area" rows="2" placeholder="Aporta a la comunidad !"></textarea>

        <input type="hidden" id="id_usuario_ramo_docente" name="id_usuario_ramo_docente" value="{{ $urd }}" readonly="readonly">

        <footer class="panel-footer">
            <button type="submit" class="btn btn-info pull-right">Postear</button>
            <input type="hidden" value="{{ Session::token() }}" name="_token" id="_token">
            <ul class="nav nav-pills">
                <li><a href="#"><i class="fa fa-map-marker"></i></a></li>
                <li><a href="#"><i class="fa fa-camera"></i></a></li>
                <li><a href="#"><i class="fa fa-film"></i></a></li>
                <li><a href="#"><i class="fa fa-microphone"></i></a></li>
            </ul>
        </footer>
    </div>
</form>