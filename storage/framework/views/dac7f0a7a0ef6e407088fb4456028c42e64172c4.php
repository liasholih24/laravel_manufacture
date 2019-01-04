<?php $__env->startSection('style'); ?>
  <style>
    .ibox { margin: 1px 2px 0px 0px !important }
    .ibox.float-e-margins{ margin: 0px 2px !important}
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
	Create new Brand
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<div class="wrapper wrapper-content">
		<div class="row detail_content3">
			<div class="col-lg-12 detail_content2" style="background-color: white">
				<div class="row ibox-title">
					<ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
						<li class="">
            	<a href="<?php echo e(url('brand')); ?>">
            		Brand
            	</a>
        		</li>
        		<li class="">
              <a href="#">
              	Add New
							</a>
        		</li>
    			</ol>
          <a href="<?php echo e(url('brand')); ?>">
            <button class="btn btn-sm btn-outline btn-warning pull-right">
            	<i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
          </a>
    		</div>
				<div class="row ibox-content" style="min-height: 65vh; ">
					<div class="col-xs-12 col-sm-12">
						<?php echo Form::open(['url' => 'brand', 'class' => 'form-horizontal']); ?>

            <?php echo Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

          	<?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

            <?php echo Form::hidden('depth', 0, ['class' => 'form-control']); ?>

						<div class="form-group <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
              <?php echo Form::label('code', 'Abbreviaton: ', ['class' => 'col-sm-1 control-label']); ?>

              <div class="col-sm-5 col-xs-12">
              	<?php echo Form::text('code', null, ['class' => 'form-control']); ?>

                <?php echo $errors->first('code', '<p class="help-block">:message</p>'); ?>

              </div>

              <?php echo Form::label('status', 'Status: ', ['class' => 'col-sm-1 control-label']); ?>

          		<div class="col-sm-5">
          			<?php echo e(Form::select('status', $activations, null, ['class' => 'form-control select2_demo_1'])); ?>

          				<?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>


                </div>
              </div>
            <div class="form-group <?php echo e($errors->has('desc') ? 'has-error' : ''); ?>">

              <?php echo Form::label('name', 'Name: ', ['class' => 'col-sm-1 control-label']); ?>

              <div class="col-sm-5 col-xs-12">
              	<?php echo Form::text('name', null, ['class' => 'form-control']); ?>

                <?php echo $errors->first('name', '<p class="help-block">:message</p>'); ?>

              </div>

              <?php echo Form::label('desc', 'Desc: ', ['class' => 'col-sm-1 control-label']); ?>

							<div class="col-sm-5 col-xs-12">
								<textarea name="desc" type="text" class="form-control" placeholder="Description of brand. [ Maks. 500 char ]" style="height: auto"></textarea>
								<?php echo $errors->first('desc', '<p class="help-block">:message</p>'); ?>

							</div>
            </div>
          	<?php echo Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

    				<div class="form-group">
							<a href="<?php echo e(url('brand')); ?>" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
	      				<button type="submit" class="create_mdl btn btn-outline btn-primary pull-right" style="margin-right: 20px; ">
	                <i class="fa fa-plus-circle"></i>  Create
	              </button>
      				</a>
    				</div>
    				<?php echo Form::close(); ?>

    			</div>
    		</div>
  		</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>