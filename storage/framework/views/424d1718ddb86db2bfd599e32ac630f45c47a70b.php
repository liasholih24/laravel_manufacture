<?php $__env->startSection('title'); ?>
Edit  <?php echo empty($sbu->title)?"Model":$sbu->title; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
<?php echo e($sbu->subtitle); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php echo e(HTML::style('assets_back/css/plugins/iCheck/custom.css')); ?>

<?php echo e(HTML::style('assets_back/css/plugins/select2/select2.min.css')); ?>

<?php echo e(HTML::style('assets_back/css/plugins/chosen/chosen.css')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="wrapper wrapper-content">
					<div class="row detail_content3">
	<div class="col-lg-12 detail_content2" style="background-color: white"><style>
						.ibox { margin: 1px 2px 0px 0px !important }
						.ibox.float-e-margins{ margin: 0px 2px !important}
						</style>
  <div class="row ibox-title">
   <ol class="breadcrumb col-sm-4 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
		 <?php if($sbu->depth == 0): ?>
		<li class="">
		 <a href="#">
			 SBU
		 </a>
	 </li>
	 <?php elseif($sbu->depth < 3): ?>
		<li class="">
			<a href="#">
				<?php echo empty($sbu->getsbu->name)? "No SBU" : $sbu->getsbu->name; ?>

			</a>
		</li>
		<li class="">
			<a href="#">
				<?php echo !empty($sbu->first()->name)?"$sbu->name":$node->first()->name; ?>

			</a>
		</li>
		<?php elseif($sbu->depth >=3): ?>
		<li class="">
			<a href="#">
				<?php echo empty($sbu->getpop->name)?"SBU":$sbu->getpop->name; ?>

			</a>
		</li>
		<li class="">
			<a href="#">
				<?php echo !empty($sbu->first()->name)?"$sbu->name":$node->first()->name; ?>

			</a>
		</li>
		<?php endif; ?>
    </ol>
            <a href="<?php echo e(url()->previous()); ?>">
            <button class="btn btn-sm btn-outline btn-warning pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>

<div class="row ibox-content" style="min-height: 65vh; ">
	<div class="col-xs-12 col-sm-22">
		<?php echo Form::model($sbu, [
        'method' => 'PATCH',
        'url' => ['sbu', $sbu->id],
        'class' => 'form-horizontal'
    ]); ?>


		<?php echo Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

		<?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

		<?php 
switch ($sbu->depth) {
case 0:
			$title = "SBU";
			$depthname = "Site List";
			$depthicon = "fa-globe";

    break;
case 1:
    	$title = "Site";
			$depthicon = "fa-list";
			$depthname = "";
		break;
case 2:
		   $title = "select model";
			 $depthicon = "fa-list";
			 $depthname = "";
		break;
		case 3:
				   $title = "";
					 $depthicon = "fa-list";
					 $depthname = "";
				break;
				case 4:
						   $title = "";
							 $depthicon = "fa-list";
							 $depthname = "";
						break;
}
 ?>
<?php echo Form::hidden('title', $title); ?>

<?php echo Form::hidden('subtitle', "Manage Your $title"); ?>

<?php echo Form::hidden('depthicon', $depthicon); ?>

<?php echo Form::hidden('depthname', "$depthname"); ?>

<?php echo Form::hidden('level', $sbu->depth); ?>


<?php if($sbu->depth == 1): ?>
<div class="form-group">
				<?php echo Form::label('sbu', 'SBU*', ['class' => 'col-sm-2 control-label']); ?>

				<div class="col-sm-4 col-xs-12 <?php echo e($errors->has('sbu') ? 'has-error' : ''); ?>">
					<select name="parent_id" class="form-control chosen-select SelectSBU chosen-update">
						<option value="<?php echo e($sbu->parent_id); ?>" selected><?php echo empty($sbu->getsbu->name)? "No SBU Data" : $sbu->getsbu->name; ?></option>
						<?php $__currentLoopData = $sbus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if($item->depth == "0"): ?>
								<option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
							<?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					</select>
						<?php echo $errors->first('sbu', '<p class="help-block">:message</p>'); ?>

				</div>

				<?php echo Form::label('province', 'Province*', ['class' => 'col-sm-2 control-label']); ?>

				<div class="col-sm-4 col-xs-12 <?php echo e($errors->has('province') ? 'has-error' : ''); ?>">
				<select name="province" class="form-control SelectProvince chosen-select chosen-update2 province_chosen">
					<?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($province->id); ?>" <?php echo e($province->id == $sbu->province ?"selected":""); ?>><?php echo e($province->name); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
				<?php echo $errors->first('province', '<p class="help-block">:message</p>'); ?>

        </div>
</div>

<div class="form-group">
	<?php echo Form::label('region', 'City*', ['class' => 'col-sm-2 control-label']); ?>

	<div class="col-sm-4 col-xs-12 <?php echo e($errors->has('region') ? 'has-error' : ''); ?>">
		<select name="region" class="form-control chosen-select chosen-update3 region_chosen">
			<?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($city->id); ?>" <?php echo e($city->id == $sbu->region ?"selected":""); ?>><?php echo e($city->name); ?></option>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</select>
		<?php echo $errors->first('region', '<p class="help-block">:message</p>'); ?>

	</div>

</div>

<div class="form-group ">
				<?php echo Form::label('model', 'Model*', ['class' => 'col-sm-2 control-label']); ?>

					<div class="col-sm-4 col-xs-12 <?php echo e($errors->has('model') ? 'has-error' : ''); ?>">
						<?php echo Form::select('model', $models, $sbu->model, ['class' => 'form-control chosen-select','placeholder'=>'Select Model']); ?>

						<?php echo $errors->first('model', '<p class="help-block">:message</p>'); ?>

					</div>
				<?php echo Form::label('type', 'Type*', ['class' => 'col-sm-2 control-label']); ?>

				<div class="col-sm-4 col-xs-12 <?php echo e($errors->has('type') ? 'has-error' : ''); ?>">
					  <?php echo Form::select('type', $types, $sbu->type, ['class' => 'form-control chosen-select']); ?>

						<?php echo $errors->first('type', '<p class="help-block">:message</p>'); ?>

				</div>

</div>
<?php endif; ?>
<?php if($sbu->depth == 2): ?>
<div class="form-group">
	<?php echo Form::label('model', 'Model: ', ['class' => 'col-sm-2 control-label']); ?>

				<div class="col-sm-4 col-xs-12 <?php echo e($errors->has('model') ? 'has-error' : ''); ?>">
							<?php echo Form::select('model', $pop_models, null, ['class' => 'form-control select2_demo_1','placeholder'=>'Select Model']); ?>

							<?php echo $errors->first('model', '<p class="help-block">:message</p>'); ?>

				</div>
</div>
<?php endif; ?>
<div class="form-group">
	<?php if($sbu->depth == 0): ?>
		<?php echo Form::label('code', 'SBU ID*', ['class' => 'col-sm-2 control-label']); ?>

	<?php elseif($sbu->depth == 1): ?>
	<?php echo Form::label('code', 'Site ID*', ['class' => 'col-sm-2 control-label']); ?>

	<?php elseif($sbu->depth >= 2): ?>
	<?php echo Form::label('code', 'Code: ', ['class' => 'col-sm-2 control-label']); ?>

	<?php endif; ?>
		    <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('code') ? 'has-error' : ''); ?>">
		         <?php echo Form::text('code', null, ['class' => 'form-control']); ?>

		         <?php echo $errors->first('code', '<p class="help-block">:message</p>'); ?>

		    </div>

		<?php echo Form::label('status', 'Status', ['class' => 'col-sm-2 control-label']); ?>

					<div class="col-sm-4 col-xs-12 <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">
								<?php echo Form::select('status', $statuses, null, ['class' => 'form-control']); ?>

								<?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

							</div>
</div>


          <div class="form-group">
					<?php echo Form::label('name', ' Name*', ['class' => 'col-sm-2 control-label']); ?>

						<div class="col-sm-4 col-xs-12 <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
						<?php echo Form::text('name', null, ['class' => 'form-control']); ?>

						<?php echo $errors->first('name', '<p class="help-block">:message</p>'); ?>

					</div>

							<?php echo Form::label('address', 'Address', ['class' => 'col-sm-2 control-label']); ?>

							<div class="col-sm-4 col-xs-12 <?php echo e($errors->has('address') ? 'has-error' : ''); ?>">
										<textarea name="address" type="text" class="form-control" placeholder="Address. [ Maks. 500 char ]" style="height: auto"><?php echo e($sbu->address); ?></textarea>
									<?php echo $errors->first('address', '<p class="help-block">:message</p>'); ?>

							</div>

            </div>
					<div class="form-group">
						<?php echo Form::label('desc', 'Desc', ['class' => 'col-sm-2 control-label']); ?>

						<div class="col-sm-4 col-xs-12 <?php echo e($errors->has('desc') ? 'has-error' : ''); ?>">
									<textarea name="desc" type="text" class="form-control" placeholder="Description. [ Maks. 500 char ]" style="height: auto"><?php echo e($sbu->desc); ?></textarea>
								<?php echo $errors->first('desc', '<p class="help-block">:message</p>'); ?>

						</div>
						<?php echo Form::label('offline_sts', 'Offline Mode', ['class' => 'col-sm-2 control-label']); ?>

						<div class="col-sm-4 <?php echo e($errors->has('mobile_id') ? 'has-error' : ''); ?>">
							<?php echo e(Form::select('offline_sts', ['1' => 'Yes','0' => 'No'], null, ['class' => 'form-control','placeholder'=>'Select Offline Mode '])); ?>

						<?php echo $errors->first('offline_sts', '<p class="help-block">:message</p>'); ?>

						</div>
					</div>
								<div class="hr-line-dashed"></div>
								<?php if($sbu->depth == 0): ?>
								<div class="content form-group col-sm-22 col-xs-12">
								<?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="col-sm-3" style="padding: 10px 0">
								<!--<input type="checkbox" name="locations[]" value="<?php echo e($location->id); ?>" class="form-control i-checks disabled" <?php// if($location->sbu_id == $sbu->id){echo "checked";} else { if(!empty($location->location_id)){echo "disabled checked";}  }?>> &nbsp;  <?php echo e($location->name); ?>

								-->
								<input type="checkbox" name="locations[]" value="<?php echo e($location->id); ?>" class="form-control i-checks disabled" <?php if($location->sbu_id == $sbu->id){echo "checked";}?>> &nbsp;  <?php echo e($location->name); ?>

								</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
								<?php endif; ?>
    <div class="form-group">
<a href="<?php echo e(url()->previous()); ?>" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
      <button type="submit" class="create_mdl btn btn-outline btn-primary pull-right" style="margin-right: 10px; ">
                        <i class="fa fa-pencil"></i>  Update
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

<?php echo e(HTML::script('assets_back/js/plugins/select2/select2.full.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/chosen/chosen.jquery.js')); ?>

<script>
var csrf = $('meta[name="csrf-token"]').attr('content');
 jQuery(document).ready(function() {

	 var config = {
	 		'.chosen-select'           : {search_contains: true },
	 		'.chosen-select-deselect'  : {allow_single_deselect:true},
	 		'.chosen-select-no-single' : {disable_search_threshold:10},
	 		'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
	 		'.chosen-select-width'     : {width:"95%"}
	 		}
	 for (var selector in config) {
	 		$(selector).chosen(config[selector]);
	 }
	 $('.SelectSBU').on('change', function(e){

		if ($(this).find(':selected').val() != '') {

					 // SLOT NO
				var val     = $(this).find(':selected').val(),
						item_d  = $(this).find(':selected').data(),
						url     =  window.location.origin+'/province?sbu_id=' + val;
				 // alert(val);
					$.ajax({
							url : url,
							type: "GET",
							dataType: 'html',
							success: function(datas){
									$('.province_chosen').html(datas);
									$(".chosen-update2").trigger("chosen:updated");
									return false;
							}
					});
					//END SLOT NO

		}

	});
	$('.SelectProvince').on('change', function(e){

	 if ($(this).find(':selected').val() != '') {

					// SLOT NO
			 var val     = $(this).find(':selected').val(),
					 item_d  = $(this).find(':selected').data(),
					 url     =  window.location.origin+'/region?province_id=' + val;
				// alert(val);
				 $.ajax({
						 url : url,
						 type: "GET",
						 dataType: 'html',
						 success: function(datas){
								 $('.region_chosen').html(datas);
								 $(".chosen-update3").trigger("chosen:updated");
								 return false;
						 }
				 });
				 //END SLOT NO

	 }

 });

				$('.i-checks').iCheck({
						checkboxClass: 'icheckbox_square-green',
						radioClass: 'iradio_square-green',
				});

		$(".select2_demo_1").select2();
		});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>