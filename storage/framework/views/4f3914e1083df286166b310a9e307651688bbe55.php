<?php $__env->startSection('title'); ?>
Satuan
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Edit Satuan
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
  <style>
    .ibox { margin: 1px 2px 0px 0px !important }
    .ibox.float-e-margins{ margin: 0px 2px !important}
  </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <div class="wrapper wrapper-content">
        <div class="row detail_content3">
      <div class="col-lg-12 detail_content2" style="background-color: white">
        <div class="row ibox-title">
          <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
            <li class="">
              <a href="<?php echo e(url('satuan')); ?>">
                Satuan
              </a>
            </li>
            <li class="">
              <a href="#">
                Edit Satuan
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
    <?php echo Form::model($satuan, [
        'method' => 'PATCH',
        'url' => ['satuan', $satuan->id],
        'class' => 'form-horizontal'
    ]); ?>


        <?php echo Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

        <?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>


                <div class="form-group">
                <?php echo Form::label('code', 'Code*', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5 <?php echo e($errors->has('code') ? 'has-error' : ''); ?>">
                    <?php echo Form::text('code', null, ['class' => 'form-control','placeholder' => 'Kode Satuan.']); ?>

                    <?php echo $errors->first('code', '<p class="help-block">:message</p>'); ?>

                </div>
                <?php echo Form::label('standard_value', 'Ukuran*', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5 <?php echo e($errors->has('standard_value') ? 'has-error' : ''); ?>">
                    <?php echo Form::number('standard_value', null, ['class' => 'form-control', 'placeholder' => 'Ukuran Standar.','step'=>'any']); ?>

                    <?php echo $errors->first('standard_value', '<p class="help-block">:message</p>'); ?>

                </div>
               
            </div>
           
            <div class="form-group ">
                
                 <?php echo Form::label('name', 'Name*', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5 <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
                    <?php echo Form::text('name', null, ['class' => 'form-control','placeholder' => 'Nama Satuan.']); ?>

                    <?php echo $errors->first('name', '<p class="help-block">:message</p>'); ?>

                </div>
                 <?php echo Form::label('basis', 'Basis', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5 col-xs-12">
                  <?php echo e(Form::select('basis', $basises, null, ['class' => 'form-control','placeholder' => 'Pilih Basis'])); ?>

                  
                  <?php echo $errors->first('basis', '<p class="help-block">:message</p>'); ?>

                </div>
            </div>
             <div class="form-group <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
                <?php echo Form::label('desc', 'Deskripsi', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5">
                     <?php echo Form::textarea('note', null, ['class' => 'form-control', 'rows' => '2', 'placeholder' => 'Deskirpsi mengenai satuan [Max: 500 Karakter].']); ?>

                    <?php echo $errors->first('desc', '<p class="help-block">:message</p>'); ?>

                </div>
                <?php echo Form::label('status', 'Status*', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5 col-xs-12">
                  <?php echo e(Form::select('status', $activations, null, ['class' => 'form-control'])); ?>

                  
                  <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

                </div>
                
            </div>
           

            <div class="form-group">
                <a href="<?php echo e(url()->previous()); ?>" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Batal</a>
                  <button type="submit" class="create_mdl btn btn-outline btn-success pull-right" style="margin-right: 10px; ">
                    <i class="fa fa-save"></i>  Update
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
<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>