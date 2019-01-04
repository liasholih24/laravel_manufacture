<?php $__env->startSection('title'); ?>
Activity Log
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
View Activity of Users
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php echo e(HTML::style('assets_back/css/plugins/dataTables/datatables.min.css')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="wrapper wrapper-content">
    <div class="row detail_content3">
    <div class="col-lg-12 detail_content2" style="background-color: white">
    <div class="ibox-title row">
        <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
          <li class="active">
              <a class="detail2" href="">
                <strong>Log Activity</strong>
              </a>
          </li>
         </ol>
          <a href="<?php echo e(url()->previous()); ?>" class="btn btn-sm btn-outline btn-warning pull-right">
              <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
          </a>
    </div>
  <div class="col-xs-12 col-sm-12 ibox-content row" style="min-height:65vh;">
    <?php if(session()->has('alert-success')): ?>
        <div class="alert alert-success">
            <?php echo e(session()->get('alert-success')); ?>

        </div>
    <?php endif; ?>
    <div class="table-responsive">

<table class="table table-striped table-bordered table-hover" id="editable">
<thead>
    <tr>
        <th>No.</th>
        <th>Description</th>
        <th>Change</th>
        <th>Module</th>
        <th>Causer By</th>
        <th>Created At</th>
    </tr>
</thead>
<tbody>
  <?php $x = 0 ?>
  <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <?php $x++ ;
    $preg = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $log->subject_type);
    ?>
    <tr>
      <td><?php echo e($x); ?></td>
      <td><?php echo e($log->description); ?>

      </td>
      <td></td>
      <td><?php echo str_replace('App','', $preg); ?></td>
      <td><?php echo e($log->causer->first_name." ".$log->causer->last_name); ?></td>
      <td><?php echo e($log->created_at); ?></td>
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

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function(){

        /* Init DataTables */
        var oTable = $('#editable').DataTable(
         {order: [ 5, 'desc' ]}
        );

    });

</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>