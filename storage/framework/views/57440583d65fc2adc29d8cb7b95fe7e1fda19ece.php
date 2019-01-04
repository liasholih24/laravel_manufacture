<?php $__env->startSection('title'); ?>
	Create new Brand
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<style>
  .ibox { margin: 1px 2px 0px 0px !important }
  .ibox.float-e-margins{ margin: 0px 2px !important}
  .tempstyle {

    position: relative;background-color: #f4f4f4; padding: 10px 0 ; border: solid 2px #fff; border-radius: 3px; margin-top: 2px; margin-bottom: 2px;
  }
	.iCheck-helper{
		 top: 0%; left: 0%; width: 100%;
		height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;
	}
</style>
<?php echo e(HTML::style('assets_back/css/plugins/iCheck/custom.css')); ?>

<?php echo e(HTML::style('assets_back/css/plugins/select2/select2.min.css')); ?>

<?php echo e(HTML::style('assets_back/css/plugins/cropper/cropper.min.css')); ?>

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
          <a href="<?php echo e(url()->previous()); ?>">
            <button class="btn btn-sm btn-outline btn-warning pull-right">
            	<i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
          </a>
    		</div>
				<div class="row ibox-content" style="min-height: 65vh; ">
					<div class="col-xs-12 col-sm-22">
						<?php echo Form::open(['url' => 'brand', 'class' => 'form-horizontal', 'files' => true]); ?>

            <?php echo Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

          	<?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

            <?php echo Form::hidden('depth', 1, ['class' => 'form-control']); ?>

            <div class="form-group">
              <?php echo Form::label('brand', 'Brand*', ['class' => 'col-sm-2 control-label']); ?>

              <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('parent_id') ? 'has-error' : ''); ?>">
                <select name="parent_id" class="form-control select2_demo_1">
									<option value="">Select Brand</option>
    						      <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    							           <?php if($item->depth == "0"): ?>
    								          <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
    							            <?php endif; ?>
    						      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    					  </select>
    						<?php echo $errors->first('parent_id', '<p class="help-block">:message</p>'); ?>

              </div>
              <?php echo Form::label('type', 'Type*', ['class' => 'col-sm-2 control-label']); ?>

              <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('type') ? 'has-error' : ''); ?>">
                <select name="type" id="type" class="form-control select2_demo_1" data-placeholder="Select Type">
									<option value="">Select Type</option>
										<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <?php if($item->nesting == "0"): ?>
                              <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                              <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php echo $errors->first('type', '<p class="help-block">:message</p>'); ?>

              </div>
            </div>
						<div class="form-group">
							<?php echo Form::label('name', 'Model*', ['class' => 'col-sm-2 control-label']); ?>

							<div class="col-sm-4 col-xs-12 <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
								<?php echo Form::text('name', null, ['class' => 'form-control','placeholder'=>'Model Name.']); ?>

								<?php echo $errors->first('name', '<p class="help-block">:message</p>'); ?>

							</div>
            <?php echo Form::label('category', 'Category*', ['class' => 'col-sm-2 control-label']); ?>

          	<div class="col-sm-4 col-xs-12 <?php echo e($errors->has('category') ? 'has-error' : ''); ?>">
          						<select id="category" name="category" class="form-control select2_demo_1" data-placeholder="Select Category">
          						</select>
          		<?php echo $errors->first('category', '<p class="help-block">:message</p>'); ?>

          	</div>
					</div>
            <div class="form-group">
							<?php echo Form::label('code', 'Abbreviaton*', ['class' => 'col-sm-2 control-label']); ?>

              <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('code') ? 'has-error' : ''); ?>">
              	<?php echo Form::text('code', null, ['class' => 'form-control','placeholder'=>'Abbreviaton Code.']); ?>

                <?php echo $errors->first('code', '<p class="help-block">:message</p>'); ?>

              </div>

            <?php echo Form::label('asset_category', 'Asset Category*', ['class' => 'col-sm-2 control-label']); ?>

          	<div class="col-sm-4 col-xs-12 <?php echo e($errors->has('asset_category') ? 'has-error' : ''); ?>">
          						<select id="assetcategory" name="asset_category" class="form-control select2_demo_1" data-placeholder="Select Asset Category">
          							<option value="">Select Asset Category</option>
          						</select>
          		<?php echo $errors->first('asset_category', '<p class="help-block">:message</p>'); ?>

          	</div>
          </div>

            <div class="form-group <?php echo e($errors->has('desc') ? 'has-error' : ''); ?>">
              <?php echo Form::label('status', 'Status: ', ['class' => 'col-sm-2 control-label']); ?>

          		<div class="col-sm-4">
          			<?php echo e(Form::select('status', $activations, null, ['class' => 'form-control'])); ?>

          				<?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

                </div>

                <?php echo Form::label('license', 'License: ', ['class' => 'col-sm-2 control-label']); ?>

            		<div class="col-sm-4">
                  <?php echo e(Form::select('license', ['1' => 'Yes','2' => 'No'], null, ['class' => 'form-control','placeholder'=>'Select License'])); ?>

                <?php echo $errors->first('license', '<p class="help-block">:message</p>'); ?>

                </div>

            </div>
            <div class="form-group <?php echo e($errors->has('power') ? 'has-error' : ''); ?>">
              <?php echo Form::label('power', 'Power: ', ['class' => 'col-sm-2 control-label']); ?>

              <div class="col-sm-4 col-xs-12">
              	<?php echo Form::text('power', null, ['class' => 'form-control','placeholder'=>'Power Consumption (Watt)']); ?>

                <?php echo $errors->first('power', '<p class="help-block">:message</p>'); ?>

              </div>

                <?php echo Form::label('mpls_hierarchy', 'MPLS Hierarchy: ', ['class' => 'col-sm-2 control-label']); ?>

                <div class="col-sm-4 col-xs-12">
                	<?php echo Form::text('mpls_hierarchy', null, ['class' => 'form-control','placeholder'=>'Only for IP based Asset']); ?>

                  <?php echo $errors->first('mpls_hierarchy', '<p class="help-block">:message</p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('rack_unit', 'Rack Unit: ', ['class' => 'col-sm-2 control-label']); ?>

                <div class="col-sm-1 col-xs-12">
                	<?php echo Form::text('rack_unit', null, ['class' => 'form-control','placeholder'=>'RU']); ?>

                  <?php echo $errors->first('rack_unit', '<p class="help-block">:message</p>'); ?>

                </div>
								<?php echo Form::label('material', 'Material Code: ', ['class' => 'col-sm-5 control-label']); ?>

	              <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('material') ? 'has-error' : ''); ?>">
	              	<?php echo Form::text('material', null, ['class' => 'form-control','placeholder'=>'Material Code']); ?>

	                <?php echo $errors->first('material', '<p class="help-block">:message</p>'); ?>

	              </div>
              </div>
              <div class="form-group <?php echo e($errors->has('dimension') ? 'has-error' : ''); ?>">
                <?php echo Form::label('dimension', 'Dimension(mm): ', ['class' => 'col-sm-2 control-label']); ?>

                <div class="col-sm-1 col-xs-12">
                	<?php echo Form::text('height', null, ['class' => 'form-control','placeholder'=>'H']); ?>

                  <?php echo $errors->first('height', '<p class="help-block">:message</p>'); ?>

                </div>
                <div class="col-sm-1 col-xs-12">
                	<?php echo Form::text('length', null, ['class' => 'form-control','placeholder'=>'L']); ?>

                  <?php echo $errors->first('length', '<p class="help-block">:message</p>'); ?>

                </div>
                <div class="col-sm-1 col-xs-12">
                	<?php echo Form::text('width', null, ['class' => 'form-control','placeholder'=>'W']); ?>

                  <?php echo $errors->first('width', '<p class="help-block">:message</p>'); ?>

                </div>
								<?php echo Form::label('investation', 'Assets Value: ', ['class' => 'col-sm-3 control-label']); ?>

	              <div class="col-sm-4 col-xs-12">
	              	<?php echo Form::text('investation', null, ['class' => 'form-control','placeholder'=>'Assets Value']); ?>

	                <?php echo $errors->first('investation', '<p class="help-block">Assets Value is required</p>'); ?>

	              </div>
              </div>
            <div class="form-group <?php echo e($errors->has('desc') ? 'has-error' : ''); ?>">
            <?php echo Form::label('desc', 'Desc: ', ['class' => 'col-sm-2 control-label']); ?>

            <div class="col-sm-4 col-xs-12">
              <textarea name="desc" type="text" class="form-control" placeholder="Description of brand. [ Maks. 500 char ]" style="height: auto"></textarea>
              <?php echo $errors->first('desc', '<p class="help-block">:message</p>'); ?>

            </div>
          </div>
          <?php $i = 0?>
          <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php $i++ ?>
          <div class="form-group">
          <?php echo Form::label('temp', 'Has '. $template->name .': ', ['class' => 'col-sm-2 control-label']); ?>

          <div class="col-sm-4">
            <?php echo e(Form::select('temp', [''.$template->id .'' => 'Yes','0' => 'No'], null, ['class' => 'form-control temp','placeholder'=>'Select Option','id'=>'temp'.$i.''])); ?>

          <?php echo $errors->first('temp', '<p class="help-block">:message</p>'); ?>

          </div>
          </div>
        <div class="form-group childstemp" id="childstemp<?php echo e($i); ?>">
        </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<div class="hr-line-dashed"></div>
				<div class="form-group">
						<div class="col-sm-4">
								<div class="image-crop">
									<img id="imagePreview" style="max-height:200px">
                </div>
								<h4>Image of Model</h4>
								<p>
										You can upload new image of model.
								</p>
								<div class="btn-group">
										<label title="Upload image file" for="inputImage" class="btn btn-primary">
												<input type="file" accept="image/*" name="file" id="inputImage" class="hide">
												Upload new image
										</label>
								</div>
						</div>
					</div>
        	<div class="form-group">
							<a href="<?php echo e(url()->previous()); ?>" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
	      				<button type="submit" class="create_mdl btn btn-outline btn-primary pull-right" style="margin-right: 20px; ">
	                <i class="fa fa-plus-circle"></i> Create
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
<?php $__env->startSection('script'); ?>
<?php echo e(HTML::script('assets_back/js/plugins/iCheck/icheck.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/select2/select2.full.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/cropper/cropper.min.js')); ?>

<script>
var csrf = $('meta[name="csrf-token"]').attr('content');


 jQuery(document).ready(function() {

// fungsi pilih type
$('#type').on('change', function(e){
		 console.log(e);
		 var type_id = e.target.value;


		 //ajax

		 $.get('/category?type_id=' + type_id, function(data){  // Ganti bagian ini......

			 $('#category').empty();
			  $('#category').append('<option value="0">Select Category</option>');
			 $.each(data, function(index, subcatObj){
				 $('#category').append('<option value="'+subcatObj.id+'">'+subcatObj.name+'</option>');
			 });
		 });
	 });

	 // fungsi pilih asset category
	 $('#category').on('change', function(e){
	 		 console.log(e);
	 		 var category_id = e.target.value;
	 		 //ajax
	 		 $.get('/assetcategory?category_id=' + category_id, function(data){  // Ganti bagian ini......

	 		 $.get('/assetcategory?category_id=' + category_id, function(data){  // Ganti bagian ini......

	 			 $('#assetcategory').empty();
	 			  $('#assetcategory').append('<option value="0">Select Asset Category</option>');
	 			 $.each(data, function(index, subcatObj){
	 				 $('#assetcategory').append('<option value="'+subcatObj.id+'">'+subcatObj.name+'</option>');
	 			 });
	 		 });
	 	 });
	 });


var elements = document.getElementsByClassName("temp");

for(var i=0; i<elements.length; i++) {
var el = elements[i].id;



if (el) {
  $("#"+el).on('change', function(e){
          console.log(e);
          var temp_id = e.target.value;
					var id_option = e.target.id;

          //true
					if(+temp_id != "0"){
          // $.get('/temp?temp_id=' + temp_id, function(data){  // Ganti bagian ini......
          $.get('/temp?temp_id=' + temp_id, function(data){  // Ganti bagian ini......
						var no = 0;
					$.each(data, function(index, subcatObj){
						++no;
						$("#childs"+id_option).append('<div class="col-sm-3 tempstyle"><div class="col-sm-2"><input type="checkbox" class="i-checks content" value="'+subcatObj.id+'" id="checktemp'+subcatObj.id+'" name="checkAttr[]"></div><div class="col-sm-4" style="">'+subcatObj.code+'</div><div class="col-sm-6"><input type="hidden" min="0" value="'+temp_id+'" name="parentAttr[]"><input type="hidden" min="0" value="'+subcatObj.id+'" name="nameAttr[]"><input type="number" min="0" id="inputtemp'+subcatObj.id+'" name="valueAttr[]" class="form-control " placeholder="Total" disabled></div></div>');

							});
							$('.i-checks').iCheck({
									checkboxClass: 'icheckbox_square-green',
							});

							//enable dan disable checkbox
							//$('#inputtemp2').removeAttr("disabled");}
							 $('.iCheck-helper').click(function () {
								var checkbox = $(this).parent();
								var parent = $(this).parent().get(0);
								var checkboxId = parent .getElementsByTagName('input')[0].value;
								//alert(checkboxId);

    				 			if (checkbox.hasClass('checked')) {
											$('#inputtemp'+checkboxId).prop("disabled", false);
									}else{
												$('#inputtemp'+checkboxId).prop( "disabled", true );
									}
								 });
							 });
						 }
				//false
				else if(+temp_id == "0"){
						$("#childs"+id_option).empty();
				}
      });
				//end onchange function
			}
}//endfor

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