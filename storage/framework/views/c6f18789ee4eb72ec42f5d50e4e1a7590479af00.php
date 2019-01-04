<?php $__env->startSection('title'); ?>
Create new <?php if($level == 1): ?> Site <?php elseif($level == 0): ?> SBU <?php else: ?> New <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Manage Master sbu/site
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
		 <?php if($level == 0): ?>
		 <li class="">
			<a href="#">
				SBU
			</a>
		</li>
		<?php else: ?>
		 <li class="">

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
    <?php echo Form::open(['url' => 'sbu', 'class' => 'form-horizontal']); ?>

		<?php echo Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

		<?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

		<?php 
switch ($level) {
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
		   $title = "Building";
			 $depthicon = "fa-list";
			 $depthname = "";
		break;
case 3:
			 $title = "Room";
			 $depthicon = "fa-list";
			 $depthname = "";
			 break;
}
 ?>
<?php echo Form::hidden('title', $title); ?>

<?php echo Form::hidden('subtitle', "Manage Your $title"); ?>

<?php echo Form::hidden('depthicon', $depthicon); ?>

<?php echo Form::hidden('depthname', $depthname); ?>

<?php echo Form::hidden('level', $level); ?>

<?php echo Form::hidden('id', $id); ?>

<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
<?php if($level == 1): ?>
<div class="form-group">
				<?php echo Form::label('parent_id', 'SBU Name*', ['class' => 'col-sm-2 control-label']); ?>

				<div class="col-sm-4 col-xs-12 <?php echo e($errors->has('parent_id') ? 'has-error' : ''); ?>">
					<select name="parent_id" class="form-control  chosen-select SelectSBU chosen-update" data-placeholder="SBU" width="100%">
						<option value="">Select SBU<option>
							<?php $__currentLoopData = $sbu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($item->depth == "0"): ?>
									<option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
								<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
						<?php echo $errors->first('parent_id', '<p class="help-block">:message</p>'); ?>

				</div>
				<?php echo Form::label('province', 'Province*', ['class' => 'col-sm-2 control-label']); ?>

				<div class="col-sm-4 col-xs-12 <?php echo e($errors->has('province') ? 'has-error' : ''); ?>">
				<select  name="province" class="form-control SelectProvince chosen-select chosen-update2 province_chosen" data-placeholder="Province" >
				</select>
				<?php echo $errors->first('province', '<p class="help-block">:message</p>'); ?>

        </div>
</div>

<div class="form-group">
	<?php echo Form::label('region', 'City*', ['class' => 'col-sm-2 control-label']); ?>

	<div class="col-sm-4 col-xs-12 <?php echo e($errors->has('region') ? 'has-error' : ''); ?>">
		<select  name="region" class="form-control  chosen-select chosen-update3 region_chosen" data-placeholder="Region" >
		</select>
		<?php echo $errors->first('region', '<p class="help-block">:message</p>'); ?>

	</div>
</div>
<div class="form-group ">
				<?php echo Form::label('model', 'Model*', ['class' => 'col-sm-2 control-label']); ?>

					<div class="col-sm-4 col-xs-12 <?php echo e($errors->has('model') ? 'has-error' : ''); ?>">
						<?php echo e(Form::select('model', $models, null, ['class' => 'form-control  chosen-select','placeholder' => 'Select Model'])); ?>

						<?php echo $errors->first('model', '<p class="help-block">:message</p>'); ?>

					</div>
				<?php echo Form::label('type', 'Type*', ['class' => 'col-sm-2 control-label']); ?>

				<div class="col-sm-4 col-xs-12 <?php echo e($errors->has('type') ? 'has-error' : ''); ?>">
					  <?php echo e(Form::select('type', $types, null, ['class' => 'form-control  chosen-select','placeholder' => 'Select Type'])); ?>

						<?php echo $errors->first('type', '<p class="help-block">:message</p>'); ?>

				</div>

</div>
<?php endif; ?>
<?php if($level == 3): ?>
<div class="form-group ">
				<?php echo Form::label('parent_id', 'Building*', ['class' => 'col-sm-2 control-label']); ?>

					<div class="col-sm-4 col-xs-12 <?php echo e($errors->has('model') ? 'has-error' : ''); ?>">
						<?php echo e(Form::select('parent_id', $buildings, null, ['class' => 'form-control select2_demo_1','placeholder' => 'Select Building'])); ?>

						<?php echo $errors->first('parent_id', '<p class="help-block">:message</p>'); ?>

					</div>
	</div>
<?php endif; ?>
<div class="form-group">
	<?php if($level == 0): ?>
		<?php echo Form::label('code', 'SBU ID*', ['class' => 'col-sm-2 control-label']); ?>

	<?php elseif($level == 1): ?>
	<?php echo Form::label('code', 'POP ID*', ['class' => 'col-sm-2 control-label']); ?>

	<?php elseif($level >= 2): ?>
	<?php echo Form::label('code', 'Code*', ['class' => 'col-sm-2 control-label']); ?>

	<?php endif; ?>
		    <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('code') ? 'has-error' : ''); ?>">
		         <?php echo Form::text('code', null, ['class' => 'form-control']); ?>

		         <?php echo $errors->first('code', '<p class="help-block">:message</p>'); ?>

		    </div>

		<?php echo Form::label('status', 'Status', ['class' => 'col-sm-2 control-label']); ?>

					<div class="col-sm-4 col-xs-12 <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">
								<?php echo e(Form::select('status', $statuses, null, ['class' => 'form-control'])); ?>

								<?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

							</div>
</div>


          <div class="form-group">
						<?php if($level == 0): ?>
							<?php echo Form::label('name', 'SBU Name*', ['class' => 'col-sm-2 control-label']); ?>

						<?php elseif($level == 1): ?>
						<?php echo Form::label('name', 'POP Name*', ['class' => 'col-sm-2 control-label']); ?>

						<?php elseif($level >= 2): ?>
						<?php echo Form::label('name', 'Name*', ['class' => 'col-sm-2 control-label']); ?>

						<?php endif; ?>
						<div class="col-sm-4 col-xs-12 <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
						<?php echo Form::text('name', null, ['class' => 'form-control']); ?>

						<?php echo $errors->first('name', '<p class="help-block">:message</p>'); ?>

					</div>
							<?php echo Form::label('address', 'Address', ['class' => 'col-sm-2 control-label']); ?>

							<div class="col-sm-4 col-xs-12 <?php echo e($errors->has('address') ? 'has-error' : ''); ?>">
										<textarea name="address" type="text" class="form-control" placeholder="Address. [ Maks. 500 char ]" style="height: auto"></textarea>
									<?php echo $errors->first('address', '<p class="help-block">:message</p>'); ?>

							</div>

            </div>
					<div class="form-group">
						<?php echo Form::label('desc', 'Desc', ['class' => 'col-sm-2 control-label']); ?>

						<div class="col-sm-4 col-xs-12 <?php echo e($errors->has('desc') ? 'has-error' : ''); ?>">
									<textarea name="desc" type="text" class="form-control" placeholder="Description. [ Maks. 500 char ]" style="height: auto"></textarea>
								<?php echo $errors->first('desc', '<p class="help-block">:message</p>'); ?>

						</div>
						<?php echo Form::label('offline_sts', 'Offline Mode', ['class' => 'col-sm-2 control-label']); ?>

						<div class="col-sm-4 <?php echo e($errors->has('mobile_id') ? 'has-error' : ''); ?>">
							<?php echo e(Form::select('offline_sts', ['0' => 'No','1' => 'Yes'], null, ['class' => 'form-control'])); ?>

						<?php echo $errors->first('offline_sts', '<p class="help-block">:message</p>'); ?>

						</div>
					</div>

								<div class="hr-line-dashed"></div>
								<?php echo $errors->first('locations', '<p style="color:red;">:message</p>'); ?>

								<?php if($level == 0): ?>
								<div class="content form-group col-sm-22 col-xs-12">
								<?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="col-sm-3" style="padding: 10px 0">
								<input type="checkbox" name="locations[]" value="<?php echo e($location->id); ?>" class="form-control i-checks disabled" <?php echo !empty($location->location_id)? "": ""; ?>> &nbsp;  <?php echo e($location->name); ?>

								</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>

								<?php endif; ?>
    <div class="form-group">
<a href="<?php echo e(url()->previous()); ?>" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
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



	// url = 'http://188.166.215.2/iconplus_ams/public';
// fungsi Select province
$('#sbu').on('change', function(e){
		 console.log(e);
		 var sbu_id = e.target.value;


		 //ajax

		 $.get('/province?sbu_id=' + sbu_id, function(data){  // Ganti bagian ini......

			 $('#province').empty();
			  $('#province').append('<option value="#">Select Province</option>');
			 $.each(data, function(index, subcatObj){
				 $('#province').append('<option value="'+subcatObj.location_id+'">'+subcatObj.name+'</option>');
			 });
		 });
	 });
	 // fungsi Select region
	 $('#province').on('change', function(e){
	 		 console.log(e);
	 		 var province_id = e.target.value;

	 		 //ajax

	 		 $.get('/region?province_id=' + province_id, function(data){  // Ganti bagian ini......

	 			 $('#region').empty();
	 			  $('#region').append('<option value="#">Select Region</option>');
	 			 $.each(data, function(index, subcatObj){
	 				 $('#region').append('<option value="'+subcatObj.id+'">'+subcatObj.name+'</option>');
	 			 });
	 		 });
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