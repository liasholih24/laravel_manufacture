<?php $__env->startSection('title'); ?>
Asset
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Mutation Asset
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php echo e(HTML::style('assets_back/css/plugins/select2/select2.min.css')); ?>

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
  <ol class="breadcrumb col-sm-12 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
    <li class="">
      <a href="<?php echo e(url('asset')); ?>">
        Asset
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
    <li class="active">
      <a href="#">
        Mutation
      </a>
    </li>
  </ol>
  <a href="<?php echo e(url('asset/' .$asset->id. '')); ?>">
    <button class="btn btn-sm btn-outline btn-warning pull-right">
      <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
    </button>
  </a>
</div>
    <div class="row ibox-content" style="min-height: 65vh; ">
       <?php $__currentLoopData = ['danger', 'warning', 'success', 'info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if(Session::has('alert-' . $msg)): ?>
          <div class="alert alert-<?php echo e($msg); ?> alert-dismissable">
              <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
              <?php echo e(Session::get('alert-' . $msg)); ?>.
          </div>
          <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <div class="col-xs-12 col-sm-22">
  <?php echo Form::open(['url' => 'update/mutation', 'class' => 'form-horizontal']); ?>

  <?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

  <?php echo Form::hidden('asset_id', $asset->id, ['class' => 'form-control']); ?>

  <?php echo Form::hidden('model', $model, ['class' => 'form-control']); ?>

  <?php echo Form::hidden('inputan', "mutasi", ['class' => 'form-control']); ?>


    <div class="form-group">
      <?php echo Form::label('sbu_id', 'SBU*', ['class' => 'col-sm-2 control-label']); ?>

      <div class="col-sm-4 <?php echo e($errors->has('sbu_id') ? 'has-error' : ''); ?>">
      <?php echo e(Form::select('sbu_id', $sbus, $asset->sbu_id, ['class' => 'form-control chosen-select SelectSBU chosen-update'])); ?>

      <?php echo $errors->first('sbu_id', '<p class="help-block">:message</p>'); ?>

      </div>
    </div>
    <div class="form-group">
      <?php echo Form::label('pop_id', 'Site*', ['class' => 'col-sm-2 control-label']); ?>

      <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('pop_id') ? 'has-error' : ''); ?>">
        <?php echo e(Form::select('pop_id', $pops, $asset->pop_id , ['class' => 'form-control chosen-select chosen-update2 pop_chosen','id' => 'pop','placeholder'=>'Select POP'])); ?>


        <?php echo $errors->first('pop_id', '<p class="help-block">:message</p>'); ?>

      </div>

    </div>
    <div class="form-group">
        <?php echo Form::label('desc', 'Site Notes*', ['class' => 'col-sm-2 control-label']); ?>

        <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('desc') ? 'has-error' : ''); ?>">
           <?php echo e(Form::textarea('desc', $asset->desc_mutasi, ['size' => '50x5','class' => 'form-control','placeholder' => 'Notes of Site Mutation.'])); ?>      
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
            url     =  window.location.origin+'/popmutation?sbu_id='+val+'&model=<?php echo e($model); ?>&open_gdg=<?php echo e($open_gdg); ?>' ;
         // alert(val);
          $.ajax({
              url : url,
              type: "GET",
              dataType: 'html',
              success: function(datas){
                  $('.pop_chosen').html(datas);
                  $(".chosen-update2").trigger("chosen:updated");
                  return false;
              }
          });
          //END SLOT NO

    }

  });



   });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>