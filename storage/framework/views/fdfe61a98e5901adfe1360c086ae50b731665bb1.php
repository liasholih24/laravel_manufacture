<?php $__env->startSection('title'); ?>
Create new Location
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
   <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px;">
        <li class="">
            <a href="<?php echo e(url('location')); ?>"> Location
        </li>
        <li class="">
            <a href="#"> Create
        </li>
    </ol>
            <a href="<?php echo e(url('location')); ?>">
            <button class="btn btn-sm btn-outline btn-warning pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
<div class="row ibox-content" style="min-height: 65vh; ">
	<div class="col-xs-12 col-sm-12">
    <?php echo Form::open(['url' => 'location', 'class' => 'form-horizontal']); ?>

		<?php echo Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

    <?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>


			<div class="form-group">
							<?php echo Form::label('kode', 'Code*', ['class' => 'col-sm-1 control-label']); ?>

						<div class="col-sm-5 col-xs-12 <?php echo e($errors->has('kode') ? 'has-error' : ''); ?>">
							<?php echo Form::text('kode', null, ['class' => 'form-control']); ?>

							<?php echo $errors->first('kode', '<p class="help-block">:message</p>'); ?>

						</div>
						<?php echo Form::label('status', 'Status', ['class' => 'col-sm-1 control-label']); ?>

						<div class="col-sm-5 col-xs-12 <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">
							<div class="input-group col-sm-12 col-xs-12 ">
								<?php echo e(Form::select('status', $activations, null, ['class' => 'form-control '])); ?>

							</div>
						</div>
		</div>
		<div class="form-group">
			<?php echo Form::label('name', 'Name*', ['class' => 'col-sm-1 control-label']); ?>

		<div class="col-sm-5 col-xs-12 <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
			<?php echo Form::text('name', null, ['class' => 'form-control']); ?>

      <?php echo $errors->first('name', '<p class="help-block">:message</p>'); ?>

		</div>
		<?php echo Form::label('capital', 'Capital*', ['class' => 'col-sm-1 control-label']); ?>

	<div class="col-sm-5 col-xs-12 <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
		<?php echo Form::text('capital', null, ['class' => 'form-control']); ?>

		<?php echo $errors->first('capital', '<p class="help-block">:message</p>'); ?>

	</div>

		</div>
    <div class="form-group">
			<?php if($level != 0): ?>
			<?php echo Form::label('area', 'Province', ['class' => 'col-sm-1     control-label']); ?>

      <div class="col-sm-5 col-xs-12 <?php echo e($errors->has('kategori') ? 'has-error' : ''); ?>">

				<?php echo e(Form::select('kategori', $locations, null, ['class' => 'form-control select2_demo_1','placeholder'=>'Select Province'])); ?>

        <?php echo $errors->first('category', '<p class="help-block">:message</p>'); ?>

      </div>
				<?php endif; ?>
				<?php if(!empty($parent_id)): ?>
				<?php echo Form::label('area', 'Province', ['class' => 'col-sm-1     control-label']); ?>

	      <div class="col-sm-5 col-xs-12 <?php echo e($errors->has('kategori') ? 'has-error' : ''); ?>">

					<?php echo e(Form::select('kategori', $locations, null, ['class' => 'form-control select2_demo_1'])); ?>

	        <?php echo $errors->first('category', '<p class="help-block">:message</p>'); ?>

	      </div>
				<?php endif; ?>

		<?php echo Form::label('desc', 'Desc', ['class' => 'col-sm-1 control-label']); ?>

			<div class="col-sm-5 col-xs-12 <?php echo e($errors->has('desc') ? 'has-error' : ''); ?>">
			<textarea name="desc" type="text" class="form-control" placeholder="Description of location. [ Maks. 500 char ]" style="height: auto"></textarea>
		</div>

		</div>
    <div class="form-group">
<a href="<?php echo e(url('location')); ?>" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
      <button type="submit" class="create_mdl btn btn-outline btn-primary pull-right" style="margin-right: 10px; ">
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
 jQuery(document).ready(function() {


		$(".select2_demo_1").select2();

		});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>