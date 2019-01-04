<?php $__env->startSection('title'); ?>
<?php echo e($role->is_group ?"Group permissions":"Role permissions"); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php echo e(HTML::style('assets_back/css/plugins/iCheck/custom.css')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="wrapper wrapper-content">
  <div class="row ibox-title">
<ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
    <li class="">
        <a href="<?php echo e(url('role')); ?>">  Roles
        </a>
    </li>
    
    <li class="">
            <a href="#">
                Edit Permission
            </a>
    </li>

    <li class="active">
            <a href="<?php echo e(url('role/'.$role->id.'/show')); ?>">
                <?php echo e($role->name); ?>

            </a>
    </li>
    <li class="active">
            <a href="#">
                <?php echo e($modules); ?>

            </a>
    </li>
</ol>
        <a href="<?php echo e(url('role')); ?>">
        <button class="btn btn-sm btn-outline btn-warning pull-right">
        <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
        </button>
        </a>
</div>
  <div class="row detail_content3">
  <div class="col-lg-12 detail_content2" style="background-color: white">

  <div class="row ibox-content" style="min-height: 65vh; ">
  	<div class="col-xs-12 col-sm-12">
        <div class="panel-heading"></div>
        <div class="panel-body">

<?php echo e(Form::open(array('url' => route('role.save', $role->id), 'class' => 'form-horizontal'))); ?>

    <ul>
    <div class="content form-group col-sm-22 col-xs-12">
    <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php $first= array_values($action)[0];
      $firstname =explode(".", $first)[0];

    ?>

  <?php $__currentLoopData = $action; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(explode(".", $act)[0]=="api"): ?>
            <!--
            <div class="col-sm-1"> 
              <input type="checkbox" name="permissions[]" value="<?php echo e($act); ?>"  <?php echo e(array_key_exists($act, $role->permissions)?"checked":""); ?>>
            </div> -->
            <div class="col-sm-3" style="padding: 10px 0">
                <input type="checkbox" name="permissions[]" value="<?php echo e($act); ?>" class="form-control i-checks" <?php echo e(array_key_exists($act, $role->permissions)?"checked":""); ?>> &nbsp;  <?php echo e(isset(explode(".", $act)[2])?explode(".", $act)[1].".".explode(".", $act)[2]:explode(".", $act)[1]); ?>

            </div>

            <?php elseif(explode(".", $act)[0] == $modules): ?>
            <!--<div class="col-sm-1">
              <?php echo e(explode(".", $act)[1]); ?>

              <input type="checkbox" name="permissions[]" value="<?php echo e($act); ?>" <?php echo e(array_key_exists($act, $role->permissions)?"checked":""); ?>>
              </div>-->
              <div class="col-sm-3" style="padding: 10px 0">
                <input type="checkbox" name="permissions[]" value="<?php echo e($act); ?>" class="form-control i-checks" <?php echo e(array_key_exists($act, $role->permissions)?"checked":""); ?>> &nbsp;  <?php echo e(explode(".", $act)[1]); ?>

            </div>
              <?php elseif(explode(".", $act)[0]!= $modules): ?>
              <div class="">

              <input type="checkbox" style="display:none;" name="permissions[]" value="<?php echo e($act); ?>" <?php echo e(array_key_exists($act, $role->permissions)?"checked":""); ?>>
                </div>
             <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
</div>
 <div class="hr-line-dashed"></div>
    <div class="form-group">
      <a href="<?php echo e($role->is_group ? route('group.index'):route('role.index')); ?>" class="detail2 btn btn-md btn-outline btn-danger pull-right">  
        <i class="fa fa-times-circle" ></i> Cancel</a>
      <button type="submit" class="create_mdl btn btn-outline btn-primary pull-right" style="margin-right: 10px; "> 
        <i class="fa fa-save"></i>  Update
      </button>
      </a>
    </div>
    </div>
    </ul>
    <?php echo e(Form::close()); ?>

</div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<?php echo e(HTML::script('assets_back/js/plugins/iCheck/icheck.min.js')); ?>

<script>
    jQuery(document).ready(function() {

      $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });

      });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>