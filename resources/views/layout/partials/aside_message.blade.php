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
            @foreach($users as $user)
                <li>
                    <a href="#">
                        @if ($user->sender->id != $currentUser->id)
                            <i class="fa fa-circle-o"></i> {{ $user->sender->getFullName() }}
                            <br>
                            <small>{{ $user->message }}</small>
                        @elseif ($user->receiver->id != $currentUser->id)
                            <i class="fa fa-circle-o"></i> {{ $user->sender->getFullName() }}
                            <br>
                            <small>{{ $user->message }}</small>
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>

    </section>
</aside>