<?php $__env->startSection('title'); ?>
Create New <?php if($level == ""): ?> Customer <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Manage <?php if($level == ""): ?> Customer <?php endif; ?>
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
            <a href="<?php echo e(url('sid')); ?>"> Customer
						</a>
        </li>
				<?php if($id != ""): ?>

				<li class="">
                <a href="<?php echo e(url('sid/'.$node->id.'/show')); ?>">
                    <?php echo e($node->name); ?>

                </a>
        </li>
				<?php endif; ?>

        <li class="">
                <a href="#">
                    Add New
                </a>
        </li>
    </ol>
            <a href="<?php echo e(url('sid')); ?>">
            <button class="btn btn-sm btn-outline btn-warning pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
	<div class="row ibox-content" style="min-height: 65vh; ">
	<div class="col-xs-12 col-sm-12">
    <?php echo Form::open(['url' => 'sid', 'class' => 'form-horizontal']); ?>

		<?php echo Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

		<?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

		<?php 
switch ($level) {
case 0:
			$title = "Customer";
			$subtitle = "Manage Customer";
			$depthname = "SID";
			$depthicon = "fa-list";
    break;
case 1:
    	$title = "SID";
			$subtitle = "Manage SID Data";
			$depthicon = "";
			$depthname = "";
		break;
}
 ?>
<?php echo Form::hidden('parent_id', $id); ?>

<?php echo Form::hidden('title', $title); ?>

<?php echo Form::hidden('subtitle', $subtitle); ?>

<?php echo Form::hidden('depthicon', $depthicon); ?>

<?php echo Form::hidden('depthname', $depthname); ?>

<?php echo Form::hidden('level', $level); ?>

<?php if($level == 1): ?>
<div class="form-group">
	<?php echo Form::label('parent_id', 'Customer', ['class' => 'col-sm-1 control-label']); ?>

				<div class="col-sm-5 col-xs-12 <?php echo e($errors->has('parent_id') ? 'has-error' : ''); ?>">
							<?php echo e(Form::select('parent_id', $customers, $id, ['class' => 'form-control select2_demo_1','placeholder'=>'Select Customer'])); ?>

							<?php echo $errors->first('parent_id', '<p class="help-block">:message</p>'); ?>

						</div>
</div>

<div class="form-group">
	<?php echo Form::label('sid', 'SID*', ['class' => 'col-sm-1 control-label']); ?>

	<div class="col-sm-5 <?php echo e($errors->has('code') ? 'has-error' : ''); ?>">
			<?php echo Form::text('sid', null, ['class' => 'form-control']); ?>

			<?php echo $errors->first('sid', '<p class="help-block">:message</p>'); ?>

	</div>
<?php echo Form::label('revenue', 'Revenue*', ['class' => 'col-sm-1 control-label']); ?>

<div class="col-sm-5 <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
		<?php echo Form::text('revenue', null, ['class' => 'form-control']); ?>

		<?php echo $errors->first('revenue', '<p class="help-block">:message</p>'); ?>

</div>

</div>
<?php endif; ?>
<?php if($level == '0'): ?>
	<div class="form-group">
	<?php echo Form::label('name', 'Name*', ['class' => 'col-sm-1 control-label']); ?>

	<div class="col-sm-5 <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
			<?php echo Form::text('name', null, ['class' => 'form-control']); ?>

			<?php echo $errors->first('name', '<p class="help-block">:message</p>'); ?>

	</div>
	<?php echo Form::label('code', 'Abbreviation*', ['class' => 'col-sm-1 control-label']); ?>

	<div class="col-sm-5 <?php echo e($errors->has('code') ? 'has-error' : ''); ?>">
			<?php echo Form::text('code', null, ['class' => 'form-control']); ?>

			<?php echo $errors->first('code', '<p class="help-block">:message</p>'); ?>

	</div>
  </div>
  <div class="form-group">
	<?php echo Form::label('phone', 'Phone', ['class' => 'col-sm-1 control-label']); ?>

	<div class="col-sm-5 <?php echo e($errors->has('phone') ? 'has-error' : ''); ?>">
			<?php echo Form::text('phone', null, ['class' => 'form-control']); ?>

			<?php echo $errors->first('phone', '<p class="help-block">:message</p>'); ?>

	</div>
	<?php echo Form::label('pic', 'PIC*', ['class' => 'col-sm-1 control-label']); ?>

	<div class="col-sm-5 <?php echo e($errors->has('pic') ? 'has-error' : ''); ?>">
			<?php echo Form::text('pic', null, ['class' => 'form-control']); ?>

			<?php echo $errors->first('pic', '<p class="help-block">:message</p>'); ?>

	</div>
  </div>
  <div class="form-group">
	<?php echo Form::label('pic_phone', 'PIC Phone', ['class' => 'col-sm-1 control-label']); ?>

	<div class="col-sm-5 <?php echo e($errors->has('pic_phone') ? 'has-error' : ''); ?>">
			<?php echo Form::text('pic_phone', null, ['class' => 'form-control']); ?>

			<?php echo $errors->first('pic_phone', '<p class="help-block">:message</p>'); ?>

	</div>
	<?php echo Form::label('pic_email', 'PIC Email', ['class' => 'col-sm-1 control-label']); ?>

	<div class="col-sm-5 <?php echo e($errors->has('pic_email') ? 'has-error' : ''); ?>">
			<?php echo Form::text('pic_email', null, ['class' => 'form-control']); ?>

			<?php echo $errors->first('pic_email', '<p class="help-block">:message</p>'); ?>

	</div>
  </div>
	<?php endif; ?>
	<div class="form-group">
		<?php echo Form::label('status', 'Status', ['class' => 'col-sm-1 control-label']); ?>

					<div class="col-sm-5 col-xs-12 <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">
								<?php echo e(Form::select('status', $activations, null, ['class' => 'form-control select2_demo_1'])); ?>

								<?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

							</div>
	</div>
	<div class="form-group">
		<?php if($level == '0'): ?>
		<?php echo Form::label('address', 'Address', ['class' => 'col-sm-1 control-label']); ?>

		<div class="col-sm-5 <?php echo e($errors->has('address') ? 'has-error' : ''); ?>">
			<?php echo Form::textarea('address', null, ['rows'=>'2','class' => 'form-control']); ?>

				<?php echo $errors->first('address', '<p class="help-block">:message</p>'); ?>

		</div>
		<?php endif; ?>
		<?php echo Form::label('desc', 'Description', ['class' => 'col-sm-1 control-label']); ?>

		<div class="col-sm-5 <?php echo e($errors->has('desc') ? 'has-error' : ''); ?>">
			<?php echo Form::textarea('desc', null, ['rows'=>'2','class' => 'form-control']); ?>

				<?php echo $errors->first('desc', '<p class="help-block">:message</p>'); ?>

		</div>
	</div>



    <div class="form-group">
<a href="<?php echo e(url('status')); ?>" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
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