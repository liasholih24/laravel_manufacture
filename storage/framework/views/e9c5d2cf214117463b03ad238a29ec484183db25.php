<?php $__env->startSection('title'); ?>
Nasabah
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Data Nasabah
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
  <?php echo e(HTML::style('assets_back/css/plugins/dataTables/datatables.min.css')); ?>

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
                <a href="<?php echo e(url('nasabah')); ?>">  Nasabah</a>
            </li>
            <li class="active">
                    <a href="#">
                        Preview 
                    </a>
            </li>
        </ol>
                <a href="<?php echo e(url('nasabah')); ?>">
                <button class="btn btn-sm btn-outline btn-primary pull-right">
                <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
                </button>
                </a>
        </div>

    <div class="row ibox-content" style="min-height: 70vh">
          <?php $__currentLoopData = ['danger', 'warning', 'success', 'info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if(Session::has('alert-' . $msg)): ?>
              <div class="alert alert-<?php echo e($msg); ?> alert-dismissable">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                            <?php echo e(Session::get('alert-' . $msg)); ?>.
              </div>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <div class="tabs-container" id="dataTabs">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#dtl" class="dtl" data-status="true">Info Nasabah</a></li>
                <li class=""><a data-toggle="tab" href="#riwayat"  class="attr" d data-status="false">Riwayat Transaksi</a></li>
                <li class=""><a data-toggle="tab" href="#log"  class="attr" d data-status="false">Logs</a></li>
                <?php if(Sentinel::getUser()->hasAccess(['sampah.destroy'])): ?>
                <?php echo Form::open([
                            'method'=>'DELETE',
                            'url' => ['nasabah', $nasabah->id],
                            'style' => 'display:inline',
                            'id'=>'formfield'
                        ]); ?>

                            <?php echo Form::button('<i class="fa fa-trash"></i> Delete', ['class' => 'btn btn-sm btn-outline btn-danger pull-right', 'style' => 'margin-left:10px',
                            'name' => 'btn', 'value' => 'Submit', 'id' => 'submitBtn', 'data-toggle' =>'modal', 'data-target' => '#confirm-submit' ]); ?>

                        <?php echo Form::close(); ?>


                  <?php endif; ?>
                  
                  <?php if(Sentinel::getUser()->hasAccess(['nasabah.edit'])): ?>
                <a href="<?php echo e(url('nasabah/'. $nasabah->id .'/edit')); ?>" style="margin-left:10px;" class="btn btn-sm btn-outline btn-success pull-right" id="submitBtn2" data-toogle="modal" data-target="#confirm-submit2"> 
                 <i class="fa fa-edit"></i> Edit</a>
                 
                 <?php echo Form::button('<i class="fa fa-config"></i> Cetak Buku', ['class' => 'btn btn-sm  btn-success pull-right', 'style' => 'margin-left:10px',
                            'name' => 'btn', 'value' => 'Submit', 'id' => 'submitBtn3', 'data-toggle' =>'modal', 'data-target' => '#confirm-submit3' ]); ?>


                 

                        <?php echo Form::model($nasabah, [
                                'method' => 'PATCH',
                                'url' => ['nasabah', $nasabah->id],
                                'class' => 'form-horizontal',
                                'id'=>'formfield2'
                            ]); ?>


                  <?php echo Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

                  <?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

                  <?php echo Form::hidden('email', $nasabah->norek , ['class' => 'form-control']); ?>

                  <?php echo Form::hidden('password', "resik" , ['class' => 'form-control']); ?>

                  <?php echo Form::hidden('password_confirmation', "resik" , ['class' => 'form-control']); ?>

                  <?php echo Form::hidden('first_name', $nasabah->nama_depan , ['class' => 'form-control']); ?>

                  <?php echo Form::hidden('last_name', $nasabah->nama_belakang , ['class' => 'form-control']); ?>

                  <?php echo Form::hidden('role', 3, ['class' => 'form-control']); ?>

                  <?php echo Form::hidden('status', 3, ['class' => 'form-control']); ?>

                  <?php echo Form::hidden('mobile_id', 1, ['class' => 'form-control']); ?>

                

                        <?php if(empty($nasabah->login_id)): ?>
                            <?php echo Form::button('<i class="fa fa-config"></i> Aktifkan Mobile', ['class' => 'btn btn-sm  btn-success btn-outline pull-right', 'style' => 'margin-left:10px',
                            'name' => 'btn', 'value' => 'Submit', 'id' => 'submitBtn2', 'data-toggle' =>'modal', 'data-target' => '#confirm-submit2' ]); ?>


                        <?php endif; ?>

                        <?php echo Form::close(); ?>


                <?php endif; ?>
                </ul>
            <div class="tab-content">
                <div id="dtl" class="tab-pane active">
                  <div class="row col-sm-12" style="margin-top: 20px">

                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">No. Rekening</p>
                        <p class="col-sm-8 col-xs-9 row">:  <?php echo e($nasabah->norek); ?>

                        </p>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Kelompok Anggota</p>
                        <p class="col-sm-8 col-xs-9 row">: <?php echo e($nasabah->getgroup->code); ?> - <?php echo e($nasabah->getgroup->name); ?> 
                        </p>
                      </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Nama </p>
                        <p class="col-sm-8 col-xs-9 row">:  <?php echo e($nasabah->nama_depan); ?> <?php echo e($nasabah->nama_belakang); ?>

                        </p>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                       <p class="col-sm-5 col-xs-3 row">Jenis Nasabah </p>
                        <p class="col-sm-8 col-xs-9 row">:  <?php echo e($nasabah->jenis_nasabah); ?> 
                        </p>
                      </div>
                    </div>
                     <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-6 col-xs-12">
                        
                        <p class="col-sm-5 col-xs-3 row">Identitas</p>
                        <p class="col-sm-8 col-xs-9 row">: <?php echo e($nasabah->tipe_identitas); ?> - <?php echo e($nasabah->no_identitas); ?> 
                        </p>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Unit Kerja</p>
                        <p class="col-sm-8 col-xs-9 row">: <?php echo empty($nasabah->getunit->name)?"<i>No Data</i>": $nasabah->getunit->name; ?>

                        </p>
                      </div>
                    </div>
                    <?php if($nasabah->jenis_nasabah == "Perorangan"): ?>
                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-6 col-xs-12">
                        
                        <p class="col-sm-5 col-xs-3 row">Pekerjaan</p>
                        <p class="col-sm-8 col-xs-9 row">: <?php echo e($nasabah->pekerjaan); ?> 
                        </p>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Organisasi</p>
                        <p class="col-sm-8 col-xs-9 row">: <?php echo e($nasabah->organisasi); ?> 
                        </p>
                      </div>
                    </div>
                    <?php endif; ?>
                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-6 col-xs-12">
                        
                        <p class="col-sm-5 col-xs-3 row">No. Telepon</p>
                        <p class="col-sm-8 col-xs-9 row">: <?php echo e($nasabah->no_telp); ?> 
                        </p>
                      </div>
                      <?php if($nasabah->jenis_nasabah == "Binaan"): ?>
                       <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">PIC Binaan</p>
                        <p class="col-sm-8 col-xs-9 row">: <?php echo e($nasabah->pic); ?> 
                        </p>
                      </div>
                      <?php endif; ?>
                     
                    </div>
                     <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-6 col-xs-12">
                        
                        <p class="col-sm-5 col-xs-3 row">Alamat</p>
                        <p class="col-sm-8 col-xs-9 row">: <?php echo e($nasabah->alamat); ?> 
                        </p>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Status</p>
                        <p class="col-sm-8 col-xs-9 row">: <?php echo e($nasabah->getstatus->name); ?> 
                        </p>
                      </div>
                     
                    </div>
                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-6 col-xs-12">
                        
                        <p class="col-sm-5 col-xs-3 row">Created By</p>
                        <p class="col-sm-8 col-xs-9 row">: <?php echo e($nasabah->createdby->first_name); ?> <?php echo e($nasabah->createdby->last_name); ?> 
                        </p>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Created At</p>
                        <p class="col-sm-8 col-xs-9 row">: <?php echo e($nasabah->created_at); ?> 
                        </p>
                      </div>
                     
                    </div>
                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-6 col-xs-12">
                        
                        <p class="col-sm-5 col-xs-3 row">Updated By</p>
                        <p class="col-sm-8 col-xs-9 row">: <?php echo e($nasabah->updatedby->first_name); ?> <?php echo e($nasabah->updatedby->last_name); ?> 
                        </p>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Updated At</p>
                        <p class="col-sm-8 col-xs-9 row">: <?php echo e($nasabah->updated_at); ?> 
                        </p>
                      </div>
                     
                    </div>
                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-12 col-xs-12">
                        <h3 class="col-sm-10 col-xs-3 row">Keterangan mengenai <?php echo e($nasabah->nama_depan); ?> <?php echo e($nasabah->nama_belakang); ?></h3>
                      </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-12 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row"><?php echo empty($nasabah->desc)?"Tidak ada keterangan":$nasabah->desc; ?></p>
                      </div>
                    </div>
                    
           
             
                  </div>
                </div>
                <div id="riwayat" class="tab-pane">
                  <br>
                  <?php if(!empty($riwayats[0])): ?>
                    <div class="table-responsive" style="margin-top: 20px">
                    <table class="table table-striped table-bordered table-hover" id="table_riwayat">
                      <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Debit</th>
                            <th>Kredit</th>
                            <th>Saldo</th>
                            <th>Keterangan</th>
                            <th>Tgl. Transaksi</th>
                            <th>Diproses oleh</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php $i=0;?>
                <?php $__currentLoopData = $riwayats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $i++?>
                <tr>
                    <td><?php echo e($i); ?></td>
                    <td><?php echo e($item->trx_code); ?></td>
                    <td><?php echo e(empty($item->debit)? "0" : $item->debit); ?></td>
                    <td><?php echo e(empty($item->kredit)? "0" : $item->kredit); ?></td>
                    <td><?php echo e(empty($item->saldo)? "0" : $item->saldo); ?></td>
                    <td><?php echo empty($item->keterangan)? "<i>Tidak ada keterangan</i>" : $item->keterangan; ?></td>
                    <td><?php echo e($item->created_at); ?></td>
                    <td><?php echo e(empty($item->createdby->first_name)?"": $item->createdby->first_name); ?> <?php echo e(empty($item->createdby->last_name)?"": $item->createdby->last_name); ?></td>
                
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
                      
                    </table>
                  </div>
                  <?php else: ?>
                  <div class="jumbotron">
                        <h1>Data Kosong ... </h1>
                        <p>Mohon maaf, tidak ada riwayat transaksi untuk nasabah <?php echo e($nasabah->nama_depan); ?>.</p>
                         <?php if(Sentinel::getUser()->hasAccess(['tabungan.create'])): ?>
                        <p><a href="<?php echo e(url('tabungan/create')); ?>" class="btn btn-primary btn-lg" role="button">Tambah Transaksi</a>
                          <?php endif; ?>
                        </p>
        </div>
                  <?php endif; ?>
                  
                </div>
                <div id="log" class="tab-pane">
                  <br>
                    <div class="table-responsive" style="margin-top: 20px">
                    <table class="table table-striped table-bordered table-hover" id="table_log">
                      <thead>

                        <tr>
                          <th>No.</th>
                          <th>Description</th>
                          <th>Created By</th>
                          <th>Created At</th>
                        </tr>
                      </thead>
                      
                    </table>
                  </div>
                </div>

                <div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Konfirmasi
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data?
                <br/><br/>
                <table class="table">
                    <tr>
                        <th>No. Rekening</th>
                        <td >: <?php echo e($nasabah->norek); ?></td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>: <?php echo e($nasabah->nama_depan); ?> <?php echo e($nasabah->nama_belakang); ?></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" id="submit" class="btn btn-danger success">Delete</a>

            </div>
        </div>
    </div>
  </div>
  <div class="modal fade" id="confirm-submit2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Konfirmasi
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin mengaktifkan login aplikasi mobile untuk : 
                <br/><br/>
                <table class="table">
                    <tr>
                        <th>No. Rekening</th>
                        <td >: <?php echo e($nasabah->norek); ?></td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>: <?php echo e($nasabah->nama_depan); ?> <?php echo e($nasabah->nama_belakang); ?></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" id="submit2" class="btn btn-success success">Aktifkan</a>

            </div>
        </div>
    </div>
  </div>
  <div class="modal fade" id="confirm-submit3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Konfirmasi
            </div>
             <?php echo Form::open(['url' => 'prints', 'class' => 'form-horizontal','id'=>'formfield3','target'=>'_blank']); ?>

             <?php echo Form::hidden('id', $nasabah->id, ['class' => 'form-control' ]); ?>

             <?php echo Form::hidden('norek', $nasabah->norek, ['class' => 'form-control' ]); ?>

            <div class="modal-body">
               Mohon masukkan baris terakhir dalam buku tabungan.
               <br><br>
                <table class="table">
                    <tr>
                        <td > <?php echo Form::number('baris', null, ['class' => 'form-control','placeholder'=>'No. Baris.']); ?></td>
                    </tr>
                   
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">
       				 <i class="fa fa-pencil"></i>  Cetak
        		</button>

            </div>
             <?php echo Form::close(); ?>

        </div>
    </div>
  </div>

            </div>
          </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<?php echo e(HTML::script('assets_back/js/plugins/dataTables/datatables.min.js')); ?>

<!-- Page-Level Scripts -->
<script>

     $(document).ready(function(){
      /* Init DataTables */
      var oTable = $('#table_riwayat').DataTable( {order: [ 6, 'desc' ]});
      var oTable = $('#table_log').DataTable();

      $('#submit').click(function(){
        $('#formfield').submit(); 
      });

       $('#submit2').click(function(){
        $('#formfield2').submit(); 
      });

       $('#submit3').click(function(){
        $('#formfield3').submit(); 
      });

    });


</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>