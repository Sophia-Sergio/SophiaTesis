<?php $__env->startSection('content'); ?>
    <?php
    $carrera = Session::get('carrera');
    $ramos = Session::get('ramos');
    $ramo = Session::get('ramo');
    $usuario = Session::get('user');
    $posteosRamos= Session::get('posteosRamo');
    ?>

    <script type="text/javascript" src="<?php echo e(URL::asset('js/ramo/contenido/controller.js')); ?>"></script>

    <link rel="stylesheet" href="<?php echo e(asset('css/index_UsuarioMuro.css')); ?>">
    <?php echo $__env->make('alerts.request', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="container bootstrap snippet" Style="width:90%">
        <div class="row">
            <div class="panel" Style="padding-left:15px; padding-right:15px">
                <h2> Contenidos de <?php echo e($ramo->nombre_ramo); ?> </h2>
                <hr/>
            </div>
            <div class="panel" Style="padding-left:15px; padding-right:15px; padding-top:15px">
                <span class="btn btn-primary fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Seleccionar Archivos</span>
                    <!-- The file input field used as target for the file upload widget -->
                    <input id="fileupload" type="file" name="document" data-token="<?php echo e(Session::token()); ?>" data-user-id="<?php echo e($usuario->id); ?>"> <!-- Para seleccionar m?ltiples archivos !! <input id="fileupload" type="file" name="files[]" multiple> -->

                </span>
                <br>
                <br>
                <!-- The global progress bar -->
                <div id="progress" class="progress">
                    <div class="progress-bar progress-bar-success"></div>
                </div>

                <div class="form-group col-md-6" style="padding-left: 0px;">
                    <label for="selSeguridad">Seguridad:</label>
                    <select class="form-control" id="selSeguridad">
                        <option value="1" selected>Publico</option>
                        <option value="2">Privado</option>
                    </select>
                </div>


                <table class="table table-bordered table-striped table-hover">.
                    <caption>Documentos Privados</caption>
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Creado</th>
                        <th>Tamaño</th>
                        <th>Tipo</th>
                    </tr>
                    </thead>
                    <tbody id="tablePrivate">
                    <?php $__currentLoopData = $archivos_privados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <tr>
                            <td><a href="/download/<?php echo e($file->id); ?>"><?php echo e($file->name); ?></a></td>
                            <td><?php echo e($file->created_at); ?></td>
                            <td><?php echo e($file->size); ?></td>
                            <td><?php echo e($file->extension); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                    </tbody>
                </table>
                <hr/>
            </div>
        </div>

        <div class="row">
            <div class="panel" Style="padding-left:15px; padding-right:15px; padding-top:15px">
                <table class="table table-bordered table-striped table-hover">.
                    <caption>Documentos P&uacute;blicos</caption>
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Creado</th>
                        <th>Tamaño</th>
                        <th>Tipo</th>
                        <th>Usuario</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="tablePublic">
                    <?php $__currentLoopData = $archivos_publicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <tr>
                            <td><a href="/download/<?php echo e($file->id); ?>"><?php echo e($file->name); ?></a></td>
                            <td><?php echo e($file->created_at); ?></td>
                            <td><?php echo e($file->size); ?></td>
                            <td><?php echo e($file->extension); ?></td>
                            <td><?php echo e($file->nombre); ?> <?php echo e($file->apellido); ?></td>
                            <td>

                                <span id="<?php echo e($file->id); ?>_cont" class="badge badge_like"><?php echo e($file->n_like); ?></span>

                                <?php if($file->is_like == true): ?>
                                    <span id="<?php echo e($file->id); ?>" class="like like_active glyphicon glyphicon-thumbs-up"></span>
                                <?php else: ?>
                                    <span id="<?php echo e($file->id); ?>" class="like glyphicon glyphicon-thumbs-up"></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    </tbody>
                </table>
                <hr/>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.masterUsuario', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>