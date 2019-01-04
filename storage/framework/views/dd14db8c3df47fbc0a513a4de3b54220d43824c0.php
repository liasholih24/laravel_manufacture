<?php $__env->startSection('title'); ?>
Edit Location
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
            <a href="<?php echo e(url('location')); ?>">  Location <?php echo e($location->depth); ?>

        </li>
        /
        <li class="">
                <a href="#">
                    Edit Location
                </a>
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
  <?php echo Form::model($location, [
      'method' => 'PATCH',
      'url' => ['location', $location->id],
      'class' => 'form-horizontal'
  ]); ?>


	<?php echo Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

	<?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>


		<div class="form-group">
						<?php echo Form::label('kode', 'Code', ['class' => 'col-sm-1 control-label']); ?>

					<div class="col-sm-5 col-xs-12 <?php echo e($errors->has('kode') ? 'has-error' : ''); ?>">
						<?php echo Form::text('kode', null, ['class' => 'form-control']); ?>

						<?php echo $errors->first('kode', '<p class="help-block">:message</p>'); ?>

					</div>
					<?php echo Form::label('capital', 'Capital', ['class' => 'col-sm-1 control-label']); ?>

				<div class="col-sm-5 col-xs-12 <?php echo e($errors->has('capital') ? 'has-error' : ''); ?>">
					<?php echo Form::text('capital', null, ['class' => 'form-control']); ?>

					<?php echo $errors->first('capital', '<p class="help-block">:message</p>'); ?>

				</div>
			</div>

	<div class="form-group">
		<?php echo Form::label('name', 'Name', ['class' => 'col-sm-1 control-label']); ?>

	<div class="col-sm-5 col-xs-12 <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
		<?php echo Form::text('name', null, ['class' => 'form-control']); ?>

		<?php echo $errors->first('name', '<p class="help-block">:message</p>'); ?>

	</div>

	<?php echo Form::label('status', 'Status', ['class' => 'col-sm-1 control-label']); ?>

	<div class="col-sm-5 col-xs-12 <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">

			<?php echo e(Form::select('status', $activations, null, ['class' => 'form-control '])); ?>


	</div>
</div>

	<div class="form-group">
		<?php if($location->depth != "0"): ?>
			<?php echo Form::label('area', 'Area', ['class' => 'col-sm-1     control-label']); ?>

			<div class="col-sm-5 col-xs-12">
				<div class="input-group col-sm-12 col-xs-12 ">
					<?php echo e(Form::select('parent_id', $locations, null, ['class' => 'form-control '])); ?></div>
					<?php echo $errors->first('category', '<p class="help-block">:message</p>'); ?>

			</div>
	<?php endif; ?>
	<?php echo Form::label('desc', 'Desc', ['class' => 'col-sm-1 control-label']); ?>

		<div class="col-sm-5 col-xs-12 <?php echo e($errors->has('desc') ? 'has-error' : ''); ?>">
		<textarea name="desc" type="text" class="form-control" placeholder="Description of location. [ Maks. 500 char ]" style="height: auto"><?php echo e($location->desc); ?></textarea>
		</div>
	</div>


    <div class="form-group">

      <a href="<?php echo e(url('location')); ?>" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>

            <button type="submit" class="create_mdl btn btn-outline btn-primary pull-right" style="margin-right: 20px; ">
                              <i class="fa fa-save"></i>  Update
                            </button>
    </div>
		</div>
    </div>
    </div>
    <?php echo Form::close(); ?>

  </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>