<?php $__env->startSection('style'); ?>
  <style>
    .ibox { margin: 1px 2px 0px 0px !important }
    .ibox.float-e-margins{ margin: 0px 2px !important}
  </style>
  <?php echo e(HTML::style('assets_back/css/plugins/select2/select2.min.css')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
  Edit <?php if($brand->depth == 0): ?> Brand <?php else: ?> Model <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <div class="wrapper wrapper-content">
    <div class="row detail_content3">
      <div class="col-lg-12 detail_content2" style="background-color: white">
        <div class="row ibox-title">
          <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
            <li class="">
              <a href="<?php echo e(url('brand/'. $brand->id .'/show')); ?>">
                <?php echo e($brand->name); ?>

              </a>
            </li>
            <li class="">
              <a href="#">
                Edit Attribute
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
            <?php echo Form::open(['url' => 'update_attr', 'class' => 'form-horizontal', 'files' => true]); ?>


            <?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

            <?php echo Form::hidden('id', $nodes->id , ['class' => 'form-control']); ?>

            <?php echo Form::hidden('brand_id', $brand->id , ['class' => 'form-control']); ?>

            <?php echo Form::hidden('brand_name', $brand->name , ['class' => 'form-control']); ?>


              <div class="form-group <?php echo e($errors->has('code') ? 'has-error' : ''); ?>">
              <?php echo Form::label('category', 'Template Name: ', ['class' => 'col-sm-2 control-label']); ?>

							<div class="col-sm-4 col-xs-12">
								<?php echo Form::text('category', $nodes->nameAttr->name , ['class' => 'form-control readonly','placeholder'=>'Model Name.']); ?>

								<?php echo $errors->first('category', '<p class="help-block">:message</p>'); ?>

							</div>

            <?php echo Form::label('name', 'Attribute Name: ', ['class' => 'col-sm-2 control-label']); ?>

          	<div class="col-sm-4 col-xs-12">

              <?php echo Form::text('name',  $nodes->catAttr->name, ['class' => 'form-control readonly','placeholder'=>'Model Name.']); ?>

              <?php echo $errors->first('name', '<p class="help-block">:message</p>'); ?>

          	</div>
          </div>
          <div class="form-group <?php echo e($errors->has('code') ? 'has-error' : ''); ?>">

            <?php echo Form::label('value', 'Value: ', ['class' => 'col-sm-2 control-label']); ?>

            <div class="col-sm-4 col-xs-12">
              <?php echo Form::number('value', $nodes->value, ['class' => 'form-control','placeholder'=>'Attr Value','min'=>$asset_v->jml]); ?>

              <p class="help-block"><font color="orange">Info! Value must be greater than or equal to <?php echo e($asset_v->jml); ?> </font></p>
            </div>
          </div>
            <div class="form-group">
              <a href="<?php echo e(url('brand')); ?>" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
              <button type="submit" class="create_mdl btn btn-outline btn-primary pull-right" style="margin-right: 20px; ">
                <i class="fa fa-save"></i>  Update
              </button>
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
   $(".select2_demo_1").select2();




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