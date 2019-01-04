<?php $__env->startSection('title'); ?>
Asset
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Edit Asset
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php echo e(HTML::style('assets_back/css/plugins/datapicker/datepicker3.css')); ?>

<?php echo e(HTML::style('assets_back/css/plugins/chosen/chosen.css')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="wrapper wrapper-content">
    <div class="row detail_content3">
    <div class="col-lg-12 detail_content2" style="background-color: white">
  <style>
                        .ibox { margin: 1px 2px 0px 0px !important }
                        .ibox.float-e-margins{ margin: 0px 2px !important}
                        </style>
<div class="row ibox-title">
  <ol class="breadcrumb col-sm-4 col-xs-12 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
    <li class="">
      <a href="<?php echo e(url('asset/' .$slot->asset_id. '/show')); ?>">
        Slot
      </a>
    </li>
    <li class="">
      <a href="<?php echo e(url('asset/' .$slot->asset_id. '/show')); ?>">
        <?php echo e($slot->attr_name); ?>

      </a>
    </li>
    <li class="active">
      <a href="#">
        Edit
      </a>
    </li>
  </ol>
  <a href="<?php echo e(url('asset/' .$slot->asset_id. '/show')); ?>">
    <button class="btn btn-sm btn-outline btn-warning pull-right">
      <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
    </button>
  </a>
</div>
    <div class="row ibox-content" style="min-height: 65vh; ">
      <div class="col-xs-12 col-sm-22">

    <?php echo Form::open(['url' => 'update/slot', 'class' => 'form-horizontal']); ?>

    <?php echo Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

    <?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

    <?php echo Form::hidden('asset_id', $slot->asset_id, ['class' => 'form-control']); ?>

    <?php echo Form::hidden('id', $slot->id, ['class' => 'form-control']); ?>


    <div class="form-group <?php echo e($errors->has('attr_type') ? 'has-error' : ''); ?>">
      <?php echo Form::label('attr_type', 'Slot Type*', ['class' => 'col-sm-2 control-label']); ?>

      <div class="col-sm-4 col-xs-12 col-xs-12">
        <?php echo e(Form::select('attr_type', $templates, $slot->attr_type, ['class' => 'form-control', 'disabled'])); ?>

        <?php echo $errors->first('attr_type', '<p class="help-block">:message</p>'); ?>

      </div>
    </div>
    <div class="form-group <?php echo e($errors->has('attr_no') ? 'has-error' : ''); ?>">
      <?php echo Form::label('attr_no', 'Slot No*', ['class' => 'col-sm-2 control-label']); ?>

      <div class="col-sm-4 col-xs-12 col-xs-12">
      <?php echo Form::text('attr_no', $slot->attr_no, ['class' => 'form-control','placeholder'=>'Slot Type.','disabled']); ?>

      <?php echo $errors->first('attr_no', '<p class="help-block">:message</p>'); ?>

      </div>
    </div>
    <div class="form-group <?php echo e($errors->has('brand_id') ? 'has-error' : ''); ?>">
      <?php echo Form::label('brand_id', 'Brand*', ['class' => 'col-sm-2 control-label']); ?>


      <div class="col-sm-4 col-xs-12 col-xs-12">
      <select name="brand_id" class="form-control chosen-select BrandSelect chosen-update2 brand_chosen" id="brand_id">
        <option value="<?php echo e($slot->brand_id); ?>"><?php echo e(empty($slot->getbrand->name)? "" : $slot->getbrand->name); ?></option>
        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($brand->id); ?>"><?php echo e($brand->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      <?php echo $errors->first('brand_id', '<p class="help-block">:message</p>'); ?>

      </div>
    </div>
    <div class="form-group <?php echo e($errors->has('model_id') ? 'has-error' : ''); ?>">
      <?php echo Form::label('model_id', 'Model*', ['class' => 'col-sm-2 control-label']); ?>

      <div class="col-sm-4 col-xs-12 col-xs-12">
      <?php echo e(Form::select('model_id', $models, $slot->model_id, ['class' => 'form-control chosen-select ModelSelect chosen-update model_chosen','id'=>'model_id'])); ?>

      <?php echo $errors->first('model_id', '<p class="help-block">:message</p>'); ?>

      </div>
    </div>
    <div class="form-group <?php echo e($errors->has('asset_child') ? 'has-error' : ''); ?>">
      <?php echo Form::label('asset_child', 'Asset*', ['class' => 'col-sm-2 control-label']); ?>

      <div class="col-sm-4 col-xs-12 col-xs-12">
      <?php echo e(Form::select('asset_child', $asset_childs, $slot->asset_child, ['class' => 'form-control chosen-select AssetSelect chosen-update3 asset_chosen','id'=>'asset_id'])); ?>

      <?php echo $errors->first('asset_child', '<p class="help-block">:message</p>'); ?>

      </div>
    </div>
    <div class="form-group <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">
    <?php echo Form::label('status', 'Status*', ['class' => 'col-sm-2 control-label']); ?>

    <div class="col-sm-4 col-xs-12">
      <?php echo e(Form::select('status', $activations, $slot->status, ['class' => 'form-control','disabled'=>'disabled'])); ?>

        <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

      </div>
    </div>
    <div class="form-group <?php echo e($errors->has('attr_name') ? 'has-error' : ''); ?>">
        <?php echo Form::label('attr_name', 'Slot Name*', ['class' => 'col-sm-2 control-label']); ?>

        <div class="col-sm-4 col-xs-12">
          <?php echo Form::text('attr_name', $slot->attr_name, ['class' => 'form-control','placeholder'=>'Slot Name.']); ?>

          <?php echo $errors->first('attr_name', '<p class="help-block">:message</p>'); ?>

        </div>
      </div>
      <div class="form-group <?php echo e($errors->has('desc') ? 'has-error' : ''); ?>">
        <?php echo Form::label('desc', 'Desc', ['class' => 'col-sm-2 control-label']); ?>

        <div class="col-sm-4 col-xs-12 col-xs-12">
              <textarea name="desc" type="text" class="form-control" placeholder="Description of Asset. [ Maks. 500 char ]" style="height: auto"><?php echo e($slot->desc); ?></textarea>
            <?php echo $errors->first('desc', '<p class="help-block">:message</p>'); ?>

        </div>
      </div>
            <div class="hr-line-dashed"></div>
        <div class="form-group">
        <a href="<?php echo e(url('asset')); ?>" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
        <button type="submit" class="create_mdl btn btn-outline btn-primary pull-right" style="margin-right: 20px; ">
        <i class="fa fa-pencil"></i>  Update
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
   $('.BrandSelect').on('change', function(e){

     if ($(this).find(':selected').val() != '') {

        var  val     = $(this).find(':selected').val(),
             item_d  = $(this).find(':selected').data(),
             url     =  window.location.origin+'/modelslot?data=<?php echo e($slot->attr_type); ?>&brand_id='+ val;

             $.ajax({
                 url : url,
                 type: "GET",
                 dataType: 'html',
                 success: function(datas){
                     $('.model_chosen').html(datas);
                     $(".chosen-update").trigger("chosen:updated");
                     return false;
                 }
             });

             //Material SLOT
             var  val     = $(this).find(':selected').val(),
                  item_d  = $(this).find(':selected').data(),
                  url2     =  window.location.origin+'/materialslotbybrand?brand_id=' +val;
               $.ajax({
                   url : url2,
                   type: "GET",
                   dataType: 'html',
                   success: function(datas2){
                       $('.material_chosen').html(datas2);
                       $(".chosen-update2").trigger("chosen:updated");
                       return false;
                   }
               });

   }
   });
   $('.AssetSelect').on('change', function(e){

     if ($(this).find(':selected').val() != '') {
   //Material SLOT
   var  val     = $(this).find(':selected').val(),
        item_d  = $(this).find(':selected').data(),
        url2     =  window.location.origin+'/modelslotbyasset?asset_id=<?php echo e($slot->asset_id); ?>';
     $.ajax({
         url : url2,
         type: "GET",
         dataType: 'html',
         success: function(datas){
             $('.model_chosen').html(datas);
             $(".chosen-update").trigger("chosen:updated");
             return false;
         }
     });

  var url3     =  window.location.origin+'/brandslotbyasset?asset_id=<?php echo e($slot->asset_id); ?>';
  $.ajax({
      url : url3,
      type: "GET",
      dataType: 'html',
      success: function(datas3){
          $('.brand_chosen').html(datas3);
          $(".chosen-update2").trigger("chosen:updated");
          return false;
      }
  });

   }
   });


   });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>