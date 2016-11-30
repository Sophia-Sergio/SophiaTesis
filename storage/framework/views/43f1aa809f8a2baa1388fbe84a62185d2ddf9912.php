<?php $__env->startSection('title'); ?>
    Sophia | Muro <?php echo e($ramo->nombre_ramo); ?>

<?php $__env->stopSection(); ?>



    <?php $__env->startSection('content'); ?>
<?php
$carrera = Session::get('carrera');
$ramos = Session::get('ramos');
$usuario = Session::get('user');
$posteosRamos= Session::get('posteosRamo');
?>
        <!-- http://bootdey.com/snippets/view/social-network-wall // de aquí saqué el template-->
<link rel="stylesheet" href="<?php echo e(asset('css/index_UsuarioMuro.css')); ?>">
<div class="container bootstrap snippet" Style="width:80%">
    <div class="row">
        <div class="panel" Style="padding-left:15px; padding-right:15px">
            <h2> Muro de <?php echo e($ramo->nombre_ramo); ?> </h2>
            <hr/>
        </div>
        <?php echo $__env->make('ramo.forms.postRamo', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php $__currentLoopData = $posteosRamos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $posteoRamo): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <div class="panel">

                <div class="panel-body">

                    <div class="fb-user-thumb">
                        <?php if(Storage::disk('local')->has( $posteoRamo->nombre . '-' . $posteoRamo->id_user. '.jpg')): ?>
                            <img src="<?php echo e(route('profile.image', ['filename' => $posteoRamo->nombre . '-' . $posteoRamo->id_user. '.jpg'])); ?>" alt="" class="img-circle">
                        <?php else: ?>
                            <img src="<?php echo e(URL::to('img/man_avatar.jpg')); ?>" alt="" class="img-circle">
                        <?php endif; ?>
                    </div>
                    <div class="fb-user-details">
                        <h3><a href="#" class="#"> <?php echo e($posteoRamo->nombre); ?></a></h3>
                        <p><?php echo e($posteoRamo->created_at); ?>, USA</p>
                    </div>
                    <div class="clearfix"></div>
                    <p class="fb-user-status"> <?php echo e($posteoRamo->contenido); ?>

                    </p>
                    <div class="fb-status-container fb-border">
                        <div class="fb-time-action">
                            <article class="post">
                                <a style="display:none"><?php echo e($posteoRamo->contenido); ?></a>
                                <a href="#" title="Me gusta!!">Me gusta</a>
                                <span>-</span>
                                <a href="#" title="Deja un comentario">Comentar</a>
                                <span>-</span>
                                <a href="#" title="Comparte con tus compañeros">Compartir</a>
                                <?php if($posteoRamo->id_user == $usuario->id): ?>
                                    <span>-</span>
                                    <a href="#" class="edit" title="Edita tu comentario">Editar</a>
                                    <span>-</span>
                                    <a href="<?php echo e(route('postCarrera.delete', ['id_posteo' => $posteoRamo->id])); ?>" title="Eliminar">Eliminar</a>
                                <?php endif; ?>
                            </article>
                        </div>
                    </div>

                    <di class="fb-status-container fb-border fb-gray-bg">
                        <div class="fb-time-action like-info">
                            <a href="#">Jhon Due,</a>
                            <a href="#">Danieal Kalion</a>
                            <span>and</span>
                            <a href="#">40 more</a>
                            <span>like this</span>
                        </div>

                        <ul class="fb-comments">
                            <li>
                                <a href="#" class="cmt-thumb">
                                    <img src="http://bootdey.com/img/Content/avatar/avatar3.png" alt="">
                                </a>
                                <div class="cmt-details">
                                    <a href="#">Jhone due</a>
                                    <span> is world famous professional photographer.  with forward thinking clients to create beautiful, </span>
                                    <p>40 minutes ago - <a href="#" class="like-link">Like</a></p>
                                </div>
                            </li>
                            <li>
                                <a href="#" class="cmt-thumb">
                                    <img src="http://bootdey.com/img/Content/avatar/avatar3.png" alt="">
                                </a>
                                <div class="cmt-details">
                                    <a href="#">Tawseef</a>
                                    <span> is world famous professional photographer.  with forward thinking clients to create beautiful, </span>
                                    <p>34 minutes ago - <a href="#" class="like-link">Like</a></p>
                                </div>
                            </li>

                            <li>
                                <a href="#" class="cmt-thumb">
                                    <img src="http://bootdey.com/img/Content/avatar/avatar4.png" alt="">
                                </a>
                                <div class="cmt-details">
                                    <a href="#">Jhone due</a>
                                    <span> is world famous professional photographer.   </span>
                                    <p>15 minutes ago - <a href="#" class="like-link">Like</a></p>
                                </div>
                            </li>
                            <li>
                                <a href="#" class="cmt-thumb">
                                    <img src="http://bootdey.com/img/Content/avatar/avatar5.png" alt="">
                                </a>
                                <div class="cmt-details">
                                    <a href="#">Tawseef</a>
                                    <span> thinking clients to create beautiful world famous professional photographer.  </span>
                                    <p>2 minutes ago - <a href="#" class="like-link">Like</a></p>
                                </div>
                            </li>
                            <li>
                                <a href="#" class="cmt-thumb">
                                    <img src="http://bootdey.com/img/Content/avatar/avatar8.png" alt="">
                                </a>
                                <div class="cmt-form">
                                    <textarea class="form-control" placeholder="Write a comment..." name=""></textarea>
                                </div>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </di>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<div class="modal fade" tabindex="-1" role="dialog" id="editPost">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edita </h4>
            </div>
            <div class="modal-body">
                <form>
                    <textarea type="text" id="contenido_editar" name="contenido_editar" class="form-control" rows="2"></textarea>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar cambios</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php echo $__env->make('layout.masterUsuario', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>