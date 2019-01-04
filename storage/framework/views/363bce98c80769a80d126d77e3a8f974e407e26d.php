<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="Asset Manajemen System" name="whatisthis" />
<meta content="Lia Siti Sholihah @liastoliha" name="author" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

<title><?php echo $__env->yieldContent('title'); ?>| Management of Inventory System</title>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
<?php echo e(HTML::style('assets_back/global/plugins/font-awesome/css/font-awesome.min.css')); ?>

<?php echo e(HTML::style('assets_back/global/plugins/simple-line-icons/simple-line-icons.min.css')); ?>

<?php echo e(HTML::style('assets_back/global/plugins/bootstrap/css/bootstrap.min.css')); ?>

<?php echo e(HTML::style('assets_back/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')); ?>

<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<?php echo e(HTML::style('assets_back/global/plugins/select2/css/select2.min.css')); ?>

<?php echo e(HTML::style('assets_back/global/plugins/select2/css/select2-bootstrap.min.css')); ?>

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->
<?php echo e(HTML::style('assets_back/global/css/components.min.css')); ?>

<?php echo e(HTML::style('assets_back/global/css/plugins.min.css')); ?>

<?php echo e(HTML::style('assets_back/global/css/animate.css')); ?>

<?php echo e(HTML::style('assets_back/global/css/style.css')); ?>

<!-- END THEME GLOBAL STYLES -->

<!-- BEGIN PAGE LEVEL STYLES
<?php echo e(HTML::style('assets_back/pages/css/login-5.min.css')); ?>

END PAGE LEVEL STYLES -->
<link rel="shortcut icon" href="favicon.ico" /> </head>
<?php echo $__env->yieldContent('style'); ?>
</head>
<body class="gray-bg">
		<!-- BEGIN : LOGIN PAGE 5-2 -->
		  <?php echo $__env->yieldContent('content'); ?>
		<!-- END : LOGIN PAGE 5-2 -->
 <!-- BEGIN CORE PLUGINS -->
<?php echo e(HTML::script('assets_back/global/plugins/jquery.min.js')); ?>

<?php echo e(HTML::script('assets_back/global/plugins/bootstrap/js/bootstrap.min.js')); ?>

<?php echo e(HTML::script('assets_back/global/plugins/js.cookie.min.js')); ?>

<?php echo e(HTML::script('assets_back/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')); ?>

<?php echo e(HTML::script('assets_back/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')); ?>

<?php echo e(HTML::script('assets_back/global/plugins/jquery.blockui.min.js')); ?>

<?php echo e(HTML::script('assets_back/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')); ?>

 <!-- END CORE PLUGINS -->

<?php echo e(HTML::script('assets_back/global/plugins/jquery-validation/js/jquery.validate.min.js')); ?>

<?php echo e(HTML::script('assets_back/global/plugins/jquery-validation/js/additional-methods.min.js')); ?>

<?php echo e(HTML::script('assets_back/global/plugins/select2/js/select2.full.min.js')); ?>

<?php echo e(HTML::script('assets_back/global/plugins/backstretch/jquery.backstretch.min.js')); ?>


 <!-- BEGIN THEME LAYOUT SCRIPTS -->
 <?php echo e(HTML::script('assets_back/layouts/layout/scripts/layout.min.js')); ?>

 <?php echo e(HTML::script('assets_back/layouts/layout/scripts/demo.min.js')); ?>

 <?php echo e(HTML::script('assets_back/layouts/global/scripts/quick-sidebar.min.js')); ?>

 <!-- END THEME LAYOUT SCRIPTS -->
<?php echo $__env->yieldContent('script'); ?>
 </body>
