  <head>

      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">

      <title><?php echo $__env->yieldContent('title'); ?>| MITOS - Management of Inventory & POS</title>

    <?php echo e(HTML::style('assets_back/css/bootstrap.min.css')); ?>

    <?php echo e(HTML::style('assets_back/font-awesome/css/font-awesome.css')); ?>


      <!-- Toastr style -->
    <?php echo e(HTML::style('assets_back/css/plugins/toastr/toastr.min.css')); ?>


      <!-- Gritter -->
    <?php echo e(HTML::style('assets_back/js/plugins/gritter/jquery.gritter.css')); ?>


    <?php echo e(HTML::style('assets_back/css/animate.css')); ?>

    <?php echo e(HTML::style('assets_back/css/style.css')); ?>


    <?php echo $__env->yieldContent('style'); ?>
  </head>
