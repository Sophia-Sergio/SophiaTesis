  <aside class="main-sidebar" >
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php if(Storage::disk('local')->has( $usuario->nombre . '-' . $usuario->id . '.jpg')): ?>
            <img src="<?php echo e(route('profile.image', ['filename' => $usuario->nombre . '-' . $usuario->id . '.jpg'])); ?>" alt="" class="img-circle">
            <?php else: ?>
            <img src="<?php echo e(URL::to('img/man_avatar.jpg')); ?>" alt="" class="img-circle">
          <?php endif; ?>
        </div>
        <div class="pull-left info">
          <p><?php echo e($usuario->nombre); ?> <?php echo e($usuario->apellido); ?></p>
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
        <a href="<?php echo e(route('dashboard')); ?>"><li class="header" style="color:white; background-color: black"><b><?php echo e($carrera->nombre_carrera); ?></b></li></a>
      <?php $__currentLoopData = $ramos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ramo): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
        <li class="treeview">
          <a href="">
            <i class="fa fa-folder"></i><span><?php echo e($ramo->nombre_ramo); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right" ></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/ramo/muro/<?php echo e($ramo->id_ramo); ?>"><i class="fa fa-circle-o"></i> Muro</a></li>
            <li><a href="/ramo/contenido/<?php echo e($ramo->id_ramo); ?>"><i class="fa fa-circle-o"></i> Contenidos</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Notas y Fechas de Prueba</a></li>
            <li><a href="404.html"><i class="fa fa-circle-o"></i> Otros</a></li>
          </ul>
        </li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>