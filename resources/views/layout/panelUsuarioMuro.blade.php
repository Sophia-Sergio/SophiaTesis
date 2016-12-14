  <aside class="main-sidebar"  style="position:fixed !important; right:0px; top:0px; z-index:10 !important">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" >
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          @if (Storage::disk('local')->has($usuario->id . '.jpg'))
            <img src="{{ route('profile.image', ['filename' => $usuario->id . '.jpg']) }}" alt="" class="img-circle " style="height:45px; width:45px">
            @else
            <img src="{{ URL::to('img/man_avatar.jpg')   }}" alt="" class="img-rounded">
          @endif
        </div>
        <div class="pull-left info">
          <p>{{$usuario->nombre}} {{$usuario->apellido}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
        </br>
        </br>
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
        <a href="{{ route('dashboard')}}"><li class="header" style="color:white; background-color: black"><b>{{ $carrera->nombre_carrera }}</b></li></a>
      @foreach($ramos as $ramo)

        <li class="treeview">
          <a href="">
            <i class="fa fa-folder"></i><span>{{$ramo->nombre_ramo}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right" ></i>
            </span>
          </a>
            <ul class="treeview-menu">
                <li><a href="/ramo/muro/{{$ramo->id_ramo}}"><i class="fa fa-circle-o"></i> Muro</a></li>
                <li><a href="/ramo/contenido/{{$ramo->id_ramo}}"><i class="fa fa-circle-o"></i> Contenidos</a></li>
                <li><a href="{{ route('messages.my_messages', ['ramo' => $ramo->id]) }}"><i class="fa fa-circle-o"></i> Mensajes</a></li>
                <li><a href="{{ route('users.by_ramo', ['ramo' => $ramo->id]) }}"><i class="fa fa-circle-o"></i> Compañeros</a></li>
            </ul>
        </li>
      @endforeach
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>