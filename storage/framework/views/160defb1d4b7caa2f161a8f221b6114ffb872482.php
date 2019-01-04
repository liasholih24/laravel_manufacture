<?php $__env->startSection('title'); ?>
Location
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Manage Location
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
        <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
          <li class="active">
              <a class="detail2" href="">
                  <strong><?php echo empty($tables->first()->title)?"Location": $tables->first()->title; ?></strong>
              </a>
          </li>
                    </ol>
          <a href="<?php echo e(url()->previous()); ?>" class="btn btn-sm btn-outline btn-warning pull-right">
              <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
          </a>

              <?php if(empty($tables->first()->title)): ?>
              <a href="<?php echo e(url('location/create')); ?>">
              <?php else: ?>
              <a href="<?php echo e(url('location/'.$tables->first()->depth.'/create')); ?>">
              <?php endif; ?>
            <?php if(Sentinel::getUser()->hasAccess(['location.create'])): ?> 
          <button class="detail2 btn btn-sm btn-outline btn-primary pull-right" style="margin-right: 10px">
              <i class="fa fa-plus-circle" style="margin-right: 5px"></i>
                  Add <?php echo empty($tables->first()->title)?"Location": $tables->first()->title; ?>

          </button>
            <?php endif; ?>
          </a>
          <?php if($tables->first()->depth == "1"): ?>
          <a href="<?php echo e(url('locations/province')); ?>">
          <button class="detail2 btn btn-sm btn-outline btn-info pull-right" style="margin-right: 10px">
              <i class="fa fa-list" style="margin-right: 5px"></i>
                  View Province
          </button>
          </a>
          <?php endif; ?>
          <?php if($tables->first()->depth == "0"): ?>
          <a href="<?php echo e(url('location')); ?>">
          <button class="detail2 btn btn-sm btn-outline btn-info pull-right" style="margin-right: 10px">
              <i class="fa fa-list" style="margin-right: 5px"></i>
                  View City
          </button>
          </a>
          <?php endif; ?>
          <select class="select2_demo_1 form-control" style="width:255px;margin-right: 10px;" onchange="if (this.value) window.location.href=this.value">
						<option value="<?php echo e(url('location')); ?>">Select Province</option>
						<?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e(url('location/' . $filter->id . '/filter')); ?>" <?php if ($filter->id == $id) echo ' selected="selected"'; ?>>
							<?php echo e($filter->name); ?>

            </option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>

    </div>
  <div class="col-xs-12 col-sm-12 ibox-content row" style="min-height:65vh;">
    <?php $__currentLoopData = ['danger', 'warning', 'success', 'info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(Session::has('alert-' . $msg)): ?>
        <div class="alert alert-<?php echo e($msg); ?> alert-dismissable">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          <?php echo e(Session::get('alert-' . $msg)); ?>.
        </div>
        <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <div class="table-responsive">

<table class="table table-striped table-bordered table-hover" id="editable">
<thead>
    <tr>
        <th>No.</th>
        <th>Code</th>
        <th><?php echo empty($tables->first()->title)?"Name": $tables->first()->title; ?></th>
        <th>Capital</th>
        <?php if(!empty($tables->first())): ?>
          <?php if($tables->first()->depth == "0"): ?>
        <th>Total City</th>
          <?php endif; ?>
          <?php if($tables->first()->depth != "0"): ?>
        <th>Province</th>
          <?php endif; ?>
        <?php endif; ?>
        <th>Description</th>
        <th>Last Update</th>
        <th>Updated By</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
  <?php $i = 0?>
  <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <?php $i++ ?>
  <tr>
      <td><?php echo e($i); ?></td>
      <td><?php echo e($table->kode); ?></td>
      <td><?php echo e($table->name); ?></td>
      <td><?php echo e($table->capital); ?></td>
      <?php if($table->depth == "0"): ?>
      <td><?php echo e(count($table->children()->get())); ?> City</td>
      <?php endif; ?>
      <?php if($table->depth != "0"): ?>
      <td><?php echo e($table->parent()->get()->first()->name); ?></td>
      <?php endif; ?>
      <td><?php echo empty($table->desc)?"<i>No Description</i>":$table->desc; ?></td>
      <td><?php echo e($table->updated_at); ?></td>
      <td><?php echo e($table->updatedby->first_name); ?> <?php echo e($table->updatedby->last_name); ?></td>
      <td>
        <?php if( $table->status == "3"): ?>
        <a href="#" class="btn btn-xs btn-primary btn-outline active">Active</a>
        <?php else: ?>
        <a href="#" class="btn btn-xs btn-default btn-outline">Inactive</a>
        <?php endif; ?>
      </td>
      <td>


        <?php if(Sentinel::getUser()->hasAccess(['location.show'])): ?>
        <a href="<?php echo e(url('location/' . $table->id . '/show')); ?>" class="btn btn-primary btn-outline btn-xs">View</a>
        <?php endif; ?>

        <?php if(Sentinel::getUser()->hasAccess(['location.edit'])): ?>
        <a href="<?php echo e(url('location/' . $table->id . '/edit')); ?>" class="btn btn-outline btn-primary btn-xs">Edit</a>
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
        var oTable = $('#editable').DataTable(
          {order: [ 6, 'desc' ]}
        );




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