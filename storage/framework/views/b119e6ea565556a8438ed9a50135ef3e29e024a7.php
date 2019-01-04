<?php $__env->startSection('style'); ?>
  <style>
    .ibox { margin: 1px 2px 0px 0px !important }
    .ibox.float-e-margins{ margin: 0px 2px !important}
  </style>
  <?php echo e(HTML::style('assets_back/css/plugins/iCheck/custom.css')); ?>

  <?php echo e(HTML::style('assets_back/css/plugins/select2/select2.min.css')); ?>

  <?php echo e(HTML::style('assets_back/css/plugins/datapicker/datepicker3.css')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
	Create new Asset
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<div class="wrapper wrapper-content">
		<div class="row detail_content3">
			<div class="col-lg-12 detail_content2" style="background-color: white">
				<div class="row ibox-title">
					<ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
						<li class="">
            	<a href="<?php echo e(url('asset')); ?>">
            		Asset
            	</a>
        		</li>
        		<li class="">
              <a href="#">
              	Add New
							</a>
        		</li>
    			</ol>
          <a href="<?php echo e(url('asset')); ?>">
            <button class="btn btn-sm btn-outline btn-warning pull-right">
            	<i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
          </a>
    		</div>
				<div class="row ibox-content" style="min-height: 65vh; ">
					<div class="col-xs-12 col-sm-22">
						<?php echo Form::open(['url' => 'asset', 'class' => 'form-horizontal']); ?>

            <?php echo Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

          	<?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

            <?php echo Form::hidden('inputan', "newasset", ['class' => 'form-control']); ?>

            <div class="form-group">
              <?php echo Form::label('sbu_id', 'SBU*', ['class' => 'col-sm-2 control-label']); ?>

              <div class="col-sm-4 <?php echo e($errors->has('sbu_id') ? 'has-error' : ''); ?>">
          		<?php echo e(Form::select('sbu_id', $sbus, null, ['class' => 'form-control select2_demo_1','id' => 'sbu','placeholder'=>'Select SBU'])); ?>

          		<?php echo $errors->first('sbu_id', '<p class="help-block">:message</p>'); ?>

              </div>
              <?php echo Form::label('type_id', 'Type*', ['class' => 'col-sm-2 control-label']); ?>

              <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('type_id') ? 'has-error' : ''); ?>">
                <?php echo e(Form::select('type_id', $categories, null, ['class' => 'form-control select2_demo_1','id' => 'type'])); ?>

                <?php echo $errors->first('type_id', '<p class="help-block">:message</p>'); ?>

              </div>

            </div>
            <div class="form-group">
              <?php echo Form::label('pop', 'Site*', ['class' => 'col-sm-2 control-label']); ?>

              <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('pop_id') ? 'has-error' : ''); ?>">
                <select name="pop_id" id="pop" class="form-control select2_demo_1" data-placeholder="Select POP">
                </select>
                <?php echo $errors->first('pop_id', '<p class="help-block">:message</p>'); ?>

              </div>
              <?php echo Form::label('category_id', 'Category*', ['class' => 'col-sm-2 control-label']); ?>

              <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('category_id') ? 'has-error' : ''); ?>">
                <select id="category" name="category_id" class="form-control select2_demo_1" data-placeholder="Select Category">
                </select>
                <?php echo $errors->first('category_id', '<p class="help-block">:message</p>'); ?>

            </div>
            </div>
            <div class="form-group">
              <?php echo Form::label('building_id', 'Building*', ['class' => 'col-sm-2 control-label']); ?>

              <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('building_id') ? 'has-error' : ''); ?>">
                <select name="building_id" id="building" class="form-control select2_demo_1" data-placeholder="Select Building">
                </select>
                <?php echo $errors->first('building_id', '<p class="help-block">:message</p>'); ?>

              </div>
              <?php echo Form::label('asset_category', 'Asset Category*', ['class' => 'col-sm-2 control-label']); ?>

              <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('asset_category') ? 'has-error' : ''); ?>">
                <select id="asset_category" name="asset_category" class="form-control select2_demo_1" data-placeholder="Select Category">
                </select>
                <?php echo $errors->first('asset_category', '<p class="help-block">:message</p>'); ?>

              </div>
            </div>
            <div class="form-group">

              <?php echo Form::label('room_id', 'Room', ['class' => 'col-sm-2 control-label']); ?>

              <div class="col-sm-4 col-xs-12">
                <select name="room_id" id="room" class="form-control select2_demo_1" data-placeholder="Select Room">
                </select>
                <?php echo $errors->first('room_id', '<p class="help-block">:message</p>'); ?>

              </div>
              <?php echo Form::label('brand_id', 'Brand*', ['class' => 'col-sm-2 control-label']); ?>

              <div class="col-sm-4 <?php echo e($errors->has('brand_id') ? 'has-error' : ''); ?>">
                <select id="brand" name="brand_id" class="form-control select2_demo_1" data-placeholder="Select Brand">
                  <option value="0">Select Brand</option>
                  <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($brand->id); ?>"><?php echo e($brand->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

              <?php echo $errors->first('brand_id', '<p class="help-block">:message</p>'); ?>

              </div>
            </div>
            <div class="form-group">
              <?php echo Form::label('assign_rack', 'Assign Rack', ['class' => 'col-sm-2 control-label']); ?>

              <div class="col-sm-4 <?php echo e($errors->has('qr_label') ? 'has-error' : ''); ?>">
                <?php echo e(Form::select('assign_rack', ['1' => 'Yes','0' => 'No'], null, ['class' => 'form-control AssignRack','placeholder'=>'Assign Rack'])); ?>

              <?php echo $errors->first('assign_rack', '<p class="help-block">:message</p>'); ?>

              </div>
              <?php echo Form::label('model_id', 'Model*', ['class' => 'col-sm-2 control-label']); ?>

              <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('model_id') ? 'has-error' : ''); ?>">
                <select id="model" name="model_id" class="form-control select2_demo_1" data-placeholder="Select Model">
                </select>
                <?php echo $errors->first('model_id', '<p class="help-block">:message</p>'); ?>

              </div>
            </div>
              <div class="form-group">
                <!--<div class="col-sm-6 CloseRack">
                </div>-->
                <div class="SelectRack">
                <?php echo Form::label('rack', 'Rack', ['class' => 'col-sm-2 control-label']); ?>

                <div class="col-sm-4">
                  <select  name="rack" id="rack" class="form-control " data-placeholder="Select Rack">
                  </select><?php echo $errors->first('rack', '<p class="help-block">:message</p>'); ?>

                </div>
              </div>
                <?php echo Form::label('material', 'Material*', ['class' => 'col-sm-2 control-label']); ?>

                <div class="col-sm-4 <?php echo e($errors->has('material') ? 'has-error' : ''); ?>">
                  <select id="material" name="material_no" class="form-control select2_demo_1" data-placeholder="Select Material">
                    <option value="0">Select Material</option>
                    <?php $__currentLoopData = $materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($material->material); ?>"><?php echo e($material->material); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>  <?php echo $errors->first('material', '<p class="help-block">:message</p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <button id="showModel" type="button" class="btn btn-sm btn-outline btn-primary pull-right showModel">Show Model</button>
              </div>
              <div id="data-model">
              </div>
              <div class="form-group" id="dataModel">

                <div class="col-lg-12">
                    <div class="ibox product-detail">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-md-5" id="mdl_image">

                                </div>
                                <div class="col-md-7">
                                    <h2 class="font-bold m-b-xs" id ="mdl_name"></h2>
                                    <small>Last Updated - <i class="fa fa-clock-o"></i> <span id="mdl_updated"> </span></small>
                                    <div class="m-t-md">
                                        <h3 class="product-main-price" id="mdl_investation">Rp. </h3>
                                    </div>
                                    <hr>
                                    <div class="col-sm-12 col-xs-12 row">
                                      <div class="col-sm-6 col-xs-12">
                                        <p class="col-sm-5 col-xs-3 row">Material No</p>
                                        <p class="col-sm-7 col-xs-9 row" id="mdl_material">: </p>
                                      </div>
                                      <div class="col-sm-6 col-xs-12">
                                        <p class="col-sm-4 col-xs-3 row">Brand</p>
                                        <p class="col-sm-8 col-xs-9 row" id="mdl_brand">: </p>
                                      </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12 row">
                                      <div class="col-sm-6 col-xs-12">
                                        <p class="col-sm-5 col-xs-3 row">Has Source</p>
                                        <p class="col-sm-7 col-xs-9 row" id="mdl_source">: </p>
                                      </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12 row">
                                      <div class="col-sm-6 col-xs-12">
                                        <p class="col-sm-5 col-xs-3 row">Has Port</p>
                                        <p class="col-sm-7 col-xs-9 row" id="mdl_port">: </p>
                                      </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12 row">
                                      <div class="col-sm-6 col-xs-12">
                                        <p class="col-sm-5 col-xs-3 row">Has Slot</p>
                                        <p class="col-sm-7 col-xs-9 row" id="mdl_slot">: </p>
                                      </div>
                                    </div>
                                    <h4>Model description</h4>
                                    <div class="small text-muted" id="mdl_desc">
                                    </div>
                                    <hr>
                                    <div class="text-right">
                                        <div class="btn-group">
                                          <a id="closeModel" class="detail2 btn btn-md btn-outline btn-warning">  <i class="fa fa-times-circle" ></i> Close</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                </div>
              <div class="form-group">
                  <?php echo Form::label('qr_label', 'QR label', ['class' => 'col-sm-2 control-label']); ?>

              		<div class="col-sm-4 <?php echo e($errors->has('qr_label') ? 'has-error' : ''); ?>">
                    <?php echo e(Form::select('qr_label', ['1' => 'Yes','2' => 'No'], null, ['class' => 'form-control','placeholder'=>'Select QR Label'])); ?>

                  <?php echo $errors->first('qr_label', '<p class="help-block">:message</p>'); ?>

                  </div>


                    <?php echo Form::label('investasi', 'Assets Values', ['class' => 'col-sm-2 control-label']); ?>

                    <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('investasi') ? 'has-error' : ''); ?>">
                    	<?php echo Form::text('investasi', null, ['class' => 'form-control','placeholder'=>'Assets Value']); ?>

                      <?php echo $errors->first('investasi', '<p class="help-block">Assets Value is required</p>'); ?>

                    </div>

              </div>
              <div class="form-group">
                <?php echo Form::label('status', 'Status*', ['class' => 'col-sm-2 control-label']); ?>

                <div class="col-sm-4 <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">
                  <?php echo e(Form::select('status', $activations, null, ['class' => 'form-control'])); ?>

                    <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

                </div>
                <?php echo Form::label('condition', 'Condition*', ['class' => 'col-sm-2 control-label']); ?>

                <div class="col-sm-4 <?php echo e($errors->has('condition') ? 'has-error' : ''); ?>">
                  <?php echo e(Form::select('condition', $conditions, null, ['class' => 'form-control'])); ?>

                  <?php echo $errors->first('condition', '<p class="help-block">:message</p>'); ?>

                </div>
                </div>
                <div class="form-group <?php echo e($errors->has('investasi') ? 'has-error' : ''); ?>">
                  <?php echo Form::label('acc_no', 'Accounting Number', ['class' => 'col-sm-2 control-label']); ?>

                  <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('investasi') ? 'has-error' : ''); ?>">
                    <?php echo Form::text('acc_no', null, ['class' => 'form-control','placeholder'=>'Accounting Number.']); ?>

                    <?php echo $errors->first('acc_no', '<p class="help-block">:message</p>'); ?>

                  </div>

                    <?php echo Form::label('asset_no', 'Asset Number', ['class' => 'col-sm-2 control-label']); ?>

                    <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('asset_no') ? 'has-error' : ''); ?>">
                      <?php echo Form::text('asset_no', null, ['class' => 'form-control','placeholder'=>'Asset Number.']); ?>

                      <?php echo $errors->first('asset_no', '<p class="help-block">:message</p>'); ?>

                    </div>
                  </div>
                  <div class="form-group">
                    <?php echo Form::label('serial_no', 'Serial Number', ['class' => 'col-sm-2 control-label']); ?>

                    <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('serial_no') ? 'has-error' : ''); ?>">
                      <?php echo Form::text('serial_no', null, ['class' => 'form-control','placeholder'=>'Serial Number.']); ?>

                      <?php echo $errors->first('serial_no', '<p class="help-block">:message</p>'); ?>

                    </div>
                    <?php echo Form::label('io_no', 'IO Number', ['class' => 'col-sm-2 control-label']); ?>

                    <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('io_no') ? 'has-error' : ''); ?>">
                      <?php echo Form::text('io_no', null, ['class' => 'form-control','placeholder'=>'IO Number.']); ?>

                      <?php echo $errors->first('io_no', '<p class="help-block">:message</p>'); ?>

                    </div>

                    </div>
                    <div class="form-group">
          						<?php echo Form::label('desc', 'Desc', ['class' => 'col-sm-2 control-label']); ?>

          						<div class="col-sm-4 col-xs-12 <?php echo e($errors->has('desc') ? 'has-error' : ''); ?>">
          									<textarea name="desc" type="text" class="form-control" placeholder="Description of Asset. [ Maks. 500 char ]" style="height: auto"></textarea>
          								<?php echo $errors->first('desc', '<p class="help-block">:message</p>'); ?>

          						</div>
                      <?php echo Form::label('installation_year', 'Installation Year', ['class' => 'col-sm-2 control-label']); ?>

                      <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('serial_no') ? 'has-error' : ''); ?>">
                        <?php echo Form::text('installation_year', null, ['id' => 'installation_year','class' => 'form-control','data-date-format'=>'yyyy-mm-dd','placeholder' => 'Installation Year.']); ?>

                  			<?php echo $errors->first('installation_year', '<p class="help-block">:message</p>'); ?>

                      </div>
          					</div>

          								<div class="hr-line-dashed"></div>
            <div class="form-group">
							<a href="<?php echo e(url('asset')); ?>" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
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
<?php $__env->startSection('script'); ?>
<?php echo e(HTML::script('assets_back/js/plugins/iCheck/icheck.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/select2/select2.full.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/datapicker/bootstrap-datepicker.js')); ?>


<script>
var csrf = $('meta[name="csrf-token"]').attr('content');
 jQuery(document).ready(function() {
// fungsi pilih sbu
$('#sbu').on('change', function(e){
		 console.log(e);
		 var sbu_id = e.target.value;

		 $.get('/pop?sbu_id=' + sbu_id, function(data){  // Ganti bagian ini......

			 $('#pop').empty();
			  $('#pop').append('<option value="0">Select POP</option>');
			 $.each(data, function(index, subcatObj){
				 $('#pop').append('<option value="'+subcatObj.id+'">'+subcatObj.name+'</option>');
			 });
		 });
	 });

	 // fungsi pilih model/building
	 $('#pop').on('change', function(e){
	 		 console.log(e);
	 		 var pop_id = e.target.value;
	 		 //ajax
	 		 $.get('/building?pop_id=' + pop_id, function(data){  // Ganti bagian ini......

	 			 $('#building').empty();
	 			  $('#building').append('<option value="0">Select Building</option>');
	 			 $.each(data, function(index, subcatObj){
	 				 $('#building').append('<option value="'+subcatObj.id+'">'+subcatObj.name+'</option>');
	 			 });
	 		 });

	 	 });
     //pilih fingsi room
     // fungsi pilih model/building
  	 $('#building').on('change', function(e){
  	 		 console.log(e);
  	 		 var building_id = e.target.value;
  	 		 //ajax
  	 		 $.get('/room?building_id=' + building_id, function(data){  // Ganti bagian ini......

  	 			 $('#room').empty();
  	 			  $('#room').append('<option value="0">Select Room</option>');
  	 			 $.each(data, function(index, subcatObj){
  	 				 $('#room').append('<option value="'+subcatObj.id+'">'+subcatObj.name+'</option>');
  	 			 });
  	 		 });
  	 	 });
       //pilih type
       $('#type').on('change', function(e){
       		 console.log(e);
       		 var type_id = e.target.value;

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

            $.get('/assetcategory?category_id=' + category_id, function(data){  // Ganti bagian ini......

              $('#asset_category').empty();
               $('#asset_category').append('<option value="0">Select Asset Category</option>');
              $.each(data, function(index, subcatObj){
                $('#asset_category').append('<option value="'+subcatObj.id+'">'+subcatObj.name+'</option>');
              });
            });
          });

         //funsgi pilih brand/model
         $('#brand').on('change', function(e){
            console.log(e);
            var brand_id = e.target.value;
            //ajax
            $.get('/brandmodel?brand_id=' + brand_id, function(data){  // Ganti bagian ini......

              $('#model').empty();
               $('#model').append('<option value="0">Select Model</option>');
              $.each(data, function(index, subcatObj){
                $('#model').append('<option value="'+subcatObj.id+'">'+subcatObj.name+'</option>');
              });
            });
            //reset material where pilih Select Brand
            $.get('/materialbybrand?brand_id=' + brand_id, function(data){  // Ganti bagian ini......

              $('#material').empty();
               $('#material').append('<option value="0">Select Material</option>');
              $.each(data, function(index, subcatObj){
                $('#material').append('<option value="'+subcatObj.id+'">'+subcatObj.name+'</option>');
              });
            });

          });
          $('#model').on('change', function(e){
            $('#dataModel').slideUp('slow');
            $('#mdl_name').empty();
            $('#mdl_brand').empty();
            $('#mdl_updated').empty();
            $('#mdl_material').empty();
            $('#mdl_investation').empty();
            $('#mdl_source').empty();
            $('#mdl_slot').empty();
            $('#mdl_port').empty();
            $('#mdl_desc').empty();

            $('#mdl_image').empty();
             console.log(e);
             var model_id = e.target.value;

             $.get('/model?model_id=' + model_id, function(data){  // Ganti bagian ini......

               $('#data-model').empty();

               $('#investasi').val('');
              // $('#model-data').empty();
            //   $('#modelname').append('<input type="text" value="0">');
               $.each(data, function(index, subcatObj){
               $('#data-model').append('<input type="hidden" name="code" value="'+subcatObj.code+'"><input type="hidden" name="name" value="'+subcatObj.name+'">');
            //  $('#data-model').append('<a class="remove btn btn-outline btn-sm btn-danger pull-right" style="margin-left: 20px; margin-top: 20px"><i class="fa fa-eye-slash"></i>  Hide Data</a>');
              $('#investasi').val($('#investasi').val() + subcatObj.investation);
              });
             });

             //categorybybrand
             $.get('/categorybybrand?model_id=' + model_id, function(data){  // Ganti bagian ini......
               $('#category').empty();
               $('#category').append('<option value="0">Select Category</option>');
               $.each(data, function(index, subcatObj){
                 $("#category").select2('destroy').empty().select2({data: [{id: subcatObj.id, text: subcatObj.name }]});

               });
             });
             //assetcategorybybrand
             $.get('/astcategorybybrand?model_id=' + model_id, function(data){  // Ganti bagian ini......

               $('#asset_category').empty();
                 $('#asset_category').append('<option value="0">Select Asset Category</option>');
               $.each(data, function(index, subcatObj){
                  $("#asset_category").select2('destroy').empty().select2({data: [{id: subcatObj.id, text: subcatObj.name }]});
               });
             });
             //material
             $.get('/materialbybrand?model_id=' + model_id, function(data){  // Ganti bagian ini......

            //   $('#material').empty();
              //   $('#material').append('<option value="0">Select Material</option>');
               $.each(data, function(index, subcatObj){
                  $("#material").select2('destroy').empty().select2({data: [{id: subcatObj.id, text: subcatObj.name }]});
               });
             });
             //show model
             $('#showModel').slideDown('slow');
           });
           //filter by material
           $('#material').on('change', function(e){

             $('#dataModel').slideUp('slow');
             $('#mdl_name').empty();
             $('#mdl_brand').empty();
             $('#mdl_updated').empty();
             $('#mdl_material').empty();
             $('#mdl_investation').empty();
             $('#mdl_source').empty();
             $('#mdl_slot').empty();
             $('#mdl_port').empty();
             $('#mdl_desc').empty();

             $('#mdl_image').empty();

              console.log(e);
              var material = e.target.value;
              //categorybybrand
              $.get('/categorybymaterial?material=' + material, function(data){  // Ganti bagian ini......

                $('#category').empty();
                $('#category').append('<option value="0">Select Category</option>');
                $.each(data, function(index, subcatObj){
                  $("#category").select2('destroy').empty().select2({data: [{id: subcatObj.id, text: subcatObj.name }]});
                });
              });
              //assetcategorybybrand
              $.get('/astcategorybymaterial?material=' + material, function(data){  // Ganti bagian ini......

                $('#asset_category').empty();
                $('#asset_category').append('<option value="0">Select Asset Category</option>');
                $.each(data, function(index, subcatObj){
                  $("#asset_category").select2('destroy').empty().select2({data: [{id: subcatObj.id, text: subcatObj.name }]});

                });
              });
              //brandbymaterial
              $.get('/brandbymaterial?material=' + material, function(data){  // Ganti bagian ini......

                $('#brand').empty();
                $('#brand').append('<option value="0">Select Brand</option>');
                $.each(data, function(index, subcatObj){
                  $("#brand").select2('destroy').empty().select2({data: [{id: subcatObj.id, text: subcatObj.name }]});
                $('#brand').append('<option value="0">Select Brand</option>');
                });

              });
              //modelbymaterial
              $.get('/modelbymaterial?material=' + material, function(data){  // Ganti bagian ini......

                $('#data-model').empty();
                $('#model').empty();
                $('#investasi').val('');
                $('#model').append('<option value="0">Select Model</option>');
                $.each(data, function(index, subcatObj){
                  $("#model").select2('destroy').empty().select2({data: [{id: subcatObj.id, text: subcatObj.name }]});
                  $('#data-model').append('<input type="hidden" name="code" value="'+subcatObj.code+'"><input type="hidden" name="name" value="'+subcatObj.name+'">');
               //  $('#data-model').append('<a class="remove btn btn-outline btn-sm btn-danger pull-right" style="margin-left: 20px; margin-top: 20px"><i class="fa fa-eye-slash"></i>  Hide Data</a>');
                  $('#investasi').val($('#investasi').val() + subcatObj.investation);

                });
              });
              //show model
              $('#showModel').slideDown('slow');
            });
          //i-checks
				$('.i-checks').iCheck({
						checkboxClass: 'icheckbox_square-green',
						radioClass: 'iradio_square-green',
				});

        $("#installation_year").datepicker({
          endDate: '-0m',
          format :  'yyyy-mm-dd',
          keyboardNavigation : false,
          forceParce: false,
          todayBtn: 'linked',
          todayHighlight :  true,
          daysOfWeekDisabled : [0],
        });

		$(".select2_demo_1").select2();

    $('.AssignRack').on('change', function(e){
    var pop_id =  $('#pop').find(':selected').val(),
       val = $(this).find(':selected').val();
    if(val == 1)
      {
        $('.SelectRack').slideDown('slow');
        $('.CloseRack').hide();

        $.get('/rack?pop_id=' + pop_id, function(data){
          $('#rack').empty();
           $('#rack').append('<option value="0">Select Rack</option>');
          $.each(data, function(index, subcatObj){
            $('#rack').append('<option value="'+subcatObj.id+'">'+subcatObj.name+'</option>');
          });
        });

      }
   if(val == 0)
      {
        $('.SelectRack').slideUp('slow');
        $('.CloseRack').show();
      }

    });
    $('#closeModel').on('click', function(e){
        $('#showModel').show();
        $('#dataModel').slideUp('slow');
        $('#mdl_name').empty();
        $('#mdl_brand').empty();
        $('#mdl_updated').empty();
        $('#mdl_material').empty();
        $('#mdl_investation').empty();
        $('#mdl_source').empty();
        $('#mdl_slot').empty();
        $('#mdl_port').empty();
        $('#mdl_desc').empty();

        $('#mdl_image').empty();
    });
    $('#showModel').on('click', function(e){
      $('#showModel').hide();
      console.log(e);
      var value = e.target.value;

      var model =  $('#model').find(':selected').val();
      url     =  window.location.origin+'/datamodel?model_id=' +model;

      $.ajax({
          url : url,
          type: "GET",
          dataType: 'html',
          success: function(data, subcatObj){

            var objData = jQuery.parseJSON(data);

          //  alert(objData.name);

              $('#dataModel').slideDown('slow');
              $('#mdl_name').append(objData.name);
              $('#mdl_brand').append(objData.brand);
              $('#mdl_updated').append(objData.updated_at);
              $('#mdl_material').append(objData.material);
              $('#mdl_investation').append(objData.investation);
              $('#mdl_source').append(objData.source);
              $('#mdl_slot').append(objData.slot);
              $('#mdl_port').append(objData.port);
              $('#mdl_desc').append(objData.desc);

              if(objData.url_image == null){
                  $('#mdl_image').append("<img src=/images/noimage.jpg width=430px>");
              }else{

                  $('#mdl_image').append('<img src="/'+objData.url_image+'" width="430px">');
              }





              return false;
              }
          });




      });
		});

$('#showModel').hide();
$('#dataModel').hide();
$('.SelectRack').hide();

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>