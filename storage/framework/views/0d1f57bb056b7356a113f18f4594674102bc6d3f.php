<?php $__env->startSection('title'); ?>
Status
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Manage Status
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php echo e(HTML::style('assets_back/css/plugins/select2/select2.min.css')); ?>

<?php echo e(HTML::style('assets_back/css/plugins/dataTables/datatables.min.css')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="wrapper wrapper-content">
    <div class="row detail_content3">
    <div class="col-lg-12 detail_content2" style="background-color: white">
  <style>
                        .ibox { margin: 1px 2px 0px 0px !important }
                        .ibox.float-e-margins{ margin: 0px 2px !important}
                        </style>
    <div class="ibox-title row">
        <ol class="breadcrumb col-sm-8 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
          <li class="active">
              <a class="detail2" href="">
                Status
              </a>
          </li>
          </ol>
          <a href="<?php echo e(url()->previous()); ?>" class="btn btn-sm btn-outline btn-warning pull-right">
              <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
          </a>
          <?php if(Sentinel::getUser()->hasAccess(['status.create'])): ?>
          <a href="<?php echo e(url('status/create')); ?>">
          <button class="detail2 btn btn-sm btn-outline btn-primary pull-right" style="margin-right: 10px">
              <i class="fa fa-plus-circle" style="margin-right: 5px"></i>
                  Add Status

          </button>
          </a>
          <?php endif; ?>
        <select class="select2_demo_1 form-control" style="width:200px;margin-right: 10px;" onchange="if (this.value) window.location.href=this.value">
          <option value="<?php echo e(url('status')); ?>">Select Status</option>
          <?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e(url('status/' . $filter->id . '/filter')); ?>" <?php if ($filter->id == $id) echo ' selected="selected"'; ?>>
            <?php echo e($filter->name); ?>

          </option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

    </div>
  <div class="col-xs-12 col-sm-12 ibox-content row" style="min-height:65vh;">
    <div class="table-responsive">

<table class="table table-striped table-bordered table-hover" id="editable">
<thead>
    <tr>
        <th>No.</th>
        <th>Name</th>
        <th>Parent</th>
        <th>Desrciption</th>
        <th>Last Update</th>
        <th>Updated By</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
  <?php $i = 0?>
  <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <?php $i++ ?>
  <tr>
      <td><?php echo e($i); ?></td>
      <td><?php echo e($table->name); ?></td>
      <td><?php echo e($table->parent()->first()->name); ?></td>
      <td><?php echo empty($table->desc)?"<i>No Description</i>":$table->desc; ?></td>
     <td><?php echo e($table->updated_at); ?></td>
      <td><?php echo e($table->updatedby->first_name); ?> <?php echo e($table->updatedby->last_name); ?></td>
      <td>
        <?php if( $table->status == "3"): ?>
        <a href="#" class="btn btn-xs btn-primary btn-outline active">Active</a>
        <?php else: ?>
        <a href="#" class="btn btn-xs btn-default btn-outline">Inactive</a>
        <?php endif; ?>

        <?php if(Sentinel::getUser()->hasAccess(['status.show'])): ?>
        <a href="<?php echo e(url('status/' . $table->id . '/show')); ?>" class="btn btn-primary btn-outline btn-xs">View</a>
        <?php endif; ?>
        <?php if( $table->parent_id != "1"): ?>
        <?php if(Sentinel::getUser()->hasAccess(['status.edit'])): ?>
        <a href="<?php echo e(url('status/' . $table->id . '/edit')); ?>" class="btn btn-outline btn-primary btn-xs">Edit</a>
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>


<?php echo e(HTML::script('assets_back/js/plugins/dataTables/datatables.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/select2/select2.full.min.js')); ?>


<!-- Page-Level Scripts -->
<script>
    $(document).ready(function(){


        /* Init DataTables */
        var oTable = $('#editable').DataTable();



    });


		$(".select2_demo_1").select2();
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