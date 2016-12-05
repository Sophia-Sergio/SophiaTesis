  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          @if (Storage::disk('local')->has( $usuario->nombre . '-' . $usuario->id . '.jpg'))
            <img src="{{ route('profile.image', ['filename' => $usuario->nombre . '-' . $usuario->id . '.jpg']) }}" alt="" class="img-circle">
            @else
            <img src="{{ URL::to('img/man_avatar.jpg')   }}" alt="" class="img-circle">
          @endif
        </div>
        <div class="pull-left info">
          <p>{{$usuario->nombre}} {{$usuario->apellido}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header" style="color:white;">PANEL CONTROL</li>

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
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>