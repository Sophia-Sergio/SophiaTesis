<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo e(URL::to('css/AdminLTE.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::to('css/skins/_all-skins.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::to('css/masterLogin.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::to('css/main.css')); ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue">
<!-- Site wrapper -->
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"></span> <img src="img/LogoNegro.png" style="text-align:center">
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <?php echo $__env->make('user.forms.signin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <?php echo $__env->yieldContent('content'); ?>
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
</div>
    <!-- jQuery 2.2.3 -->
    <script src=" <?php echo e(URL::to('dist/js/jquery-3.1.1.min.js')); ?>"></script>
    <script src=" <?php echo e(URL::to('plugins/jQuery/jquery-2.2.3.min.js')); ?>"></script>
    <script src=" <?php echo e(URL::to('bootstrap/js/bootstrap.min.js')); ?>"></script>
    <script src=" <?php echo e(URL::to('plugins/slimScroll/jquery.slimscroll.min.js')); ?>"></script>
    <script src=" <?php echo e(URL::to('plugins/fastclick/fastclick.js')); ?>"></script>
    <script src=" <?php echo e(URL::to('dist/js/app.min.js')); ?>"></script>
    <script src=" <?php echo e(URL::to('dist/js/demo.js')); ?>"></script>

</body>
</html>
