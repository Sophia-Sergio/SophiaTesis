<header class="main-header">
    <div style="position:fixed !important; right:0px; top:0px; z-index:10 !important; width:100%;">

        <a href="/" class="logo">
            <span class="logo-mini"><b>A</b>LT</span>
            <span class="logo-lg"> <img src="{{ URL::to('img/LogoNegro.png') }}" style="text-align:center"></span>
        </a>

        <nav class="navbar navbar-static-top" >
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    @if (Auth::user()->getProfile()->id != 1)

                        <li id="open-read-msg" class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span id="count-new-msg" class="label label-success"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li id="title-new-msg" class="header"></li>
                                <li id="unread-container"></li>
                            </ul>
                        </li>

                        <li id="open-read-notification" class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning total-notifications"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li id="title-new-notifications" class="header"></li>
                                <li>
                                    <ul id="not-seen-list" class="menu">
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @endif

                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ $currentUser->avatar }}" alt="{{ $currentUser->getFullName() }}" class="user-image">
                            <span class="hidden-xs"> {{ $currentUser->getFullName() }}</span>
                        </a>

                        <ul class="dropdown-menu">

                            <li class="user-header">
                                <img src="{{ $currentUser->avatar }}" alt="{{ $currentUser->getFullName() }}" class="img-circle">
                                <p>
                                    {{ $currentUser->getFullName() }}

                                    @if (Auth::user()->getProfile()->id == '2')
                                        - Estudiante
                                    @else
                                        - Administrador
                                    @endif

                                    <small>
                                        @if (Auth::user()->getProfile()->id != '1')
                                            {{ $currentUser->getCareers()->name }}
                                        @endif
                                    </small>
                                </p>
                            </li>

                            <li class="user-body">
                                <div class="row">
                                    <div class="col-xs-4 text-center">
                                        <a href="#"></a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#"></a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#"></a>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ route('user.profile') }}" class="btn btn-default btn-flat">Perfil</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat">Cerrar Sesión</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>