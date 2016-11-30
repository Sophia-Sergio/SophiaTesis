<form action="<?php echo e(route('signin')); ?>" method="post">
    <div class="navbar-custom-menu" name="menu1">
        <ul class="nav navbar-nav" >
            <div style="float: left; margin:12px 20px 0px 0px;">
            <input id="email_" name="email_" type="email" placeholder=" Usuario (email)" value="">
            <input id="password_" name="password_" type="password" placeholder=" Password">
            <input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>">
            </div>
            <input id="btn_inicio" class="btn-primary" name="btn_inicio" type="submit" value="Iniciar">
        </ul>
    </div>
</form>