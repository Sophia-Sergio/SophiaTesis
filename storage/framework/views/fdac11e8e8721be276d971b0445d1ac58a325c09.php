<?php $__env->startSection('title'); ?>
Sophia | La Red de Estudiantes
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('alerts.request', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <article class="container">
        <div class="row">
            <div class="col-sm-4">
                <h4><i class="fa fa-dashboard"></i> <b>Sophia</b></h4>
                <span><b>La Red de Estudiantes</b></span>
                <hr/>
                <p style="text-align: justify; font-family: 'Open Sans', sans-serif;">Bienvenido!. Esta es una plataforma donde
                    podr&aacute;s subir y organizar el material de estudio de tu carrera, para que te
                    sea m&aacute;s f&aacute;cil acceder a todo tu material de estudio. Tambi&eacute;n encontrar&aacute;s informaci&oacute;n
                    y tips sobre la carrera que actualmente est&aacute;s estudiando o, si prefieres, sobre otras
                    que sean de tu interes. &Uacute;nete a nuestra comunidad y comienza a usar nuestros servicios
                    de forma absolutamente GRATUITA.</p>
                <iframe width="100%" height="33%"
                        src="https://www.youtube.com/embed/iHgd7aB4fH4">
                </iframe>
            </div>

            <div class="col-sm-6">
                <?php echo $__env->make('user.forms.signup', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>
    </article>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.masterLogin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>