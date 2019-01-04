<?php $__env->startSection('title'); ?>
Create new <?php if($pop == 1): ?> POP <?php else: ?> SBU <?php endif; ?>

<?php echo e($pop); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Manage Master sbu/pop
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="wrapper wrapper-content">
					<div class="row detail_content3">
	<div class="col-lg-12 detail_content2" style="background-color: white"><style>
						.ibox { margin: 1px 2px 0px 0px !important }
						.ibox.float-e-margins{ margin: 0px 2px !important}
						</style>
      <div class="row ibox-title">
   <ol class="breadcrumb col-sm-5 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
        <li class="">
            <a href="<?php echo e(url('sbu')); ?>"> <?php if($pop == 1): ?> POP <?php else: ?> SBU <?php endif; ?>
        </li>
        /
        <li class="">
                <a href="#">
                    Add New
                </a>
        </li>
    </ol>
            <a href="<?php echo e(url('sbu')); ?>">
            <button class="btn btn-sm btn-outline btn-warning pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
<div class="row ibox-content" style="min-height: 65vh; ">
	<div class="col-xs-12 col-sm-12">
    <?php echo Form::open(['url' => 'sbu', 'class' => 'form-horizontal']); ?>

		<?php echo Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

		<?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>


                  <div class="form-group <?php echo e($errors->has('location') ? 'has-error' : ''); ?>">
										<?php echo Form::label('code', 'RegName: ', ['class' => 'col-sm-1 control-label']); ?>

		                <div class="col-sm-5 col-xs-12">
		                    <?php echo Form::text('code', null, ['class' => 'form-control']); ?>

		                    <?php echo $errors->first('code', '<p class="help-block">:message</p>'); ?>

		                </div>
										<?php echo Form::label('status', 'Status: ', ['class' => 'col-sm-1 control-label']); ?>

									<div class="col-sm-5 col-xs-12">
										<select class="form-control m-b" name="status">
											<option value="" disabled>Pilih Status</option>
											<?php $__currentLoopData = $statuses->getLeaves(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($status->id); ?>"><?php echo e($status->name); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

										</select>
											<?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

									</div>
            </div>
						<div class="form-group <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
						<?php echo Form::label('name', 'Name: ', ['class' => 'col-sm-1 control-label']); ?>

						<div class="col-sm-5 col-xs-12">
								<?php echo Form::text('name', null, ['class' => 'form-control']); ?>

								<?php echo $errors->first('name', '<p class="help-block">:message</p>'); ?>

						</div>
					</div>
          <div class="form-group <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
							<?php echo Form::label('address', 'Addres: ', ['class' => 'col-sm-1 control-label']); ?>

							<div class="col-sm-5 col-xs-12">
										<textarea name="address" type="text" class="form-control" placeholder="Address of sbu. [ Maks. 500 char ]" style="height: auto"></textarea>
									<?php echo $errors->first('address', '<p class="help-block">:message</p>'); ?>

							</div>
								<?php echo Form::label('desc', 'Desc: ', ['class' => 'col-sm-1 control-label']); ?>

								<div class="col-sm-5 col-xs-12">
											<textarea name="desc" type="text" class="form-control" placeholder="Description of sbu. [ Maks. 500 char ]" style="height: auto"></textarea>
										<?php echo $errors->first('desc', '<p class="help-block">:message</p>'); ?>

								</div>
            </div>

								<div class="hr-line-dashed"></div>
								<div class="form-group <?php echo e($errors->has('location') ? 'has-error' : ''); ?>">
									<?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="col-sm-2 col-xs-12">
									<input type="checkbox" name="locations[]" value="<?php echo e($location->id); ?>"> <?php echo e($location->name); ?>

								</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
    <div class="form-group">
<a href="<?php echo e(url('sbu')); ?>" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
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

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>