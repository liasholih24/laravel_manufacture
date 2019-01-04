<?php $__env->startSection('title'); ?>
Transaksi
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Sedekah Sampah
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
            Sedekah
        </li>
    </ol>
    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-sm btn-outline btn-primary pull-right">
        <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
    </a>
    <a href="<?php echo e(url('sedekah/create')); ?>">
    <button class="detail2 btn btn-sm btn-outline btn-success pull-right" style="margin-right: 10px">
        <i class="fa fa-plus-circle" style="margin-right: 5px"></i> Tambah Sedekah
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
        <?php if(!empty($sedekah[0])): ?>
    <div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="table1">
<thead>
    <tr>
        <th>ID</th>
        <th>Kode Transaksi</th>
        <th>Donatur</th>
        <th>Total(kg)</th>
        <th>Total(Rp.)</th>
        <th>Keterangan</th>
        <th>Tgl. Transaksi</th>
        <th>Diproses oleh</th>

        <th>Actions</th>
    </tr>
</thead>
<tbody>
<?php $i = 0 ?>
<?php $__currentLoopData = $sedekah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php $i++ ?>
    <tr>
        <td><?php echo e($item->id); ?></td>
        <td><?php echo e($item->code); ?></td>
        <td><?php echo e($item->perusahaan); ?></td>
        <td><?php echo e($item->total_kg); ?></td>
        <td><?php echo e($item->total_rp); ?></td>
        <td><?php echo empty($item->keterangan)?"<i>Tidak ada keterangan</i>": $item->keterangan; ?></td>
        <td><?php echo e($item->updated_at); ?></td>
        <td><?php echo e(empty($item->createdby->first_name)?"": $item->createdby->first_name); ?> <?php echo e(empty($item->createdby->last_name)?"": $item->createdby->last_name); ?></td>
        <td>
            <a href="<?php echo e(url('sedekah/' . $item->id . '/print')); ?>" class="btn btn-outline btn-success btn-xs" target="_blank">Cetak Bukti</a>
            <a href="<?php echo e(url('sedekah/' . $item->id . '/edit')); ?>" class="btn btn-outline btn-primary btn-xs" target="_blank">Edit</a>
            
        </td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tfoot>
</table>
        </div>
        <?php else: ?>
         <div class="jumbotron">
                        <h1>Data Kosong ... </h1>
                        <p>Mohon maaf, tidak ada data transaksi sedekah untuk bulan ini.</p>
                        <p><a href="<?php echo e(url('sedekah/create')); ?>" class="btn btn-primary btn-lg" role="button">Tambah Sedekah</a>
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
       
        /* Init DataTables */
        var oTable = $('#table1').DataTable();

    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>