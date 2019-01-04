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
  <ol class="breadcrumb col-sm-12 col-xs-12 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
    <li class="">
      <a href="<?php echo e(url('asset/' .$port->asset_id. '/show')); ?>">
        Port
      </a>
    </li>

    <li class="">
      <a href="<?php echo e(url('asset/' .$node->getsbu->id. '/filter')); ?>">
        <?php echo empty($node->getsbu->name)?"":$node->getsbu->name; ?>

      </a>
    </li>
    <li class="">
      <a href="<?php echo e(url('asset/' .$node->getpop->parent_id. '/' .$node->getpop->id. '/filter2')); ?>">
        <?php echo empty($node->getpop->name)?"":$node->getpop->name; ?>

      </a>
    </li>
    <li class="">
      <a href="<?php echo e(url('#')); ?>">
        <?php echo empty($node->getmodel->name)?"":$node->getmodel->name; ?>

      </a>
    </li>

    <li class="">
      <a href="<?php echo e(url('asset/' .$port->asset_id. '/show')); ?>">
        <?php echo e($port->getsid->name); ?>

      </a>
    </li>
    <li class="active">
      <a href="#">
        Edit
      </a>
    </li>
  </ol>
  <a href="<?php echo e(url('asset/' .$port->asset_id. '/show')); ?>">
    <button class="btn btn-sm btn-outline btn-warning pull-right">
      <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
    </button>
  </a>
</div>
    <div class="row ibox-content" style="min-height: 65vh; ">
      <div class="col-xs-12 col-sm-22">

    <?php echo Form::open(['url' => 'update/port', 'class' => 'form-horizontal']); ?>

    <?php echo Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

    <?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

    <?php echo Form::hidden('asset_id', $port->asset_id, ['class' => 'form-control']); ?>

    <?php echo Form::hidden('id', $port->id, ['class' => 'form-control']); ?>


    <div class="form-group <?php echo e($errors->has('attr_type') ? 'has-error' : ''); ?>">
      <?php echo Form::label('attr_type', 'Port Type*', ['class' => 'col-sm-2 control-label']); ?>

      <div class="col-sm-4 col-xs-12 col-xs-12">
        <?php echo e(Form::select('attr_type', $templates, $port->attr_type, ['class' => 'form-control', 'disabled'])); ?>

        <?php echo $errors->first('attr_type', '<p class="help-block">:message</p>'); ?>

      </div>
    </div>
    <div class="form-group <?php echo e($errors->has('attr_no') ? 'has-error' : ''); ?>">
      <?php echo Form::label('attr_no', 'Port No*', ['class' => 'col-sm-2 control-label']); ?>

      <div class="col-sm-4 col-xs-12 col-xs-12">
      <?php echo Form::text('attr_no', $port->attr_no, ['class' => 'form-control','placeholder'=>'Port Type.','disabled']); ?>

      <?php echo $errors->first('attr_no', '<p class="help-block">:message</p>'); ?>

      </div>
    </div>
    <div class="form-group <?php echo e($errors->has('cust_id') ? 'has-error' : ''); ?>">
      <?php echo Form::label('cust_id', 'Customer', ['class' => 'col-sm-2 control-label']); ?>

      <div class="col-sm-4 col-xs-12">
      <?php echo e(Form::select('cust_id', $customers, $port->cust_id, ['class' => 'form-control chosen-select CustSelect chosen-update cust_chosen','id'=>'cust_id','disabled'])); ?>

      <?php echo $errors->first('cust_id', '<p class="help-block">:message</p>'); ?>

      </div>
    </div>
    <div class="form-group <?php echo e($errors->has('sid') ? 'has-error' : ''); ?>">
        <?php echo Form::label('sid', 'SID: ', ['class' => 'col-sm-2 control-label']); ?>

        <div class="col-sm-4 col-xs-12">
          <?php echo e(Form::select('sid', $sids, $port->sid, ['class' => 'form-control chosen-select SIDSelect chosen-update2 sid_chosen','id'=>'sid'])); ?>

          <?php echo $errors->first('sid', '<p class="help-block">:message</p>'); ?>

      </div>
    </div>
    <div class="form-group <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">
    <?php echo Form::label('status', 'Status*', ['class' => 'col-sm-2 control-label']); ?>

    <div class="col-sm-4 col-xs-12">
      <?php echo e(Form::select('status', $activations, $port->status, ['class' => 'form-control'])); ?>

        <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

      </div>
    </div>
      <div class="form-group <?php echo e($errors->has('desc') ? 'has-error' : ''); ?>">
        <?php echo Form::label('desc', 'Desc', ['class' => 'col-sm-2 control-label']); ?>

        <div class="col-sm-4 col-xs-12 col-xs-12">
              <textarea name="desc" type="text" class="form-control" placeholder="Description of Asset. [ Maks. 500 char ]" style="height: auto"><?php echo e($port->desc); ?></textarea>
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

   $('.CustSelect').on('change', function(e){

     if ($(this).find(':selected').val() != '') {
        var  val     = $(this).find(':selected').val(),
             item_d  = $(this).find(':selected').data(),
             url     =  window.location.origin+'/datasid?cust_id=' + val;

             $.ajax({
                 url : url,
                 type: "GET",
                 dataType: 'html',
                 success: function(datas){
                     $('.sid_chosen').html(datas);
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