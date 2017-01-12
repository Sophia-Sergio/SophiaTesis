<aside class="main-sidebar"  style="position:fixed !important; right:0px; top:0px; z-index:10 !important">

    <section class="sidebar" >

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ $currentUser->avatar }}" alt="" class="img-circle " style="height:45px; width:45px">
            </div>
            <div class="pull-left info">
                <p>{{ $currentUser->getFullName() }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
            </br>
            </br>
        </div>

        <ul class="sidebar-menu">
            <a href="{{ route('dashboard')}}"><li class="header" style="color:white; background-color: black"><b>{{ $currentUser->getCareers()->name }}</b></li></a>
            @foreach($currentUser->getRamos() as $ramo)

                <li class="treeview">
                    <a href="">
                        <i class="fa fa-folder"></i><span>{{$ramo->r_name}}</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right" ></i>
                        </span>
                    </a>

                    <ul class="treeview-menu">
                        <li><a href="/ramo/muro/{{ $ramo->r_id }}"><i class="fa fa-circle-o"></i> Muro</a></li>
                        <li><a href="/ramo/contenido/{{ $ramo->r_id }}"><i class="fa fa-circle-o"></i> Contenidos</a></li>
                        <li><a href="{{ route('messages.my_messages', ['ramo' => $ramo->r_id]) }}"><i class="fa fa-circle-o"></i> Mensajes</a></li>
                        <li><a href="{{ route('users.by_ramo', ['ramo' => $ramo->r_id]) }}"><i class="fa fa-circle-o"></i> Compañeros</a></li>
                    </ul>

                </li>
            @endforeach
        </ul>

    </section>
</aside>