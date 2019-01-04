<?php $__env->startSection('style'); ?>
  <?php echo e(HTML::style('assets_back/css/plugins/dataTables/datatables.min.css')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
Roles
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Modul untuk mengelola pengguna dalam sistem
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- -->
<div class="wrapper wrapper-content">
	<div class="row detail_content3">
	     <div class="col-lg-12 detail_content2" style="background-color: white"><style>
						.ibox { margin: 1px 2px 0px 0px !important }
						.ibox.float-e-margins{ margin: 0px 2px !important}
						</style>
            <div class="row ibox-title">
   <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
        <li class="active">
            Roles
        </li>
    </ol>
    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-sm btn-outline btn-warning pull-right">
        <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
    </a>
    <?php if(Sentinel::getUser()->hasAccess(['role.create'])): ?>
    <a href="<?php echo e(url('role/create')); ?>"><button data-url="roles" data-url2="roles" data-param="list" data-url3="add" data-lang="" class="detail2 btn btn-sm btn-outline btn-info pull-right" style="margin-right: 10px">
        <i class="fa fa-plus-circle" style="margin-right: 5px"></i> Add New Role
    </button>
    <?php endif; ?>
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
<table class="table table-striped table-bordered table-hover" id="editable">
<thead>
<tr>
    <th>No.</th>
    <th>Name</th>
    <th>Description</th>
    <th>Last Updated</th>
    <th>Updated By</th>
    <th>Status</th>
    <th>Action</th>
</tr>
</thead>
<tbody>
<?php $i = 0 ?>
<?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php $i++ ?>
<tr class="gradeX">
    <td><?php echo e($i); ?></td>
    <td><?php echo e($item->name); ?> </td>
    <td><?php echo empty($item->desc)? "<i>No Description</i>" : $item->desc; ?></td>
    <td><?php echo e($item->updated_at); ?></td>
    <td><?php echo empty($item->updated_by)? " " : $item->updatedby->first_name; ?> <?php echo empty($item->updated_by)? " " : $item->updatedby->last_name; ?> </td>
    <td>
      <?php if( $item->status == 1): ?>
      <a href="#" class="btn btn-xs btn-primary btn-outline active">Active</a>
      <?php else: ?>
      <a href="#" class="btn btn-xs btn-default btn-outline">Inactive</a>
      <?php endif; ?>
    </td>
    <td>
      <?php if(Sentinel::getUser()->hasAccess(['role.show'])): ?>
      <a href="<?php echo e(url('role/' . $item->id . '/show')); ?>" class="btn btn-xs btn-primary btn-outline">View</a>
      <?php endif; ?>
      <?php if($item->id != 1): ?>
      <?php if(Sentinel::getUser()->hasAccess(['role.edit'])): ?>
      <a href="<?php echo e(url('role/' . $item->id . '/edit')); ?>" class="btn btn-primary btn-xs btn-outline ">Edit</a>
      <?php endif; ?>
      <?php endif; ?>

    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
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
        var oTable = $('#editable').DataTable({order: [ 3, 'desc' ]});




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