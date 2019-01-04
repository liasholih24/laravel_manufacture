<?php $__env->startSection('style'); ?>
  <style>
    .ibox { margin: 1px 2px 0px 0px !important }
    .ibox.float-e-margins{ margin: 0px 2px !important}
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
  Create Category
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
  Manage Category
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <div class="wrapper wrapper-content">
  	<div class="row detail_content3">
  	  <div class="col-lg-12 detail_content2" style="background-color: white">
        <div class="row ibox-title">
         <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
            <li class="">
              <a href="<?php echo e(url()->previous()); ?>"> Asset Category
            </li>
            /
            <?php if(!empty($id)): ?>
            <li class="">
              <a href="#">
                <?php echo e($sampah->name); ?>

              </a>
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
          <div class="col-xs-12 col-sm-12">
            <?php echo Form::open(['url' => 'sampah', 'class' => 'form-horizontal']); ?>

              <?php echo Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

                <?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>


              <div class="form-group ">
                <?php echo Form::label('code', 'Code: ', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5 <?php echo e($errors->has('code') ? 'has-error' : ''); ?>">
                  <?php echo Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Category Code [Max: 7 Character]']); ?>

                  <?php echo $errors->first('code', '<p class="help-block">:message</p>'); ?>

                </div>
                <?php echo Form::label('name', 'Name: ', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5 <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
                  <?php echo Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Category Name [Max: 50 Character]']); ?>

                  <?php echo $errors->first('name', '<p class="help-block">:message</p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('categories', 'Category: ', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5">
                  <div class="input-group col-sm-12 col-xs-12 ">
                    <select class="form-control m-b select2_demo_1" name="sampah">
                      <?php if(!empty($id)): ?>
                        <option value="<?php echo e($sampah->id); ?>" selected><?php echo e($sampah->name); ?></option>
                      <?php else: ?>

                      <?php if($id=='0'): ?>
                        <?php $__currentLoopData = $sampah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php else: ?>
                        <option value="uncategories">Choose Category</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sampah): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php $__currentLoopData = $sampah->getDescendantsAndSelf(array('id','parent_id','name','nesting'))->toHierarchy(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($relation->nesting==0): ?>
      										    <option value="<?php echo e($relation->id); ?>"><?php echo e($relation->name); ?></option>
                            <?php elseif($relation->nesting==1): ?>
                              <option value="<?php echo e($relation->id); ?>">
                                &nbsp;&nbsp;<?php echo e($relation->name); ?>

                              </option>
                            <?php elseif($relation->nesting==2): ?>
                              <option value="<?php echo e($relation->id); ?>">
                                &nbsp;&nbsp;&nbsp;<?php echo e($relation->name); ?>

                              </option>
        								    <?php endif; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                    <?php endif; ?>
                    </select>
                  </div>
                  <?php echo $errors->first('sampah', '<p class="help-block">:message</p>'); ?>

                </div>
                <?php echo Form::label('status', 'Status: ', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5 col-xs-12">
                  <div class="input-group col-sm-12 col-xs-12 ">
                    <?php echo e(Form::select('status', $activations, null, ['class' => 'form-control'])); ?>

                  </div>
                  <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('note', 'Description: ', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-11 col-xs-12">
                  <?php echo Form::textarea('note', null, ['class' => 'form-control', 'rows' => '2', 'placeholder' => 'Notes about assets sampah [Max: 500 Character]']); ?>

                  <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <a href="<?php echo e(url()->previous()); ?>" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
                  <button type="submit" class="create_mdl btn btn-outline btn-primary pull-right" style="margin-right: 10px; ">
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>