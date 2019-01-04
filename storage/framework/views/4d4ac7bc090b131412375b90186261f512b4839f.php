<?php $__env->startSection('title'); ?>
Create new Work Order
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Manage Work Order
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php echo e(HTML::style('assets_back/css/plugins/select2/select2.min.css')); ?>

<?php echo e(HTML::style('assets_back/css/plugins/datapicker/datepicker3.css')); ?>

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
            <a href="<?php echo e(url('status')); ?>"> Work Order
        </li>
        /
        <li class="">
                <a href="#">
                    Add New
                </a>
        </li>
    </ol>
            <a href="<?php echo e(url('status')); ?>">
            <button class="btn btn-sm btn-outline btn-warning pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
	<div class="row ibox-content" style="min-height: 65vh; ">
	<div class="col-xs-12 col-sm-22">
    <?php echo Form::open(['url' => 'workorder', 'class' => 'form-horizontal']); ?>

		<?php echo Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

		<?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>


		<div class="form-group">
			<?php echo Form::label('sbu_id', 'SBU*', ['class' => 'col-sm-2 control-label']); ?>

			<div class="col-sm-4 <?php echo e($errors->has('sbu_id') ? 'has-error' : ''); ?>">
				<select name="sbu_id" class="form-control select2_demo_1">
					<option value="">Select SBU</option>
					<?php $__currentLoopData = $sbus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sbu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($sbu->id); ?>"><?php echo e($sbu->name); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
					<?php echo $errors->first('sbu_id', '<p class="help-block">:message</p>'); ?>

			</div>
      <?php echo Form::label('status', 'Status', ['class' => 'col-sm-2 control-label']); ?>

			<div class="col-sm-4 <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">
				<?php echo e(Form::select('status', $activations, null, ['class' => 'form-control select2_demo_1'])); ?>

					<?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

			</div>
		</div>
    <div class="form-group">
      <?php echo Form::label('datestart', 'Date Start*', ['class' => 'col-sm-2 control-label']); ?>

    	<div class="col-sm-4 <?php echo e($errors->has('datestart') ? 'has-error' : ''); ?>">
    			<?php echo Form::text('datestart', null, ['id' => 'datestart','class' => 'form-control','data-date-format'=>'dd/mm/yyyy','placeholder' => $datenow]); ?>

    			<?php echo $errors->first('datestart', '<p class="help-block">:message</p>'); ?>

    	</div>
      <?php echo Form::label('dateend', 'Date End*', ['class' => 'col-sm-2 control-label']); ?>

    	<div class="col-sm-4 <?php echo e($errors->has('dateend') ? 'has-error' : ''); ?>">
    			<?php echo Form::text('dateend', null, ['id' => 'dateend','class' => 'form-control','data-date-format'=>'dd/mm/yyyy','placeholder' => $datenow]); ?>

    			<?php echo $errors->first('dateend', '<p class="help-block">:message</p>'); ?>

    	</div>

    </div>
<div class="form-group">
  <?php echo Form::label('code', 'Abbreviaton* : ', ['class' => 'col-sm-2 control-label']); ?>

	<div class="col-sm-10 <?php echo e($errors->has('code') ? 'has-error' : ''); ?>">
			<?php echo Form::text('code', null, ['class' => 'form-control']); ?>

			<?php echo $errors->first('code', '<p class="help-block">:message</p>'); ?>

	</div>


</div>
<div class="form-group">
<?php echo Form::label('name', 'Name* : ', ['class' => 'col-sm-2 control-label']); ?>

<div class="col-sm-10 <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
    <?php echo Form::text('name', null, ['class' => 'form-control']); ?>

    <?php echo $errors->first('name', '<p class="help-block">:message</p>'); ?>

</div>
</div>
<div class="form-group">
<?php echo Form::label('desc', 'Description: ', ['class' => 'col-sm-2 control-label']); ?>

<div class="col-sm-10 <?php echo e($errors->has('desc') ? 'has-error' : ''); ?>">
    <?php echo Form::textarea('desc', null, ['rows'=>'2','class' => 'form-control']); ?>

    <?php echo $errors->first('desc', '<p class="help-block">:message</p>'); ?>

</div>
</div>



    <div class="form-group">
<a href="<?php echo e(url('workorder')); ?>" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
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

<?php echo e(HTML::script('assets_back/js/plugins/datapicker/bootstrap-datepicker.js')); ?>


<script>
var csrf = $('meta[name="csrf-token"]').attr('content');
 jQuery(document).ready(function() {


		$(".select2_demo_1").select2();
		});

    $("#datestart").datepicker({
      startDate : '-0m',
      format :  'dd-mm-yyyy',
      keyboardNavigation : false,
      forceParce: false,
      todayBtn: 'linked',
      todayHighlight :  true,
      daysOfWeekDisabled : [0],
    });

    $("#dateend").datepicker({
      startDate : '-0m',
      format :  'dd-mm-yyyy',
      keyboardNavigation : false,
      forceParce: false,
      todayBtn: 'linked',
      todayHighlight :  true,
      daysOfWeekDisabled : [0],
    });


</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>