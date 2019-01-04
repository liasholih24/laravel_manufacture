<?php $__env->startSection('title'); ?>
SID Data
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Manage SID Data
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
        <ol class="breadcrumb col-sm-5 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
          <li class="active">
              <a class="detail2" href="">
                <strong><?php echo empty($tables->first()->title)?"Customer":$tables->first()->title; ?></strong>
              </a>
          </li>
          </ol>
          <a href="<?php echo e(url()->previous()); ?>" class="btn btn-sm btn-outline btn-warning pull-right">
              <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
          </a>
          <?php if($id == '0'): ?>
          <?php if(Sentinel::getUser()->hasAccess(['sid.create'])): ?>
          <a href="<?php echo e(url('sid/0/create')); ?>">
          <button class="detail2 btn btn-sm btn-outline btn-primary pull-right" style="margin-right: 10px">
              <i class="fa fa-plus-circle" style="margin-right: 5px"></i>
                  Add Customer
          </button>
          </a>
          <a href="<?php echo e(url('sid/0/import')); ?>">
          <button class="detail2 btn btn-sm btn-outline btn-primary pull-right" style="margin-right: 10px">
              <i class="fa fa-upload" style="margin-right: 5px"></i>
                  Import Customer
          </button>
          </a>
          <?php endif; ?>
          <?php else: ?>
          <?php if(Sentinel::getUser()->hasAccess(['sid.create'])): ?>
          <a href="<?php echo e(url('sid/1/create')); ?>">
          <button class="detail2 btn btn-sm btn-outline btn-primary pull-right" style="margin-right: 10px">
              <i class="fa fa-plus-circle" style="margin-right: 5px"></i>
                  Add SID
          </button>
          </a>
          <?php endif; ?>
          <a href="<?php echo e(url('sidcustomer')); ?>">
          <button class="detail2 btn btn-sm btn-outline btn-primary pull-right" style="margin-right: 10px">
              <i class="fa fa-users" style="margin-right: 5px"></i>
                  View Customer
          </button>
          </a>
          <?php if(Sentinel::getUser()->hasAccess(['sid.create'])): ?>
          <a href="<?php echo e(url('sid/1/import')); ?>">
          <button class="detail2 btn btn-sm btn-outline btn-primary pull-right" style="margin-right: 10px">
              <i class="fa fa-upload" style="margin-right: 5px"></i>
                  Import SID
          </button>
          </a>
          <?php endif; ?>
          <?php endif; ?>
          <select class="form-control select2_demo_1" style="max-width:265px;margin-right: 10px;" onchange="if (this.value) window.location.href=this.value">
            <option value="<?php echo e(url('sidcustomer')); ?>">Filter by Customer</option>
            <?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e(url('sid/' . $filter->id . '/filter')); ?>" <?php if ($filter->id == $id) echo ' selected="selected"'; ?>>
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
<table class="table table-responsive table-striped table-bordered table-hover dataTables-example dataTable" id="sid_table">

<thead>
    <tr>
        <th>No.</th>
        <th>SID</th>
        <th>Customer Name</th>
        <th>Revenue</th>
        <th>Description</th>
        <th>Last Updated</th>
        <th>Updated By</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
</thead>
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
        /* Init DataTables */

        $('#sid_table').DataTable({
           processing: true,
           serverSide: true,
           ajax: '/sidapi?data=<?=$data?>&customer=<?=$customer?>',
           columns: [
               {data: 'rownum', name: 'rownum'},
               {data: 'sid', name: 'sid'},
               {data: 'name', name: 'name'},
               {data: 'revenue', name: 'revenue'},
               {data: 'desc', name: 'desc'},
               {data: 'updated_at', name: 'updated_at'},
               {data: 'username', name: 'username'},
               {data: 'sts', name: 'sts'},
               {data: 'action', name: 'action', orderable: false, searchable: false}
           ],
           responsive: {
               details: {
                   type: 'column'
               }
           },
           columnDefs: [ {
               className: 'control',
               orderable: false,
               targets:   0
           } ],
           order: [ 5, 'desc' ]

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