<?php $__env->startSection('title'); ?>
QR Code
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Generate QR Code
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php echo e(HTML::style('assets_back/css/plugins/select2/select2.min.css')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="wrapper wrapper-content">
					<div class="row detail_content3">
	<div class="col-lg-12 detail_content2" style="background-color: white"><style>
						.ibox { margin: 1px 2px 0px 0px !important }
						.ibox.float-e-margins{ margin: 0px 2px !important}
						</style>
      <div class="row ibox-title">
   <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
        <li class="">
            <a href="<?php echo e(url('status')); ?>"> QRCode
        </li>
        /
        <li class="">
                <a href="#">
                    Add New
                </a>
        </li>
    </ol>
            <a href="<?php echo e(url('qrcode')); ?>">
            <button class="btn btn-sm btn-outline btn-warning pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
	<div class="row ibox-content" style="min-height: 65vh; ">
	<div class="col-xs-12 col-sm-12">
    <?php echo Form::open(['url' => 'qrcode', 'class' => 'form-horizontal']); ?>

		<?php echo Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

		<?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

    <div class="form-group <?php echo e($errors->has('asset_id') ? 'has-error' : ''); ?>">
        <?php echo Form::label('sbu_id', 'SBU: ', ['class' => 'col-sm-3 control-label']); ?>

        <div class="col-sm-6">
            <?php echo e(Form::select('sbu_id', $sbus, null, ['class' => 'form-control select2_demo_1','placeholder' => 'Select SBU'])); ?>

            <?php echo $errors->first('sbu_id', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>
    <div class="form-group <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">
        <?php echo Form::label('status', 'Status: ', ['class' => 'col-sm-3 control-label']); ?>

        <div class="col-sm-6">
          <?php echo e(Form::select('status', ['0' => 'Iddle','1' => 'Booked','2' => 'Used'], null, ['class' => 'form-control','placeholder'=>'Select Status'])); ?>


            <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>
    <div class="form-group <?php echo e($errors->has('remark') ? 'has-error' : ''); ?>">
        <?php echo Form::label('remark', 'Remark: ', ['class' => 'col-sm-3 control-label']); ?>

        <div class="col-sm-6">
            <?php echo Form::text('remark', null, ['class' => 'form-control']); ?>

            <?php echo $errors->first('remark', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>
    <div class="form-group <?php echo e($errors->has('remark') ? 'has-error' : ''); ?>">
        <?php echo Form::label('qrtotal', 'QR Total: ', ['class' => 'col-sm-3 control-label']); ?>

        <div class="col-sm-6">
            <?php echo Form::text('qrtotal', null, ['class' => 'form-control']); ?>

            <?php echo $errors->first('qrtotal', '<p class="help-block">:message</p>'); ?>

        </div>
    </div>


    <div class="form-group">
<a href="<?php echo e(url('qrcode')); ?>" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
      <button type="submit" class="create_mdl btn btn-outline btn-primary pull-right" style="margin-right: 20px; ">
                        <i class="fa fa-plus-circle"></i>  Create
                      </button>
      </a>
    </div>
    </div>
    </div>
    <?php echo Form::close(); ?>

  </div>
</div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<?php echo e(HTML::script('assets_back/js/plugins/select2/select2.full.min.js')); ?>


<script>
var csrf = $('meta[name="csrf-token"]').attr('content');
 jQuery(document).ready(function() {


		$(".select2_demo_1").select2();
		});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>