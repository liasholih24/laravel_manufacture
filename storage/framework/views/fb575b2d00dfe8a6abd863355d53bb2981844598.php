<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
<body id="wrapper" class="pace-done mini-navbar">
  <?php echo $__env->make('backLayout.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <!-- PAGE CONTAINER -->
  <!-- BEGIN CONTAINER -->

		    <!-- Navbar -->
	         <?php echo $__env->make('backLayout.NavBar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	      <!-- /Navbar -->

        <!-- BEGIN CONTENT -->
          <div id="page-wrapper" class="gray-bg dashbard-1">
        <!-- Navbar top -->
          <?php echo $__env->make('backLayout.NavBarTop', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- End Navbar top -->
        <!-- beadcurms-->
        <div class="row wrapper border-bottom white-bg page-heading">
                  <div id="bread" class="col-lg-9">
                    <h2> <?php echo $__env->yieldContent('title'); ?> <small> - <?php echo $__env->yieldContent('desc'); ?>  </small></h2>
                    <ol class="breadcrumb">
                                      <li class=""><a href="<?php echo e(route('home.dashboard')); ?>">Dashboard</a></li>
                                      <li class="active"><a href="#"><b><?php echo $__env->yieldContent('title'); ?></b></a></li>
                                    </ol>
                  </div>
        </div>
        <!-- Begin Page -->
          <?php echo $__env->yieldContent('content'); ?>
        <!-- End Page -->

  <?php echo $__env->make('backLayout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</div>
          <!-- END CONTENT -->
          <!-- Mainly scripts -->
          <?php echo e(HTML::script('assets_back/js/jquery-2.1.1.js')); ?>

          <?php echo e(HTML::script('assets_back/js/bootstrap.min.js')); ?>

          <?php echo e(HTML::script('assets_back/js/plugins/metisMenu/jquery.metisMenu.js')); ?>

          <?php echo e(HTML::script('assets_back/js/plugins/jeditable/jquery.jeditable.js')); ?>

          <?php echo e(HTML::script('assets_back/js/plugins/slimscroll/jquery.slimscroll.min.js')); ?>



          <!-- Peity -->
          <?php echo e(HTML::script('assets_back/js/plugins/peity/jquery.peity.min.js')); ?>

          <?php echo e(HTML::script('assets_back/js/demo/peity-demo.js')); ?>


          <!-- Custom and plugin javascript -->
          <?php echo e(HTML::script('assets_back/js/inspinia.js')); ?>

          <?php echo e(HTML::script('assets_back/js/plugins/pace/pace.min.js')); ?>


          <!-- jQuery UI -->
          <?php echo e(HTML::script('assets_back/js/plugins/jquery-ui/jquery-ui.min.js')); ?>

          <!-- GITTER -->
          <?php echo e(HTML::script('assets_back/js/plugins/gritter/jquery.gritter.min.js')); ?>

          <!-- Sparkline -->
          <?php echo e(HTML::script('assets_back/js/plugins/sparkline/jquery.sparkline.min.js')); ?>


          <!-- Sparkline demo data  -->
          <?php echo e(HTML::script('assets_back/js/demo/sparkline-demo.js')); ?>



          <!-- Toastr -->
          <?php echo e(HTML::script('assets_back/js/plugins/toastr/toastr.min.js')); ?>

 <?php echo $__env->yieldContent('script'); ?>

 </body>
