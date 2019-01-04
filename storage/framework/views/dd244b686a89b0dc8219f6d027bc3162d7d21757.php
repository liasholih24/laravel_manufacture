<?php $__env->startSection('title'); ?>
	Model
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
	Add Attribute
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
              	<?php echo e($brand->name); ?>

							</a>
        		</li>
						<li class="">
              <a href="#">
              	Create Attribute
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
						<?php echo Form::open(['url' => 'store_attr', 'class' => 'form-horizontal', 'files' => true]); ?>

            <?php echo Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

          	<?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

						<?php echo Form::hidden('brand_id', $brand->id, ['class' => 'form-control']); ?>

						<?php echo Form::hidden('brand_name', $brand->name, ['class' => 'form-control']); ?>


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

<script>
var csrf = $('meta[name="csrf-token"]').attr('content');


 jQuery(document).ready(function() {

// fungsi pilih attr
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
          $.get('/temp2?temp_id='+temp_id+'&brand_id=<?php echo e($brand->id); ?>', function(data){  // Ganti bagian ini......
						var no = 0;
					$.each(data, function(index, subcatObj){
						++no;
						$("#childs"+id_option).append('<div class="col-sm-3 tempstyle"><div class="col-sm-2"><input type="checkbox" class="i-checks content" value="'+subcatObj.id+'" id="checktemp'+subcatObj.id+'" name="checkAttr[]"></div><div class="col-sm-4" style="">'+subcatObj.code+'</div><div class="col-sm-6"><input type="hidden" min="0" value="'+temp_id+'" id="" name="parentAttr[]" id="parenttemp'+subcatObj.id+'"><input type="hidden" min="0" value="'+subcatObj.id+'" name="nameAttr[]"><input type="number" min="0" id="inputtemp'+subcatObj.id+'" name="valueAttr[]" class="form-control " placeholder="Total" disabled></div></div>');

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
											$('#parenttemp'+checkboxId).prop("disabled", false);
									}else{
												$('#inputtemp'+checkboxId).prop( "disabled", true );
												$('#parenttemp'+checkboxId).prop( "disabled", true );
									}
								 });
					});
					}
				//false
				if(+temp_id == "0"){
						$("#childs"+id_option).empty();
					}
        });//end onchange function




}
}//endfor



	});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>