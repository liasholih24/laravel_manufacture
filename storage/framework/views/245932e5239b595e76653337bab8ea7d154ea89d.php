<?php $__env->startSection('style'); ?>
  <?php echo e(HTML::style('assets_back/css/plugins/dataTables/datatables.min.css')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
Nasabah
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Kelola Data Nasabah
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
            Nasabah
        </li>
    </ol>
    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-sm btn-outline btn-primary pull-right">
        <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
    </a>
    <a href="<?php echo e(url('nasabah/create')); ?>">
    <button class="detail2 btn btn-sm btn-outline btn-success pull-right" style="margin-right: 10px">
        <i class="fa fa-plus-circle" style="margin-right: 5px"></i> Tambah Baru
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
    <div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="nasabah_table">
<thead>
    <tr>
        <th>ID</th>
        <th>No. Rekening</th>
        <th>Nama Nasabah</th>
        <th>Unit</th>
        <th>Last Update</th>
        <th>Updated By</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
<?php $i = 0 ?>
<?php $__currentLoopData = $nasabah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php $i++ ?>
    <tr data-id="1<?php echo e($item->id); ?>">
        <td><?php echo e($item->id); ?></td>
        <td><a href="<?php echo e(url('nasabah', $item->id)); ?>"><?php echo e($item->norek); ?></a></td>
        <td><?php echo e($item->nama_depan); ?> <?php echo e($item->nama_belakang); ?></td>
        <td><?php echo e(empty($item->getgroup->name)?"": $item->getgroup->name); ?></td>
        <td><?php echo e($item->updated_at); ?></td>
        <td><?php echo empty($item->updatedby->first_name)?"": $item->updatedby->first_name; ?> <?php echo empty($item->updatedby->last_name)?"": $item->updatedby->last_name; ?></td>
        <td>
              <?php if( $item->status == "3"): ?>
        <a href="#" class="btn btn-xs btn-success btn-outline active">Active</a>
        <?php else: ?>
        <a href="#" class="btn btn-xs btn-default btn-outline">Inactive</a>
        <?php endif; ?>
        </td>
        <td>
    <?php if(Sentinel::getUser()->hasAccess(['nasabah.destroy'])): ?>
    <a href="<?php echo e(url('nasabah/' . $item->id . '/edit')); ?>" class="btn btn-outline btn-primary btn-xs">Edit</a>
    <?php endif; ?> 
    <?php if(Sentinel::getUser()->hasAccess(['nasabah.show'])): ?>
    <a href="<?php echo e(url('nasabah/' . $item->id . '')); ?>" class="btn btn-outline btn-primary btn-xs">View</a>
    <?php endif; ?>    
        </td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tfoot>
</table>
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
        var oTable = $('#nasabah_table').DataTable(
          {order: [ 1, 'asc' ]}
        );

        $('#submit').click(function(){
        $('#formfield').submit();
        });

    });


</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>