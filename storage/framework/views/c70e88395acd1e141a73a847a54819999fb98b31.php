<?php $__env->startSection('title'); ?>
Nasabah
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Edit Nasabah
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
  <?php echo e(HTML::style('assets_back/css/plugins/iCheck/custom.css')); ?>

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
            <a href="<?php echo e(url('nasabah')); ?>">  Nasabah
        </li>
        /
        <li class="">
                <a href="#">
                    Edit Nasabah
                </a>
        </li>
    </ol>
            <a href="<?php echo e(url('nasabah')); ?>">
            <button class="btn btn-sm btn-outline btn-warning pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
<div class="row ibox-content" style="min-height: 65vh; ">
  <div class="col-xs-12 col-sm-12">
  <?php echo Form::model($nasabah, [
      'method' => 'PATCH',
      'url' => ['nasabah', $nasabah->id],
      'class' => 'form-horizontal'
  ]); ?>

    <?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>


             <div class="form-group <?php echo e($errors->has('group_code') ? 'has-error' : ''); ?>">
                <?php echo Form::label('group_code', 'Kelompok Anggota*', ['class' => 'col-sm-2 control-label']); ?>

                <div class="col-sm-3">
                <select  name="group_code" class="col-sm-12 form-control group chosen-select" data-placeholder="Pilih Kelompok Anggota" id="group" width="100%" disabled="">
                                  <option value="<?php echo e($nasabah->group_code); ?>" selected=""><?php echo e($nasabah->group_code); ?> - <?php echo e($nasabah->getgroup->name); ?></option>
                                </select>
                    
                    <?php echo $errors->first('group_code', '<p class="help-block">:message</p>'); ?>

                </div>
                <?php echo Form::label('norek', 'No.Rekening', ['class' => 'col-sm-2 control-label']); ?>

                <div class="col-sm-3">
                    <?php echo Form::text('norek', null, ['class' => 'form-control','id'=>'norek','readonly']); ?>

                    <?php echo $errors->first('norek', '<p class="help-block">:message</p>'); ?>

                </div>

             </div>
             <div class="hr-line-dashed"></div>
            
            <div class="form-group  <?php echo e($errors->has('jenis_nasabah') ? 'has-error' : ''); ?>">
                <?php echo Form::label('jenis_nasabah', 'Jenis Nasabah*', ['class' => 'col-sm-2 control-label']); ?>

                    <div class="col-sm-3">
                         <label class="i-checks"> 
                            <input type="radio" value="Perorangan" name="jenis_nasabah" id="Perorangan" <?php if($nasabah->jenis_nasabah == "Perorangan") {echo"checked";} else{echo"disabled";} ?>> <i></i> Perorangan
                        </label>
                        &nbsp;&nbsp;
                        <label class="i-checks"s> 
                            <input type="radio"  value="Binaan" name="jenis_nasabah" id="Binaan" <?php if($nasabah->jenis_nasabah == "Binaan") {echo"checked";} else{echo"disabled";} ?>> Binaan
                        </label>
                        <?php echo $errors->first('jenis_nasabah', '<p class="help-block">:message</p>'); ?>

                    </div>

                
                                       
            </div>
            <div class ="dataBinaan">
              <div class="hr-line-dashed"></div>
            <div class="form-group">
                <?php echo Form::label('pic', 'PIC Binaan', ['class' => 'col-sm-2 control-label']); ?>

                <div class="col-sm-8">
                    <?php echo Form::text('pic', null, ['class' => 'form-control','placeholder'=>'PIC/Penanggung Jawab Nasabah Binaan. ']); ?>

                    <?php echo $errors->first('pic', '<p class="help-block">:message</p>'); ?>

                </div>
                                       
            </div>
            </div>
       
             <div class="hr-line-dashed"></div>
            <div class="form-group <?php echo e($errors->has('tipe_identitas') ? 'has-error' : ''); ?>">
                <?php echo Form::label('tipe_identitas', 'Identitas*', ['class' => 'col-sm-2 control-label']); ?>

                    <div class="col-sm-8">
                        <div class="i-checks">
                        <label> 
                            <input type="radio" value="KTP" name="tipe_identitas" <?php if($nasabah->tipe_identitas == "KTP") echo"checked";?>> <i></i> KTP
                        </label> &nbsp;
                        <label> 
                            <input type="radio" value="SIM" name="tipe_identitas" <?php if($nasabah->tipe_identitas == "SIM") echo"checked";?>> <i></i> SIM
                        </label> &nbsp;
                        <label class="i-checks"s> 
                            <input type="radio" value="Paspor" name="tipe_identitas" <?php if($nasabah->tipe_identitas == "Paspor") echo"checked";?>> Paspor
                        </label> &nbsp;
                        <label class="i-checks"s> 
                            <input type="radio"  value="Kartu Pelajar/Mahasiswa" name="tipe_identitas" <?php if($nasabah->tipe_identitas == "Kartu Pelajar/Mahasiswa") echo"checked";?>> Kartu Pelajar/Mahasiswa
                        </label>
                        </div>
                        
                        <?php echo $errors->first('tipe_identitas', '<p class="help-block">:message</p>'); ?>

                    </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group <?php echo e($errors->has('no_identitas') ? 'has-error' : ''); ?>">
                <?php echo Form::label('no_identitas', 'No. Identitas*', ['class' => 'col-sm-2 control-label']); ?>

                <div class="col-sm-8">
                    <?php echo Form::text('no_identitas', null, ['class' => 'form-control','placeholder'=>'No. Identitas Calon Nasabah/PIC Binaan. ']); ?>

                    <?php echo $errors->first('no_identitas', '<p class="help-block">:message</p>'); ?>

                </div>
                                       
            </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group <?php echo e($errors->has('nama_depan') ? 'has-error' : ''); ?>">
                <?php echo Form::label('nama_depan', 'Nama Depan*', ['class' => 'col-sm-2 control-label']); ?>

                <div class="col-sm-8">
                    <?php echo Form::text('nama_depan', null, ['class' => 'form-control','placeholder'=>'Nama Calon Nasabah/Binaan.']); ?>

                    <?php echo $errors->first('nama_depan', '<p class="help-block">:message</p>'); ?>

                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group ">
                <?php echo Form::label('nama_belakang', 'Nama Belakang', ['class' => 'col-sm-2 control-label']); ?>

                <div class="col-sm-8 <?php echo e($errors->has('nama_belakang') ? 'has-error' : ''); ?>">
                    <?php echo Form::text('nama_belakang', null, ['class' => 'form-control','placeholder'=>'Nama Calon Nasabah/Binaan.']); ?>

                    <?php echo $errors->first('nama_belakang', '<p class="help-block">:message</p>'); ?>

                </div>
            </div>
          
            <div class="hr-line-dashed"></div>
         <div class="form-group">
                <?php echo Form::label('no_telp', 'No.Telepon', ['class' => 'col-sm-2 control-label']); ?>

                <div class="col-sm-8">
                    <?php echo Form::text('no_telp', null, ['class' => 'form-control','data-mask' => '(999) 999-9999','placeholder'=>'No. Telp Calon Nasabah/PIC Binaan.']); ?>

                    <?php echo $errors->first('no_telp', '<p class="help-block">:message</p>'); ?>

                </div>
               
                                       
            </div>
            <div class="hr-line-dashed"></div>
            <div class="dataPerorangan">
            <div class="form-group <?php echo e($errors->has('pekerjaan') ? 'has-error' : ''); ?>">
                <?php echo Form::label('pekerjaan', 'Pekerjaan', ['class' => 'col-sm-2 control-label']); ?>

                <div class="col-sm-8">
                    <?php echo Form::text('pekerjaan', null, ['class' => 'form-control','placeholder'=>'Pekerjaan.']); ?>

                    <?php echo $errors->first('pekerjaan', '<p class="help-block">:message</p>'); ?>

                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group <?php echo e($errors->has('organisasi') ? 'has-error' : ''); ?>">
                <?php echo Form::label('organisasi', 'Organisasi', ['class' => 'col-sm-2 control-label']); ?>

                <div class="col-sm-8">
                    <?php echo Form::text('organisasi', null, ['class' => 'form-control','placeholder'=>'Organisasi/Perusahaan.']); ?>

                    <?php echo $errors->first('organisasi', '<p class="help-block">:message</p>'); ?>

                </div>
            </div>
           <div class="hr-line-dashed"></div>
         </div>
           <div class="form-group ">
                <?php echo Form::label('alamat', 'Alamat', ['class' => 'col-sm-2  control-label']); ?>

                <div class="col-sm-8 col-xs-12 <?php echo e($errors->has('alamat') ? 'has-error' : ''); ?>">
                  <?php echo Form::textarea('alamat', null, ['class' => 'form-control', 'rows' => '2', 'placeholder' => 'Alamat Nasabah [Max: 500 Katakter]']); ?>

                  <?php echo $errors->first('alamat', '<p class="help-block">:message</p>'); ?>

                </div>
         </div>
         <div class="hr-line-dashed"></div>
           <div class="form-group ">
                <?php echo Form::label('keterangan', 'Keterangan', ['class' => 'col-sm-2 control-label']); ?>

                <div class="col-sm-8 col-xs-12 <?php echo e($errors->has('notes') ? 'has-error' : ''); ?>">
                  <?php echo Form::textarea('keterangan', null, ['class' => 'form-control', 'rows' => '2', 'placeholder' => 'Keterangan [Max: 500 Katakter]']); ?>

                  <?php echo $errors->first('keterangan', '<p class="help-block">:message</p>'); ?>

                </div>               
            </div>
       
            



    <div class="form-group">
<a href="<?php echo e(url('nasabah')); ?>" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Batal</a>
      <button type="submit" class="create_mdl btn btn-outline btn-success pull-right" style="margin-right: 20px; ">
                        <i class="fa fa-save"></i>  Update
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
<?php echo e(HTML::script('assets_back/js/plugins/iCheck/icheck.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/chosen/chosen.jquery.js')); ?>

<script>
            $(document).ready(function () {
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
        var APP_URL = <?php echo json_encode(url('/')); ?>

        $('.group').on('change', function(e){

     if ($(this).find(':selected').val() != '') {
       
            // GET NOREK
         var val     = $(this).find(':selected').val(),
             item_d  = $(this).find(':selected').data(),
             url     =  '/getnorek?group_id='+val+'';

          // alert(val);
           $.ajax({
               url : url,
               type: "GET",
               dataType: 'html',
               success: function(datas){
                   //$('.norek_chosen').html(datas);
                   $('#norek').val(datas);
                   return false;
               }
           });
           //END GET NOREK
     }


   });
              if ( $('#Perorangan').is(':checked') ) {

                $('.dataPerorangan').show();
                $('.dataBinaan').hide();
              
               }else if ( $('#Binaan').is(':checked') ) {
                 $('.dataPerorangan').hide();
                $('.dataBinaan').show();
              } 


                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });

            });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>