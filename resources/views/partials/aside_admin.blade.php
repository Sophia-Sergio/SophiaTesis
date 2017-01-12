<aside class="main-sidebar" style="position:fixed !important; right:0px; top:0px; z-index:10 !important">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ $currentUser->avatar }}" alt="" class="img-circle" style="height:45px; width:45px">
            </div>
            <div class="pull-left info">
                <p>{{ $currentUser->getFullName() }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="header" style="color:white;">PANEL DE ADMINISTRACIÓN</li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Instituciones</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/verInstituciones"><i class="fa fa-circle-o"></i>Listar y Editar</a></li>
                    <li><a href="/crearInstituciones"><i class="fa fa-circle-o"></i>Crear</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Carreras</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/verCarreras"><i class="fa fa-circle-o"></i>Listar y Editar</a></li>
                    <li><a href="/crearCarreras"><i class="fa fa-circle-o"></i>Crear</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Docentes</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/verDocentes"><i class="fa fa-circle-o"></i>Listar y Editar</a></li>
                    <li><a href="/crearDocentes"><i class="fa fa-circle-o"></i>Crear</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Usuarios</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/verUsuarios"><i class="fa fa-circle-o"></i>Listar y Editar</a></li>
                    <li><a href="/crearUsuarios"><i class="fa fa-circle-o"></i>Crear</a></li>
                </ul>
            </li>
            <li class="header" style="color:white;">HERRAMIENTAS</li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Publicidad</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/crearPublicidad"><i class="fa fa-circle-o"></i>Crear</a></li>

                </ul>
            </li>
        </ul>
    </section>

</aside>