<?php $__env->startSection('title'); ?>
    Sophia | Registro Académico
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-10">
        <div class="panel panel-default">
            <div class="panel-body" style="padding-left:50px;  padding-top:25px; padding-right:50px; padding-bottom:30px" >

                <h3>Registro Academico </h3>
                <p>
                    Para poder intercambiar material o comunicarte
                    con otros usuarios, es necesario que completes la siguiente informacion:
                </p>
                <?php echo $__env->make('user.forms.tomaCarrera', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.masterUsuario', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>