<?php $__env->startSection('title'); ?>
Work Order
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Manage Work Order
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
        <ol class="breadcrumb col-sm-7 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
          <li class="active">
              <a class="detail2" href="">
                Work Order
              </a>
          </li>
          </ol>
          <a href="<?php echo e(url('dashboard')); ?>" class="btn btn-sm btn-outline btn-warning pull-right">
              <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
          </a>
          <?php if($filters) { ;?>
          <?php if(Sentinel::getUser()->hasAccess(['workorder.create'])): ?>
              <a href="<?php echo e(url('workorder/create')); ?>">
                <button class="detail2 btn btn-sm btn-outline btn-primary pull-right" style="margin-right: 10px">
                    <i class="fa fa-plus-circle" style="margin-right: 5px"></i>
                        Add Work Order

                </button>
              </a>
          <?php endif; ?>
            <?php }else{ ;?>
              <?php $now = date('Y-m-d') ; $finish = $tables[0]->c_status; $end = date('Y-m-d',strtotime ($tables[0]->dateend));?>
              <?php if(($end < $now ) || ($finish == 1)){ ;?>
                 <a href="<?php echo e(url('workorder/create')); ?>">
                  <button class="detail2 btn btn-sm btn-outline btn-primary pull-right" style="margin-right: 10px">
                      <i class="fa fa-plus-circle" style="margin-right: 5px"></i>
                          Add Work Order
                  </button>
                </a>
              <?php };?>
            <?php };?>
          <?php if($filters) { ;?>
            <select class="select2_demo_1 form-control pull-right" onchange="if (this.value) window.location.href=this.value" style="width:260px;margin-right: 10px;">
  						<option value="<?php echo e(url('workorder')); ?>">Select SBU</option>
  						<?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  						<option value="<?php echo e(url('workorder/' . $filter->sbu_id . '/filter')); ?>" <?php if ($filter->sbu_id == $id) echo ' selected="selected"'; ?>>
  							<?php echo e($filter->getsbu->name); ?>

              </option>
  						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  					</select>
          <?php };?>

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
      <table class="table  table-responsive table-striped table-bordered table-hover dataTables-example dataTable">
        <thead>
            <tr>
                <th data-priority="1">No.</th>
                <th style="width: 30% !important; text-align: center" data-priority="2">Name</th>
                <th style="width: 20% !important" data-priority="3">Date Start</th>
                <th style="width: 20% !important" data-priority="4">Date End</th>
                <th style="width: 30% !important" data-priority="5">SBU</th>
                <th>Total Site</th>
                <th>Total Asset</th>
                <th data-priority="7" style="text-align: center">Progress</th>
                <th>Last Updated</th>
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
              <td style="width: 30% !important"><?php echo e($table->name); ?></td>
              <td style="width: 20% !important"><?php echo e(Carbon\Carbon::parse($table->datestart)->format('d-m-Y')); ?></td>
              <td style="width: 20% !important" ><?php echo e(Carbon\Carbon::parse($table->dateend)->format('d-m-Y')); ?></td>
              <td style="width: 20% !important"><?php echo e($table->getsbu->name); ?></td>
              <td><?php echo e($table->pop_ttl); ?></td>
              <td><?php echo e(count($table->getasset)); ?></td>
              <!--
              <td><?php echo e(($table->pop_fin / 100) * $table->pop_ttl); ?>%</td>
              -->
              <td  style="text-align: center">
                <h3><?php echo e(round(($table->pop_fin / $table->pop_ttl) * 100 )); ?> %</h3>
                <?php if( $table->pop_fin == $table->pop_ttl): ?>
                  <a href="#" class="btn btn-xs btn-primary">Completed</a>
                <?php else: ?>
                <a href="#" class="btn btn-xs btn-warning">Not Complete</a>
                <?php endif; ?>

              </td>
              <td><?php echo e(Carbon\Carbon::parse($table->updated_at)->format('d-m-Y h:i:s')); ?></td>
              <td><?php echo e($table->updatedby->first_name); ?> <?php echo e($table->updatedby->last_name); ?></td>
              <td>
                <?php if( $table->status == "3"): ?>
                <a href="#" class="btn btn-xs btn-primary btn-outline active">Active</a>
                <?php else: ?>
                <a href="#" class="btn btn-xs btn-default btn-outline">Inactive</a>
                <?php endif; ?>
              </td>
              <td>
                <?php if(Sentinel::getUser()->hasAccess(['workorder.show'])): ?>
                <a href="<?php echo e(url('workorder/' . $table->id . '/show')); ?>" class="btn btn-primary btn-outline btn-xs">View</a>
                <?php endif; ?>
                <?php if( $table->parent_id != "1"): ?>
                <?php if(Sentinel::getUser()->hasAccess(['workorder.edit'])): ?>
                <a href="<?php echo e(url('workorder/' . $table->id . '/edit')); ?>" class="btn btn-outline btn-primary btn-xs">Edit</a>
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
      $('.dataTables-example').dataTable({
        responsive: true,
        "dom": 'T<"clear">lfrtip',
            "lengthMenu": [[5, 10, 25, 50, 100, 250, 500], [5, 10, 25, 50, 100, 250, 500, "All"]],
         destroy: true,
      });
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