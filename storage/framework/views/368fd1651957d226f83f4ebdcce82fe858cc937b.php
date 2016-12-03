<?php $__env->startSection('content'); ?>
    <?php
    $carrera = Session::get('carrera');
    $ramos = Session::get('ramos');
    $ramo = Session::get('ramo');
    $usuario = Session::get('user');
    $posteosRamos= Session::get('posteosRamo');
    $usuario_ramo_docenteFiles = Session::get('usuario_ramo_docenteFiles');
    $ramo_docenteFiles = Session::get('ramo_docenteFiles');
    ?>

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
                    <input id="fileupload" type="file" name="document" data-token="<?php echo e(Session::token()); ?>" data-user-id="<?php echo e($usuario->id); ?>"> <!-- Para seleccionar m�ltiples archivos !! <input id="fileupload" type="file" name="files[]" multiple> -->

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
                        <th>Tama�o</th>
                        <th>Tipo</th>
                    </tr>
                    </thead>
                    <tbody id="tablePrivate">
                    <?php $__currentLoopData = $usuario_ramo_docenteFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
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
                        <th>Tama�o</th>
                        <th>Tipo</th>
                        <th>Usuario</th>
                    </tr>
                    </thead>
                    <tbody id="tablePublic">
                    <?php $__currentLoopData = $ramo_docenteFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <tr>
                            <td><a href="/download/<?php echo e($file->file_id); ?>"><?php echo e($file->name); ?></a></td>
                            <td><?php echo e($file->created_at); ?></td>
                            <td><?php echo e($file->size); ?></td>
                            <td><?php echo e($file->extension); ?></td>
                            <td><?php echo e($file->nombre); ?> <?php echo e($file->apellido); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    </tbody>
                </table>
                <hr/>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    @parent
    <script>
        ;(function($)
        {
            'use strict';
            $(document).ready(function()
            {
                var $fileupload = $('#fileupload'),
                        $upload_success = $('#upload-success');


                $fileupload.bind('fileuploadsubmit', function (e, data) {
                    // The example input, doesn't have to be part of the upload form:
                    data.formData = {_token: $fileupload.data('token'), user_id: $fileupload.data('userId'), seguridad_id: $('#selSeguridad').val()};
                });


                $fileupload.fileupload({
                    url: '/upload',
                    dataType: 'json',
                    formData: {_token: $fileupload.data('token'), user_id: $fileupload.data('userId'), seguridad_id: $('#selSeguridad').val()},

                    progressall: function (e, data) {
                        var progress = parseInt(data.loaded / data.total * 100, 10);
                        $('#progress .progress-bar').css(
                                'width',
                                progress + '%'
                        );
                    },
                    fail: function(e, data) {
                        alert('Fail!');
                    },
                    done: function (e, data) {
                        $upload_success.removeClass('hide').hide().slideDown('fast');
                        $('#progress .progress-bar').css('width',0);

                        var cadPub = '';
                        data.result.publicos.forEach(function (item, index) {

                            console.log(item);

                            var cadena = '<td><a href="/download/'+item.file_id+'">'+item.name+'</a></td>';
                            cadena += '<td>'+item.created_at+'</td>';
                            cadena += '<td>'+item.size+'</td>';
                            cadena += '<td>'+item.extension+'</td>';
                            cadena += '<td>'+item.nombre+'</td>';
                            cadena = '<tr>'+cadena+'</tr>';
                            cadPub = cadPub+cadena;
                        });

                        $('#tablePublic').html(cadPub);


                        var cadPriv = '';
                        data.result.privados.forEach(function (item, index) {
                            var cadena = '<td><a href="/download/'+item.id+'">'+item.name+'</a></td>';
                            cadena += '<td>'+item.created_at+'</td>';
                            cadena += '<td>'+item.size+'</td>';
                            cadena += '<td>'+item.extension+'</td>';
                            cadena = '<tr>'+cadena+'</tr>';
                            cadPriv = cadPriv+cadena;
                        });

                        $('#tablePrivate').html(cadPriv);

//                    setTimeout(function(){
//                        location.reload();
//                    }, 2000);
                    }
                });

            });



        })(window.jQuery);
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.masterUsuario', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>