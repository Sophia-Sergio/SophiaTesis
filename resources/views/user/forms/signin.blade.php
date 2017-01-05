<form action="{{ url('/login') }}" method="post">

    {{ csrf_field() }}

    <div class="navbar-custom-menu" name="menu1">
        <ul class="nav navbar-nav" >
            <div style="float: left; margin:12px 20px 0px 0px;">
                <input id="email" name="email" type="email" placeholder="Email" value="{{ old('email') }}">
                <input id="password" name="password" type="password" placeholder="Password">
            </div>

            <input type="submit" id="btn_inicio" class="btn-primary" name="btn_inicio" value="Iniciar">
        </ul>
    </div>
</form>