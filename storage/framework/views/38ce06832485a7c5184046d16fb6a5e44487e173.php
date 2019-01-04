<?php $__env->startSection('title'); ?>
Create New User
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Manage Users
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
   <ol class="breadcrumb col-sm-5 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
        <li class="">
            <a href="<?php echo e(url('user')); ?>"> Users
        </li>
        /
        <li class="">
                <a href="#">
                    Add New
                </a>
        </li>
    </ol>
            <a href="<?php echo e(url('organization')); ?>">
            <button class="btn btn-sm btn-outline btn-warning pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
<div class="row ibox-content" style="min-height: 65vh; ">
	<div class="col-xs-12 col-sm-12">
    <?php echo e(Form::open(array('url' => route('user.store'), 'class' => 'form-horizontal','files' => true))); ?>

    <?php echo Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

    <?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>


    <div class="form-group">
      <?php echo Form::label('first_name', 'First Name', ['class' => 'col-md-2 control-label']); ?>

      <div class="col-sm-4 <?php echo e($errors->has('first_name') ? 'has-error' : ''); ?>">
         <?php echo Form::text('first_name', null, ['class' => 'form-control']); ?>

         <?php echo $errors->first('first_name', '<p class="help-block">:message</p>'); ?>

      </div>
      <?php echo Form::label('last_name', 'Last name' , ['class' => 'col-md-2 control-label']); ?>

     <div class="col-sm-4">
         <?php echo Form::text('last_name', null, ['class' => 'form-control']); ?>

         <?php echo $errors->first('last_name', '<p class="help-block">:message</p>'); ?>

     </div>
    </div>
    <div class="form-group">
      <?php echo Form::label('email', 'Email', ['class' => 'col-md-2 control-label']); ?>

     <div class="col-sm-4 <?php echo e($errors->has('email') ? 'has-error' : ''); ?>">
         <?php echo Form::text('email', null, ['class' => 'form-control']); ?>

         <?php echo $errors->first('email', '<p class="help-block">:message</p>'); ?>

     </div>
     <?php echo Form::label('status','Status', ['class' => 'col-md-2 control-label']); ?>

    <div class="col-sm-4">
        <?php echo Form::select('status', $statuses, null, ['class' => 'form-control select2_demo_1','placeholder' => 'Select Status']); ?>

        <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

    </div>
    </div>
    <div class="form-group">
      <?php echo Form::label('role','User role', ['class' => 'col-md-2 control-label']); ?>

     <div class="col-sm-4 <?php echo e($errors->has('role') ? 'has-error' : ''); ?>">
         <?php echo Form::select('role', $roles, null, ['class' => 'form-control select2_demo_1','placeholder' => 'Select Role']); ?>

         <?php echo $errors->first('role', '<p class="help-block">:message</p>'); ?>

     </div>
     <?php echo Form::label('organization','Organization', ['class' => 'col-md-2 control-label']); ?>

     <div class="col-sm-4">
       <select class="form-control select2_demo_1" name="organization_id" placeholder="Select Organization">

           <option value="" >Select Organization</option>
         <?php $__currentLoopData = $organizations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $organization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <?php $__currentLoopData = $organization->getDescendantsAndSelf(array('id','parent_id','name','depth'))->toHierarchy(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <?php if($relation->depth==0): ?>
        <option value="<?php echo e($relation->id); ?>" ><?php echo e($relation->name); ?></option>
         <?php elseif($relation->depth==1): ?>
           <option value="<?php echo e($relation->id); ?>">
             &nbsp;&nbsp; - <?php echo e($relation->name); ?>

           </option>
         <?php elseif($relation->depth==2): ?>
           <option value="<?php echo e($relation->id); ?>">
             &nbsp;&nbsp;&nbsp; -- <?php echo e($relation->name); ?>

           </option>
           <?php elseif($relation->depth==3): ?>
             <option value="<?php echo e($relation->id); ?>">
               &nbsp;&nbsp;&nbsp; --- <?php echo e($relation->name); ?>

             </option>
         <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

       </select>

         <?php echo $errors->first('organization', '<p class="help-block">:message</p>'); ?>

     </div>
    </div>
    <div class="form-group">
    <?php echo Form::label('sbu_id','SBU', ['class' => 'col-md-2 control-label']); ?>

    <div class="col-sm-4">
       <?php echo Form::select('sbu_id', $sbus, null, ['class' => 'form-control select2_demo_1','placeholder' => 'Select SBU']); ?>

       <?php echo $errors->first('sbu_id', '<p class="help-block">:message</p>'); ?>

    </div>
		<?php echo Form::label('mobile_id', 'App Permission', ['class' => 'col-sm-2 control-label']); ?>

		<div class="col-sm-4 <?php echo e($errors->has('mobile_id') ? 'has-error' : ''); ?>">
			<?php echo e(Form::select('mobile_id', ['0' => 'Web Apps Only','1' => 'Mobile Apps Only','2' => 'Web & Mobile Apps'], null, ['class' => 'form-control','placeholder'=>'Select App Permission '])); ?>

		<?php echo $errors->first('mobile_id', '<p class="help-block">:message</p>'); ?>

		</div>
    </div>
    <div class="form-group <?php echo e($errors->has('password') ? 'has-error' : ''); ?>">
      <?php echo Form::label('password', 'Password', ['class' => 'col-md-2 control-label']); ?>

     <div class="col-sm-4">
         <?php echo Form::password('password', ['class' => 'form-control']); ?>

         <?php echo $errors->first('password', '<p class="help-block">:message</p>'); ?>

     </div>
     <?php echo Form::label('password_confirmation', 'Password Confirmation', ['class' => 'col-md-2 control-label']); ?>

    <div class="col-sm-4">
        <?php echo Form::password('password_confirmation', ['class' => 'form-control']); ?>

        <?php echo $errors->first('password_confirmation', '<p class="help-block">:message</p>'); ?>

    </div>
    </div>
		<div class="form-group">
			<?php echo Form::label('image', 'Image', ['class' => 'col-md-2 control-label']); ?>

			<div class="col-sm-4">
				<div class="btn-group">
					<label title="Upload image file" for="inputImage" class="btn btn-primary">
						<input type="file" accept="image/*" name="file" id="inputImage" class="hide">
						Upload new image
					</label>
				</div>
				<?php echo $errors->first('image', '<p class="help-block">:message</p>'); ?>

			</div>

			<?php echo Form::label('image', 'Preview Image', ['class' => 'col-md-2 control-label']); ?>

			<div class="col-sm-4">
				<img id="imagePreview" style="max-height:200px;">
				<?php echo $errors->first('image', '<p class="help-block">:message</p>'); ?>

			</div>

		</div>

                <div class="hr-line-dashed"></div>

<div class="form-group">
  <?php if(Sentinel::getUser()->hasAccess(['user.create'])): ?>
  <a href="<?php echo e(route('user.index')); ?>" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
      <button type="submit" class="create_mdl btn btn-outline btn-primary pull-right" style="margin-right: 10px; ">
            <i class="fa fa-plus-circle"></i>  Create
      </button>
  </a>
  <?php endif; ?>
</div>

      </div>
    </div>
    </div>
    <?php echo Form::close(); ?>

  </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>


<?php echo e(HTML::script('assets_back/js/plugins/select2/select2.full.min.js')); ?>



<script>
jQuery(document).ready(function() {
		$(".select2_demo_1").select2();
		function readURL(input) {

				if (input.files && input.files[0]) {
						var reader = new FileReader();

						reader.onload = function (e) {
								$('#imagePreview').attr('src', e.target.result);
						}

						reader.readAsDataURL(input.files[0]);
				}
		}

		$("#inputImage").change(function(){
				readURL(this);
		});
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>