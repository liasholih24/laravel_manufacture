<?php $__env->startSection('title'); ?>
Asset
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Edit Asset
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php echo e(HTML::style('assets_back/css/plugins/datapicker/datepicker3.css')); ?>

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
  <ol class="breadcrumb col-sm-8 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
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
        Edit
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
      <div class="col-xs-12 col-sm-22">
    <?php echo Form::model($asset, [
        'method' => 'PATCH',
        'url' => ['asset', $asset->id],
        'class' => 'form-horizontal'
    ]); ?>

  <?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

  <?php echo Form::hidden('material_no', $asset->material_no, ['class' => 'form-control']); ?>

  <?php echo Form::hidden('qr_code', $asset->qr_code, ['class' => 'form-control']); ?>

  <?php echo Form::hidden('inputan', "newasset", ['class' => 'form-control']); ?>


    <div class="form-group">
      <?php echo Form::label('sbu_id', 'SBU*', ['class' => 'col-sm-2 control-label']); ?>

      <div class="col-sm-4 <?php echo e($errors->has('sbu_id') ? 'has-error' : ''); ?>">
      <?php echo e(Form::select('sbu_id', $sbus, null, ['class' => 'form-control select2_demo_1','id' => 'sbu','placeholder'=>'Select SBU','disabled'])); ?>

      <?php echo $errors->first('sbu_id', '<p class="help-block">:message</p>'); ?>

      </div>
      <?php echo Form::label('type_id', 'Type*', ['class' => 'col-sm-2 control-label']); ?>

      <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('type_id') ? 'has-error' : ''); ?>">
        <?php echo e(Form::select('type_id', $categories, null, ['class' => 'form-control select2_demo_1','id' => 'type','disabled'])); ?>

        <?php echo $errors->first('type_id', '<p class="help-block">:message</p>'); ?>

      </div>

    </div>
    <div class="form-group">
      <?php echo Form::label('pop', 'Site*', ['class' => 'col-sm-2 control-label']); ?>

      <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('pop_id') ? 'has-error' : ''); ?>">
        <?php echo e(Form::select('pop_id', $pops, null, ['class' => 'form-control select2_demo_1','id' => 'pop','placeholder'=>'Select POP','disabled'])); ?>


        <?php echo $errors->first('pop_id', '<p class="help-block">:message</p>'); ?>

      </div>
      <?php echo Form::label('category_id', 'Category*', ['class' => 'col-sm-2 control-label']); ?>

      <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('category_id') ? 'has-error' : ''); ?>">
        <?php echo e(Form::select('category_id', $category, null, ['class' => 'form-control select2_demo_1','id' => 'category','placeholder'=>'Select category','disabled'])); ?>


        <?php echo $errors->first('category_id', '<p class="help-block">:message</p>'); ?>

    </div>
    </div>
    <div class="form-group">
      <?php echo Form::label('building_id', 'Building*', ['class' => 'col-sm-2 control-label']); ?>

      <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('building_id') ? 'has-error' : ''); ?>">
        <?php echo e(Form::select('building_id', $buildings, null, ['class' => 'form-control select2_demo_1','id' => 'building_id','placeholder'=>'Select building'])); ?>


        <?php echo $errors->first('building_id', '<p class="help-block">:message</p>'); ?>

      </div>
      <?php echo Form::label('asset_category', 'Asset Category*', ['class' => 'col-sm-2 control-label']); ?>

      <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('asset_category') ? 'has-error' : ''); ?>">
        <?php echo e(Form::select('asset_category', $asset_category, null, ['class' => 'form-control select2_demo_1','id' => 'asset_category','placeholder'=>'Select asset_category','disabled'])); ?>


        <?php echo $errors->first('asset_category', '<p class="help-block">:message</p>'); ?>

      </div>
    </div>
    <div class="form-group">

      <?php echo Form::label('room_id', 'Room', ['class' => 'col-sm-2 control-label']); ?>

      <div class="col-sm-4 col-xs-12">
        <?php echo e(Form::select('room_id', $rooms, null, ['class' => 'form-control select2_demo_1','id' => 'room_id','placeholder'=>'Select Room'])); ?>


        <?php echo $errors->first('room_id', '<p class="help-block">:message</p>'); ?>

      </div>
      <?php echo Form::label('brand_id', 'Brand*', ['class' => 'col-sm-2 control-label']); ?>

      <div class="col-sm-4 <?php echo e($errors->has('brand_id') ? 'has-error' : ''); ?>">
        <?php echo e(Form::select('brand_id', $brands, null, ['class' => 'form-control select2_demo_1','id' => 'brand_id','placeholder'=>'Select brand','disabled'])); ?>

        <?php echo $errors->first('brand_id', '<p class="help-block">:message</p>'); ?>

      </div>
    </div>
    <div class="form-group">
      <?php echo Form::label('rack', 'Rack', ['class' => 'col-sm-2 control-label']); ?>

      <div class="col-sm-4 <?php echo e($errors->has('rack') ? 'has-error' : ''); ?>">
        <?php echo e(Form::select('rack', $racks, $asset->rack, ['class' => 'form-control select2_demo_1','placeholder'=>'Select Rack'])); ?>

      </div>
      <?php echo Form::label('model_id', 'Model*', ['class' => 'col-sm-2 control-label']); ?>

      <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('model_id') ? 'has-error' : ''); ?>">
        <?php echo e(Form::select('model_id', $models, null, ['class' => 'form-control select2_demo_1','id' => 'model_id','placeholder'=>'Select model','disabled'])); ?>


        <?php echo $errors->first('model_id', '<p class="help-block">:message</p>'); ?>

      </div>

    </div>
      <div class="form-group">
        <?php echo Form::label('status', 'Status*', ['class' => 'col-sm-2 control-label']); ?>

        <div class="col-sm-4 <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">
          <?php echo e(Form::select('status', $activations, null, ['class' => 'form-control'])); ?>

            <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

          </div>
        <?php echo Form::label('material', 'Material No*', ['class' => 'col-sm-2 control-label']); ?>

        <div class="col-sm-4 <?php echo e($errors->has('material') ? 'has-error' : ''); ?>">
          <?php echo Form::text('material', $asset->material_no, ['class' => 'form-control','placeholder'=>'Material Number.','disabled']); ?>

          <?php echo $errors->first('material', '<p class="help-block">:message</p>'); ?>

        </div>
      </div>
      <div class="form-group">
        <?php echo Form::label('condition', 'Condition*', ['class' => 'col-sm-2 control-label']); ?>

        <div class="col-sm-4 <?php echo e($errors->has('condition') ? 'has-error' : ''); ?>">
          <?php echo e(Form::select('condition', $conditions, null, ['class' => 'form-control'])); ?>

          <?php echo $errors->first('condition', '<p class="help-block">:message</p>'); ?>

        </div>

        <?php echo Form::label('investasi', 'Assets Value', ['class' => 'col-sm-2 control-label']); ?>

            <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('investasi') ? 'has-error' : ''); ?>">
              <?php echo Form::text('investasi', null, ['class' => 'form-control','placeholder'=>'Assets Value']); ?>

              <?php echo $errors->first('investasi', '<p class="help-block">Assets Value is required</p>'); ?>

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
                    <textarea name="desc" type="text" class="form-control" placeholder="Description of Asset. [ Maks. 500 char ]" style="height: auto"> <?php echo e($asset->desc); ?></textarea>
                  <?php echo $errors->first('desc', '<p class="help-block">:message</p>'); ?>

              </div>
              <?php echo Form::label('installation_year', 'Installation Year', ['class' => 'col-sm-2 control-label']); ?>

              <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('installation_year') ? 'has-error' : ''); ?>">
                <?php echo Form::text('installation_year', null, ['id' => 'installation_year','class' => 'form-control','data-date-format'=>'dd/mm/yyyy','placeholder' => 'Installation Year.']); ?>

                <?php echo $errors->first('installation_year', '<p class="help-block">:message</p>'); ?>

              </div>
            </div>
            <div class="hr-line-dashed"></div>
        <div class="form-group">
        <a href="<?php echo e(url('asset')); ?>" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
        <?php if(Sentinel::getUser()->hasAccess(['asset.edit'])): ?>
          <?php if($asset->getpop->offline_sts != 1): ?>
        <button type="submit" class="create_mdl btn btn-outline btn-primary pull-right" style="margin-right: 20px; ">
          <i class="fa fa-pencil"></i>  Update
        </button>
        <?php endif; ?>
        <?php endif; ?>
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

<?php echo e(HTML::script('assets_back/js/plugins/datapicker/bootstrap-datepicker.js')); ?>

<script>
var csrf = $('meta[name="csrf-token"]').attr('content');
 jQuery(document).ready(function() {
   $("#installation_year").datepicker({
     format :  'yyyy-mm-dd',
     keyboardNavigation : false,
     forceParce: false,
     todayBtn: 'linked',
     todayHighlight :  true,
     daysOfWeekDisabled : [0],
   });

   });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>