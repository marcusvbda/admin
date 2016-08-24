<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo e(PASTA_PUBLIC); ?>/template/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo e(PASTA_PUBLIC); ?>/template/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo e(PASTA_PUBLIC); ?>/template/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo e(PASTA_PUBLIC); ?>/template/bootstrap/css/custom.css">
</head>
<body style="background-color:white"> 


  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div>  
    <!-- Main content -->
    <div class="content">

      <?php echo $__env->yieldContent('conteudo'); ?>

    </div>
    <!-- /.content -->
  </div>



</body>
</html>




