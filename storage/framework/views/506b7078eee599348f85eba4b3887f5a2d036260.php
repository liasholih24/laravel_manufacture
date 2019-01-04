<?php $__env->startSection('title'); ?>
New user role
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php echo e(HTML::style('assets_back/css/plugins/iCheck/custom.css')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div  class="wrapper wrapper-content">
					<div class="row detail_content3">
	<div class="col-lg-12 detail_content2" style="background-color: white"><style>
						.ibox { margin: 1px 2px 0px 0px !important }
						.ibox.float-e-margins{ margin: 0px 2px !important}
						</style>
      <div class="row ibox-title">
   <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
        <li class="">
            <a href="<?php echo e(url('role')); ?>">  Roles
        </li>
        /
        <li class="">
                <a href="#">
                    Add New
                </a>
        </li>
    </ol>
            <a href="<?php echo e(url('role')); ?>">
            <button class="btn btn-sm btn-outline btn-warning pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
<div class="row ibox-content" style="min-height: 65vh; ">
	<div class="col-xs-12 col-sm-12">
    <?php echo Form::open(['url' => 'role', 'class' => 'form-horizontal']); ?>

<?php echo Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

<?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>


            <div class="form-group <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
                <?php echo Form::label('name', 'Name', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5 col-xs-12 ">
                    <?php echo Form::text('name', null, ['class' => 'form-control']); ?>

										<?php echo $errors->first('name', '<p class="help-block">:message</p>'); ?>

                </div>
								<?php echo Form::label('level', 'Level', ['class' => 'col-sm-1 control-label']); ?>

								<div class="col-sm-5 col-xs-12 <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">
									<div class="input-group col-sm-12 col-xs-12 ">
										<select class="form-control m-b" name="level">
											<option value="">Choose Level</option>
											<option value="Head Office">Head Office</option>
											<option value="SBU & POP">SBU & POP</option>
										</select>
									</div>
								</div>

            </div>
						<div class="form-group">
						<?php echo Form::label('desc', 'Desc', ['class' => 'col-sm-1 control-label']); ?>

							<div class="col-sm-5 col-xs-12  <?php echo e($errors->has('desc') ? 'has-error' : ''); ?>">
							<textarea name="desc" type="text" class="form-control" placeholder="Description of location. [ Maks. 500 char ]" style="height: auto"></textarea>
						</div>
						<?php echo Form::label('status', 'Activation', ['class' => 'col-sm-1 control-label']); ?>

						<div class="col-sm-5 col-xs-12 <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">
							<div class="input-group col-sm-12 col-xs-12 ">
								<?php echo e(Form::select('status', ['1' => 'Active','2' => 'Inactive'], null, ['class' => 'form-control','placeholder'=>'Select Status'])); ?>


							</div>
						</div>
						</div>
						<div class="form-group">
						<?php echo Form::label('', 'Modules', ['class' => 'col-sm-1 control-label']); ?>

					</div>

					<div class="form-group">
 <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			        <div class="col-md-4">
			          <?php $first= array_values($action)[0];
			            $firstname =explode(".", $first)[0];
			          ?>
<?php if($firstname == "home"): ?>
<?php echo e(Form::label($firstname, $firstname, ['class' => 'form col-md-3 capital_letter'])); ?>

<div class="col-sm-6 col-xs-12" >
		<input name="permissions[]"  value="<?php echo e($firstname); ?>.dashboard"  type="checkbox" class="i-checks" checked disabled>
</div>

<?php else: ?>
<?php echo e(Form::label($firstname, $firstname, ['class' => 'form col-md-3 capital_letter'])); ?>

<div class="col-sm-6 col-xs-12">
		<input name="permissions[]"  value="<?php echo e($firstname); ?>.index" type="checkbox" class="i-checks" checked>

</div>
<?php endif; ?>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			    </div>
<div class="form-group">
<a href="<?php echo e(url ('role')); ?>" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>

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


<?php echo e(HTML::script('assets_back/js/plugins/iCheck/icheck.min.js')); ?>


<script>
		$(document).ready(function () {
				$('.i-checks').iCheck({
						checkboxClass: 'icheckbox_square-green',
						radioClass: 'iradio_square-green',
				});
		});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>