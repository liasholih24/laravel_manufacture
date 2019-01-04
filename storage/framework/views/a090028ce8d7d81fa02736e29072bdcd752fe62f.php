
<?php $__env->startSection('title'); ?>
SBU/Site
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Manage SBU/Site
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
                 <strong>SBU</strong>
              </a>
          </li>
                    </ol>
          <a href="<?php echo e(url()->previous()); ?>" class="btn btn-sm btn-outline btn-warning pull-right">
              <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
          </a>
          <?php if(Sentinel::getUser()->hasAccess(['sbu.create'])): ?>
        <a href="<?php echo e(url('sbu/0/0/create')); ?>">
          <button class="detail2 btn btn-sm btn-outline btn-primary pull-right" style="margin-right: 10px">
              <i class="fa fa-plus-circle" style="margin-right: 5px"></i>
                  Add SBU
          </button>
        </a>
        <?php endif; ?>
        <?php if(Sentinel::getUser()->hasAccess(['site.index'])): ?>
        <a href="<?php echo e(url('sbu')); ?>">
        <button class="detail2 btn btn-sm btn-outline btn-primary pull-right" style="margin-right: 10px">
            <i class="fa fa-list" style="margin-right: 5px"></i> View Site
        </button>
      </a>
      <?php endif; ?>
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

      <table class="table table-responsive table-striped table-bordered table-hover dataTables-example dataTable" id="sbu_table">

<thead>
    <tr>
        <th>No.</th>
        <th>SBU ID</th>
        <th>SBU</th>
        <th>Updated At</th>
        <th>Updated By</th>
        <th>Action</th>

    </tr>
</thead>
<tbody>
  <?php 
    $i=1;
   ?>
  <?php $__currentLoopData = $sbulists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($i); ?></td>
        <td><?php echo e($list->code); ?></td>
        <td><?php echo e($list->name); ?></td>

        <td><?php echo e($list->updated_at); ?></td>
        <td><?php echo e($list->updated_by); ?></td>
        <td>
          <?php if(Sentinel::getUser()->hasAccess(['sbu.edit'])): ?>
          <a href="<?php echo e(url('sbu/'.$list->id.'/editsbu')); ?>" class="btn btn-outline btn-primary btn-xs">Edit</a>
          <?php endif; ?>
          <?php if(Sentinel::getUser()->hasAccess(['sbu.show'])): ?>
          <a href="<?php echo e(url('sbu/'.$list->id.'/showsbu')); ?>" class="btn btn-outline btn-primary btn-xs">Show</a>
          <?php endif; ?>
        </td>
    </tr>
    <?php 
      $i++;
     ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
<tbody>
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


    });

          $('#sbu_table').DataTable();

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