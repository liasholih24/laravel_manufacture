<?php $__env->startSection('style'); ?>
  <style>
    .ibox { margin: 1px 2px 0px 0px !important }
    .ibox.float-e-margins{ margin: 0px 2px !important}
  </style>
  <?php echo e(HTML::style('assets_back/css/plugins/chosen/chosen.css')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
Data Sampah
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Edit 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <div class="wrapper wrapper-content">
		<div class="row detail_content3">
      <div class="col-lg-12 detail_content2" style="background-color: white">
        <div class="row ibox-title">
          <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
            <li class="">
              <a href="<?php echo e(url('sampah')); ?>">
                Data Sampah
              </a>
            </li>
            <li class="">
              <a href="<?php echo e(url('sampah/'.$node->id.'/show')); ?>">
                <?php echo e($node->name); ?>

              </a>
            </li>
            <li class="">
              <a href="#">
                Edit 
              </a>
            </li>
          </ol>
          <a href="<?php echo e(url()->previous()); ?>">
            <button class="btn btn-sm btn-outline btn-primary pull-right">
              <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
          </a>
        </div>
        <div class="row ibox-content" style="min-height: 65vh; ">
          <div class="col-xs-12 col-sm-12">
            <?php echo Form::model($node, [
              'method' => 'PATCH',
              'url' => ['sampah', $node->id],
              'class' => 'form-horizontal'
            ]); ?>

            <?php echo Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

              <?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>


            <div class="form-group ">
              <?php echo Form::label('code', 'Kode*', ['class' => 'col-sm-1 control-label']); ?>

              <div class="col-sm-5 <?php echo e($errors->has('code') ? 'has-error' : ''); ?>">
                <?php echo Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Kode/Singkatan.']); ?>

                <?php echo $errors->first('code', '<p class="help-block">:message</p>'); ?>

              </div>  
               <?php echo Form::label('categories', 'Kategori*', ['class' => 'col-sm-1 control-label']); ?>

              <div class="col-sm-5">
                <div class="input-group col-sm-12 col-xs-12 ">
                  <?php echo e(Form::select('parent_id', $categories, $node->parent_id, ['class' => 'form-control chosen-select'])); ?>

                </div>
                <?php echo $errors->first('category', '<p class="help-block">:message</p>'); ?>

              </div>
            </div>
            <div class="form-group">
             <?php echo Form::label('name', 'Nama*', ['class' => 'col-sm-1 control-label']); ?>

              <div class="col-sm-5 <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
                <?php echo Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nama [Max: 50 Character]']); ?>

                <?php echo $errors->first('name', '<p class="help-block">:message</p>'); ?>

              </div>
        
              <?php echo Form::label('status', 'Status*', ['class' => 'col-sm-1 control-label']); ?>

              <div class="col-sm-5 col-xs-12">
                <div class="input-group col-sm-12 col-xs-12 ">
                  <?php echo e(Form::select('status', $activations, $node->status, ['class' => 'form-control chosen-select'])); ?>

                </div>
                <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

              </div>
            </div>
            <?php if($node->nesting == 1): ?>
              <div class="form-group ">
                <?php echo Form::label('sell_price', 'Nilai Jual*', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5 <?php echo e($errors->has('sell_price') ? 'has-error' : ''); ?>">
                   <?php echo Form::number('sell_price', null, ['class' => 'form-control', 'placeholder' => 'Nilai Jual','step'=>'any']); ?>

                  <?php echo $errors->first('sell_price', '<p class="help-block">:message</p>'); ?>

                </div>
                <?php echo Form::label('satuan', 'Satuan*', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5 col-xs-12">
                  <div class="input-group col-sm-12 col-xs-12 ">
                    <?php echo e(Form::select('satuan', $satuans, null, ['class' => 'form-control chosen-select','placeholder'=>'Pilih Satuan'])); ?>

                  </div>
                  <?php echo $errors->first('satuan', '<p class="help-block">:message</p>'); ?>

                </div>
                
              </div> 
            
            <div class="form-group">
                <?php echo Form::label('buy_price', 'Nilai Beli*', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5 <?php echo e($errors->has('buy_price') ? 'has-error' : ''); ?>">
                  <?php echo Form::number('buy_price', null, ['class' => 'form-control', 'placeholder' => 'Nilai Beli','step'=>'any']); ?>

                  <?php echo $errors->first('buy_price', '<p class="help-block">:message</p>'); ?>

                </div>
               

              <?php echo Form::label('type', 'Type*', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5 col-xs-12">
                  <div class="input-group col-sm-12 col-xs-12 ">
                    <?php echo e(Form::select('type', $types, null, ['class' => 'form-control chosen-select','placeholder'=>'Pilih Type'])); ?>

                  </div>
                  <?php echo $errors->first('satuan', '<p class="help-block">:message</p>'); ?>

                </div>
             
            </div>
              <?php endif; ?>
             <div class="form-group">
             <?php echo Form::label('note', 'Deskripsi', ['class' => 'col-sm-1 control-label']); ?>

              <div class="col-sm-5 col-xs-12">
                <?php echo Form::textarea('note', null, ['class' => 'form-control', 'rows' => '2', 'placeholder' => 'Deskripsi [Max: 500 Katakter]']); ?>

                <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

              </div>
            </div>
            <div class="form-group">
              <a href="<?php echo e(url()->previous()); ?>" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
              <button type="submit" class="create_mdl btn btn-outline btn-success pull-right" style="margin-right: 10px; ">
                <i class="fa fa-save"></i> Update
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
<?php echo e(HTML::script('assets_back/js/plugins/chosen/chosen.jquery.js')); ?>

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function(){
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
        });
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>