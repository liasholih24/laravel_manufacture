<?php $__env->startSection('title'); ?>
Edit Status
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
 <?php echo e(HTML::style('assets_back/css/plugins/chosen/chosen.css')); ?>

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
            <a href="<?php echo e(url('status')); ?>">  Status
        </li>
        /
        <li class="">
                <a href="#">
                    Edit Status
                </a>
        </li>
    </ol>
            <a href="<?php echo e(url('status')); ?>">
            <button class="btn btn-sm btn-outline btn-warning pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
<div class="row ibox-content" style="min-height: 65vh; ">
	<div class="col-xs-12 col-sm-12">
 		<?php echo Form::model($lokasi, [
        'method' => 'PATCH',
        'url' => ['lokasi', $lokasi->id],
        'class' => 'form-horizontal'
    		]); ?>


		<?php echo Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

		<?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>


		
		<div class="form-group">
			<?php echo Form::label('parent_id', 'Wilayah', ['class' => 'col-sm-1 control-label']); ?>

			<div class="col-sm-5 <?php echo e($errors->has('category') ? 'has-error' : ''); ?>">
				<?php echo e(Form::select('parent_id', $lokasis, null, ['class' => 'form-control chosen-select'])); ?>

					<?php echo $errors->first('parent_id', '<p class="help-block">:message</p>'); ?>

			</div>
			<?php echo Form::label('status', 'Status*', ['class' => 'col-sm-1 control-label']); ?>

			<div class="col-sm-5 <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">
				<?php echo e(Form::select('status', $activations, null, ['class' => 'form-control chosen-select'])); ?>

					<?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

			</div>
		</div>
<div class="form-group">
	<?php echo Form::label('code', 'Kode*', ['class' => 'col-sm-1 control-label']); ?>

	<div class="col-sm-5 <?php echo e($errors->has('code') ? 'has-error' : ''); ?>">
			<?php echo Form::text('code', null, ['class' => 'form-control','placeholder'=>'Kode/Singkatan.']); ?>

			<?php echo $errors->first('code', '<p class="help-block">:message</p>'); ?>

	</div>
	<?php echo Form::label('type', 'Type', ['class' => 'col-sm-1 control-label']); ?>

			<div class="col-sm-5 <?php echo e($errors->has('type') ? 'has-error' : ''); ?>">
				<?php echo e(Form::select('type', $types, null, ['class' => 'form-control chosen-select','placeholder'=>'Pilih Type'])); ?>

					<?php echo $errors->first('type', '<p class="help-block">:message</p>'); ?>

			</div>
</div>
<div class="form-group">
	<?php echo Form::label('name', 'Nama*', ['class' => 'col-sm-1 control-label']); ?>

	<div class="col-sm-5 <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
			<?php echo Form::text('name', null, ['class' => 'form-control','placeholder'=>'Nama Lokasi/Wilayah.']); ?>

			<?php echo $errors->first('name', '<p class="help-block">:message</p>'); ?>

	</div>
	<?php echo Form::label('address', 'Alamat*', ['class' => 'col-sm-1 control-label']); ?>

	<div class="col-sm-5 <?php echo e($errors->has('address') ? 'has-error' : ''); ?>">
			<?php echo Form::text('address', null, ['class' => 'form-control','placeholder'=>'Alamat Lokasi/Wilayah.']); ?>

			<?php echo $errors->first('address', '<p class="help-block">:message</p>'); ?>

	</div>
</div>
<div class="form-group">
<?php echo Form::label('notes', 'Deskripsi', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5 col-xs-12">
                  <?php echo Form::textarea('notes', null, ['class' => 'form-control', 'rows' => '2', 'placeholder' => 'Deskripsi [Max: 500 Katakter]']); ?>

                  <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

                </div>
</div>

    <div class="form-group">
<a href="<?php echo e(url('status')); ?>" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
      <button type="submit" class="create_mdl btn btn-outline btn-primary pull-right" style="margin-right: 20px; ">
                        <i class="fa fa-plus-circle"></i>  Create
                      </button>
      </a>
    </div>
    </div>
    </div>
    <?php echo Form::close(); ?>

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
        });
		
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>