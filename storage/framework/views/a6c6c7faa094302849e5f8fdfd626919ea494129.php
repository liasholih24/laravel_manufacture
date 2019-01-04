<?php $__env->startSection('style'); ?>
  <style>
    .ibox { margin: 1px 2px 0px 0px !important }
    .ibox.float-e-margins{ margin: 0px 2px !important}
  </style>
  <?php echo e(HTML::style('assets_back/css/plugins/chosen/chosen.css')); ?>

  <?php echo e(HTML::style('assets_back/css/plugins/datapicker/datepicker3.css')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
Data Barang
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Tambah Baru
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <div class="wrapper wrapper-content">
  	<div class="row detail_content3">
  	  <div class="col-lg-12 detail_content2" style="background-color: white">
        <div class="row ibox-title">
         <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
            <li class="">
              <a href="<?php echo e(url('item')); ?>"> Data Barang</a>
            </li>
         
            <li class="active">
              Tambah Baru
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
            <?php echo Form::open(['url' => 'item', 'class' => 'form-horizontal','files'=>'true']); ?>

              <?php echo Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

                <?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>


              <div class="form-group ">
                <?php echo Form::label('code', 'Kode*', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5 <?php echo e($errors->has('code') ? 'has-error' : ''); ?>">
                  <?php echo Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Kode/Singkatan.']); ?>

                  <?php echo $errors->first('code', '<p class="help-block">:message</p>'); ?>

                </div>
                 <?php echo Form::label('categories', 'Kategori', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5">
                  <div class="input-group col-sm-12 col-xs-12 ">
                    <select class="form-control m-b chosen-select" name="item">
                      
                        <option value="uncategories">Choose Category</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          
                              <?php if($item->nesting==0): ?>
                                   <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option> 
                              <?php endif; ?>
                     
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     
                   
                    </select>
                  </div>
                  <?php echo $errors->first('item', '<p class="help-block">:message</p>'); ?>

                </div>
              </div>
              <div class="form-group">
               <?php echo Form::label('name', 'Nama*', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5 <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
                  <?php echo Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nama [Max: 50 Katakter]']); ?>

                  <?php echo $errors->first('name', '<p class="help-block">:message</p>'); ?>

                </div>

                <?php echo Form::label('status', 'Status*', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5 col-xs-12">
                  <div class="input-group col-sm-12 col-xs-12 ">
                    <?php echo e(Form::select('status', $activations, null, ['class' => 'form-control chosen-select'])); ?>

                  </div>
                  <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

                </div>
              </div>
              <?php if(!empty($id)): ?>
              <div class="form-group ">
                <?php echo Form::label('sell_price', 'Nilai Jual*', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5 <?php echo e($errors->has('sell_price') ? 'has-error' : ''); ?>">
                   <?php echo Form::text('sell_price', null, ['class' => 'form-control numeric','placeholder'=>'Nilai Jual Standard','id'=>'price','required'=>'required']); ?>

                
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
                <?php echo Form::text('buy_price', null, ['class' => 'form-control numeric','placeholder'=>'Nilai Beli Standard','id'=>'price2','required'=>'required']); ?>

                
                  <?php echo $errors->first('buy_price', '<p class="help-block">:message</p>'); ?>

                </div>
              <?php echo Form::label('type', 'Type', ['class' => 'col-sm-1 control-label']); ?>

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
                <?php echo Form::label('expire_date', 'Expire', ['class' => 'col-sm-1 control-label']); ?>

              <div class="col-sm-5 col-xs-12">
              <?php echo Form::text('expire_date', $datenow, ['id' => 'expire_date','class' => 'form-control','data-date-format'=>'yyyy-mm-dd','placeholder' => $datenow]); ?>

              <?php echo $errors->first('expire_date', '<p class="help-block">:message</p>'); ?>

              </div>
              </div>
              <div class="form-group <?php echo e($errors->has('thumbnail') ? 'has-error' : ''); ?>">
                <?php echo Form::label('thumbnail', 'Thumbnail', ['class' => 'col-sm-1 control-label']); ?>

                <div class="col-sm-5 col-xs-12">
                  <div class="image-crop">
                    <img id="imagePreview" src= "" style="max-height:200px">
                  </div>
                  <p>
                      Unggah Thumbnail
                  </p>
                  <div class="btn-group">
                      <label title="Upload image file" for="inputImage" class="btn btn-primary">
                          <input type="file" accept="image/*" name="thumbnail" id="inputImage" class="hide">
                          Upload
                      </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <a href="<?php echo e(url()->previous()); ?>" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Batal</a>
                  <button type="submit" class="create_mdl btn btn-outline btn-success pull-right" style="margin-right: 10px; ">
                    <i class="fa fa-plus-circle"></i>  Simpan
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

 <?php echo e(HTML::script('assets_back/js/plugins/inputmask/jquery.inputmask.bundle.js')); ?>

 <?php echo e(HTML::script('assets_back/js/plugins/datapicker/bootstrap-datepicker.js')); ?>

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

$('#price').inputmask("numeric", {
    radixPoint: ".",
    groupSeparator: ",",
    digits: 2,
    autoGroup: true,
    prefix: 'Rp.', 
    rightAlign: false,
    removeMaskOnSubmit: true,
    oncleared: function () { self.Value(''); }
});
$('#price2').inputmask("numeric", {
    radixPoint: ".",
    groupSeparator: ",",
    digits: 2,
    autoGroup: true,
    prefix: 'Rp.', 
    rightAlign: false,
    removeMaskOnSubmit: true,
    oncleared: function () { self.Value(''); }
});
$("#expire_date").datepicker({
              format :  'yyyy-mm-dd',
              keyboardNavigation : false,
              forceParce: false,
              todayBtn: 'linked',
              todayHighlight :  true,
              daysOfWeekDisabled : [0],
            });

      function readURL(input) {

if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
        $('#imagePreview').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
}
}

$("#inputImage").change(function(){
readURL(this);
});
        });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>