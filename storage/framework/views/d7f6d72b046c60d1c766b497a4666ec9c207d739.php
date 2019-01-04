<?php $__env->startSection('title'); ?>
Transaksi
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Tabungan Nasabah
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
        <li class="active">
            Tabungan Nasabah
        </li>
    </ol>
    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-sm btn-outline btn-primary pull-right">
        <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
    </a>
    <a href="<?php echo e(url('tabungan/create')); ?>">
    <button class="detail2 btn btn-sm btn-outline btn-success pull-right" style="margin-right: 10px">
        <i class="fa fa-plus-circle" style="margin-right: 5px"></i> Tambah Transaksi
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
    <div class="col-xs-12 col-sm-12">
        <?php if(!empty($tabungan[0])): ?>
    <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover" id="tbltabungan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Transaksi</th>
                    <th>Norek</th>
                    <th>Nasabah</th>
                    <th>Debit</th>
                    <th>Kredit</th>
                    <th>Saldo</th>
                    <th>Keterangan</th>
                    <th>Tgl. Transaksi</th>
                    <th>Diproses oleh</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0;?>
            <?php $__currentLoopData = $tabungan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $i++;?>
                <tr>
                    <td><?php echo e($i); ?></td>
                    <td><?php echo e($item->trx_code); ?></td>
                    <td><a href="<?php echo e(url('nasabah', $item->getnasabah->id)); ?>" target="_blank"><?php echo e($item->norek); ?></a></td>
                    <td><a href="<?php echo e(url('nasabah', $item->getnasabah->id)); ?>" target="_blank"><?php echo e($item->getnasabah->nama_depan); ?> <?php echo e($item->getnasabah->nama_belakang); ?></a></td>
                    <td><?php echo e(empty($item->debit)? "0" : $item->debit); ?></td>
                    <td><?php echo e(empty($item->kredit)? "0" : $item->kredit); ?></td>
                    <td><?php echo e(empty($item->saldo)? "0" : $item->saldo); ?></td>
                    <td><?php echo empty($item->keterangan)? "<i>Tidak ada keterangan</i>" : $item->keterangan; ?></td>
                    <td><?php echo e($item->created_at); ?></td>
                    <td><?php echo e(empty($item->createdby->first_name)?"": $item->createdby->first_name); ?> <?php echo e(empty($item->createdby->last_name)?"": $item->createdby->last_name); ?></td>
                    <td><a href="<?php echo e(url('tabungan/'.$item->id.'/print')); ?>" class="btn btn-outline btn-success btn-xs" target="_blank">Cetak Bukti</a>
                    <?php echo Form::open([
                        'method'=>'DELETE',
                        'url' => ['tabungan', $item->id],
                        'style' => 'display:inline',
                        'onsubmit' => 'return ConfirmDelete()'
                    ]); ?>

                        <?php echo Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']); ?>

                    <?php echo Form::close(); ?>

                    </td>
                    
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <div class="jumbotron">
                        <h1>Data Kosong ... </h1>
                        <p>Mohon maaf, tidak ada data transaksi tabungan untuk hari ini.</p>
                        <p><a href="<?php echo e(url('tabungan/create')); ?>" class="btn btn-primary btn-lg" role="button">Tambah Transaksi</a>
                        </p>
                    </div>
        <?php endif; ?>
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
        $('#submit').click(function(){
  //  alert('submitting');
    $('#formfield').submit();
});


         /* Init DataTables */
        var oTable = $('#tbltabungan').DataTable(
          {order: [ 8, 'desc' ]}
        );

       


    });


    function ConfirmDelete()
  {
  var x = confirm("Are you sure you want to delete?");
  if (x)
    return true;
  else
    return false;
  }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>