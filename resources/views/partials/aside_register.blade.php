<aside class="main-sidebar"  style="position:fixed !important; right:0px; top:0px; z-index:10 !important">
    <section class="sidebar">
        <div class="user-panel">

            <div class="pull-left image">
                <img src="{{ $currentUser->avatar }}" alt="{{ $currentUser->getFullName() }}" class="img-circle" style="height:45px; width:45px">
            </div>

            <div class="pull-left info">
                <p>{{ $currentUser->getFullName() }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

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
</aside>