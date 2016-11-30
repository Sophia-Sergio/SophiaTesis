<?php
$ramo_docentes = Session::get('docentes');
$ramos_nombre = Session::get('ramos_nombre');
?>
<style>
    .form-group input[type="checkbox"] {
        display: none;
    }
    .form-group input[type="checkbox"] + .btn-group > label span {
        width: 20px;
    }
    .form-group input[type="checkbox"] + .btn-group > label span:first-child {
        display: none;
    }
    .form-group input[type="checkbox"] + .btn-group > label span:last-child {
        display: inline-block;
    }
    .form-group input[type="checkbox"]:checked + .btn-group > label span:first-child {
        display: inline-block;
    }
    .form-group input[type="checkbox"]:checked + .btn-group > label span:last-child {
        display: none;
    }
</style>
<form action="<?php echo e(route('tomaDocentes')); ?>" method="post" name="tomaCarrera" id="tomaCarrera">
    <hr/>
    <?php $__currentLoopData = $ramos_nombre; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ramo): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
    <label> Ramo <?php echo e($ramo->nombre_ramo); ?></label>
        <?php $__currentLoopData = $ramo_docentes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ramo_docente): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <?php if($ramo->id==$ramo_docente->id_ramo): ?>
                <div class="form-group">
                    <input type="checkbox" name="ramo_docente[]" value="<?php echo e($ramo_docente->id); ?>" id="ramo_docente<?php echo e($ramo_docente->id); ?>" autocomplete="off" style="display: none;">
                    <div class="btn-group" style="width:100%">
                        <label for="ramo_docente<?php echo e($ramo_docente->id); ?>" class="btn btn-warning">
                            <span class="[ glyphicon glyphicon-ok ]"></span>
                            <span>&nbsp;</span>
                        </label>
                        <label for="ramo_docente<?php echo e($ramo_docente->id); ?>" class="[ btn btn-default active ]">
                            <?php echo e($ramo_docente->nombre); ?> <?php echo e($ramo_docente->apellido_paterno); ?> <?php echo e($ramo_docente->apellido_materno); ?>

                        </label>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        <hr/>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    <input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>">
    <button type="submit" class="btn btn-primary">Siguiente</button>
</form>