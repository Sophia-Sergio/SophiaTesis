  <aside class="main-sidebar"  style="position:fixed !important; right:0px; top:0px; z-index:10 !important">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          @if (Storage::disk('local')->has($usuario->id . '.jpg'))
            <img src="{{ route('profile.image', ['filename' => $usuario->id . '.jpg']) }}" alt="" class="img-circle" style="height:45px; width:45px">
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
      <!--
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header" style="color:white;"><b>RAMOS</b></li>
        <li class="treeview">
          <a href="">
            <i class="fa fa-folder"></i><span>Ramos por elegir</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right" ></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Muro</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Contenidos</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Notas y Fechas de Prueba</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Otros</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>