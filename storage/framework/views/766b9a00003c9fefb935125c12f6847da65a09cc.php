<?php $__env->startSection('style'); ?>
  <?php echo e(HTML::style('assets_back/css/plugins/dataTables/datatables.min.css')); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
Perusahaan
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Kelola Data Perusahaan/Bandar
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="wrapper wrapper-content">
	<div class="row detail_content3">
	     <div class="col-lg-12 detail_content2" style="background-color: white">
            <style>
						.ibox { margin: 1px 2px 0px 0px !important }
						.ibox.float-e-margins{ margin: 0px 2px !important}
						</style>
            <div class="row ibox-title">
   <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
        <li class="active">
            Data Perusahaan
        </li>
    </ol>
    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-sm btn-outline btn-primary pull-right">
        <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
    </a>
     <?php if(Sentinel::getUser()->hasAccess(['penadah.create'])): ?>
    <a href="<?php echo e(url('penadah/create')); ?>">
    <button class="detail2 btn btn-sm btn-outline btn-success pull-right" style="margin-right: 10px">
        <i class="fa fa-plus-circle" style="margin-right: 5px"></i> Tambah Baru
    </button>
  </a>
  <?php endif; ?>
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
<table class="table table-striped table-bordered table-hover" id="editable">
<thead>
    <tr>
        <th>No.</th>
        <th>Kode</th>
        <th>Nama</th>
        <th>Keterangan</th>
        <th>Last Updated</th>
        <th>Updated By</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
<?php $i = 0 ?>
<?php $__currentLoopData = $penadah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php $i++ ?>
    <tr>
        <td><?php echo e($item->id); ?></td>
        <td><a href="<?php echo e(url('penadah', $item->id)); ?>"><?php echo e($item->code); ?></a></td>
        <td><?php echo e($item->name); ?></td>
        <td><?php echo empty($item->notes)?"<i>Tidak ada keterangan</i>": $item->notes; ?></td>
        <td><?php echo e($item->updated_at); ?></td>
        <td><?php echo e($item->updatedby->first_name); ?> <?php echo e($item->updatedby->last_name); ?></td>
        <td>
        <?php if( $item->status == "3"): ?>
        <a href="#" class="btn btn-xs btn-success btn-outline active">Active</a>
        <?php else: ?>
        <a href="#" class="btn btn-xs btn-default btn-outline">Inactive</a>
        <?php endif; ?>
        </td>
        <td>
             <?php if(Sentinel::getUser()->hasAccess(['penadah.edit'])): ?>
            <a href="<?php echo e(url('penadah/' . $item->id . '/edit')); ?>" class="btn btn-outline btn-primary btn-xs">Edit</a>
            <?php endif; ?>
             <?php if(Sentinel::getUser()->hasAccess(['penadah.show'])): ?>
            <a href="<?php echo e(url('penadah/' . $item->id . '')); ?>" class="btn btn-outline btn-primary btn-xs">View</a>
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
        var oTable = $('#editable').DataTable(
          {order: [ 4, 'desc' ]}
        );
 

    });


</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>