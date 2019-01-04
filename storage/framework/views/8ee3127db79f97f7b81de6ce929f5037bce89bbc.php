<?php $__env->startSection('title'); ?>
Penadah
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Edit Data
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="wrapper wrapper-content">
					<div class="row detail_content3">
	<div class="col-lg-12 detail_content2" style="background-color: white"><style>
						.ibox { margin: 1px 2px 0px 0px !important }
						.ibox.float-e-margins{ margin: 0px 2px !important}
						</style>
      <div class="row ibox-title">
   <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
        <li class="">
            <a href="<?php echo e(url('penadah')); ?>">  Penadah</a>
        </li>
        <li class="">
            <a href="<?php echo e(url('penadah/'.$penadah->id.'')); ?>">  <?php echo e($penadah->name); ?></a>
        </li>
        
        <li class="">
                <a href="#">
                    Edit 
                </a>
        </li>
    </ol>
            <a href="<?php echo e(url('penadah')); ?>">
            <button class="btn btn-sm btn-outline btn-primary pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
<div class="row ibox-content" style="min-height: 65vh; ">
	<div class="col-xs-12 col-sm-12">
  <?php echo Form::model($penadah, [
      'method' => 'PATCH',
      'url' => ['penadah', $penadah->id],
      'class' => 'form-horizontal'
  ]); ?>


                         <div class="form-group">
                <?php echo Form::label('code', 'Kode*', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5 <?php echo e($errors->has('code') ? 'has-error' : ''); ?>">
                    <?php echo Form::text('code', null, ['class' => 'form-control','placeholder'=>'Kode/Singkatan.']); ?>

                    <?php echo $errors->first('code', '<p class="help-block">:message</p>'); ?>

                </div>
                <?php echo Form::label('name', 'Nama*', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5 <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
                    <?php echo Form::text('name', null, ['class' => 'form-control','placeholder'=>'Nama Penadah']); ?>

                    <?php echo $errors->first('name', '<p class="help-block">:message</p>'); ?>

                </div>
            </div>
            <div class="form-group <?php echo e($errors->has('phone') ? 'has-error' : ''); ?>">
                <?php echo Form::label('phone', 'No.Telepon', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5">
                    <?php echo Form::text('phone', null, ['class' => 'form-control','placeholder'=>'No.Telepon']); ?>

                    <?php echo $errors->first('phone', '<p class="help-block">:message</p>'); ?>

                </div>
                <?php echo Form::label('pic', 'PIC', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5">
                    <?php echo Form::text('pic', null, ['class' => 'form-control','placeholder'=>'Nama PIC']); ?>

                    <?php echo $errors->first('pic', '<p class="help-block">:message</p>'); ?>

                </div>
            </div>
            <div class="form-group ">
                <?php echo Form::label('address', 'Alamat', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5 col-xs-12 <?php echo e($errors->has('address') ? 'has-error' : ''); ?>">
                  <?php echo Form::textarea('address', null, ['class' => 'form-control', 'rows' => '2', 'placeholder' => 'Alamat [Max: 500 Katakter]']); ?>

                  <?php echo $errors->first('address', '<p class="help-block">:message</p>'); ?>

                </div>
                <?php echo Form::label('notes', 'Deskripsi', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5 col-xs-12 <?php echo e($errors->has('notes') ? 'has-error' : ''); ?>">
                  <?php echo Form::textarea('notes', null, ['class' => 'form-control', 'rows' => '2', 'placeholder' => 'Deskripsi [Max: 500 Katakter]']); ?>

                  <?php echo $errors->first('notes', '<p class="help-block">:message</p>'); ?>

                </div>               
            </div>
            <div class="form-group ">
            <?php echo Form::label('status', 'Status*', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5 col-xs-12">
                  <div class="input-group col-sm-12 col-xs-12 ">
                    <?php echo e(Form::select('status', $activations, null, ['class' => 'form-control chosen-select'])); ?>

                  </div>
                  <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

                </div>
            </div>



    <div class="form-group">

      <a href="<?php echo e(url('penadah')); ?>" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>

            <button type="submit" class="create_mdl btn btn-outline btn-success pull-right" style="margin-right: 20px; ">
                              <i class="fa fa-save"></i>  Update
                            </button>
    </div>
    </div>
    </div>
    <?php echo Form::close(); ?>

  </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>