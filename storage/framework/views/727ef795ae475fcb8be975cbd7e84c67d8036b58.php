<?php if(count($errors) > 0): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" style="text-align: center">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
<?php if(Session::has('message')): ?>
    <div class="alert alert-danger alert-dismissible" role="alert" style="text-align: center">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo e(Session::get('message')); ?>

    </div>
<?php endif; ?>

<?php if(Session::has('message_positivo')): ?>
    <div class="alert alert-success alert-dismissible" role="alert" style="text-align: center">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo e(Session::get('message_positivo')); ?>

    </div>
<?php endif; ?>