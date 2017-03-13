<!DOCTYPE html>
<html lang="es">
<head>
    @include('partials.htmlheader')
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" >
        @include('partials.header')

        @if ($currentUser->getProfile()->id == 1)
            @include('partials.aside_admin')
        @else
            @if ($actionData[0] == 'MessageController' && $actionData[1] == 'show')
                @include('layout.partials.aside_message')
            @elseif ($currentUser->getCareers())
                @include('partials.aside_user')
            @else
                @include('partials.aside_register')
            @endif
        @endif

        <div class="content-wrapper">
            <section class="content" style="padding-top: 50px">
                @yield('content')
            </section>
        </div>

    </div>

    @include('partials.scripts')
</body>
</html>
