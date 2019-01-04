<?php $__env->startSection('title'); ?>
Work Order
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Manage Work Order
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php echo e(HTML::style('assets_back/css/plugins/dataTables/datatables.min.css')); ?>

<style type="text/css">
  div.container {
        width: 80%;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row wrapper wrapper-content">
  <div class="row ibox col-sm-12" style="min-height: 70vh">
    <div class=" col-sm-3">
      <div class="ibox-title">
        <h4>WO Detail</h4>
      </div>
      <div class="ibox-content" style="min-height: 65vh">
        <div class=row col-sm-12 col-xs-12">
          <h3 class="col-sm-12 col-xs-12" style="text-align: center"><?php echo ucwords(str_replace('work order', '', strtolower($node->name))) ;?></h3>
          <div class="col-sm-12" style="margin-bottom: 15px">
              <h5>Progress</h5>
              <h2><?php echo e(round(($node->pop_fin / $node->pop_ttl) * 100)); ?> %</h2>
              <div class="progress progress-mini">
                  <div style="width: <?php echo e(($node->pop_fin / 100) * $node->pop_ttl); ?>%;" class="progress-bar"></div>
              </div>
          </div>
          <div class="col-sm-12 col-xs-12">

            <small>
              <i class="fa fa-clock-o"></i>
              Last updated at <?php echo e($node->updated_at); ?> by <?php echo empty($node->updated_by)?"":$node->updatedby->first_name; ?> <?php echo empty($node->updated_by)?"":$node->updatedby->last_name; ?> <strong>
              </strong>
            </small>

             <p  style="margin-top: 15px">
                Status : <strong><?php echo e($node->getstatus->name); ?>  </strong>
              </p>
             <p>
                SBU : <strong><?php echo e($node->getsbu->name); ?> </strong>
              </p>
             <p >
                Code : <strong><?php echo e($node->code); ?>  </strong>
              </p>
             <p >
                Total Site : <strong><?php echo e($node->pop_ttl); ?> </strong></p>
              </p>

             <p >
                Total Assets : <strong><?php echo e(count($node->getasset)); ?> unit</strong>
              </p>
              <p >
                <strong>Date Start</strong> : </p><p><?php echo e(Carbon\Carbon::parse($node->datestart)->formatLocalized('%A, %d %B %Y')); ?>

              </p>
             <p >
                <strong>Date End</strong> : </p><p><?php echo e(Carbon\Carbon::parse($node->dateend)->formatLocalized('%A, %d %B %Y')); ?>

              </p>
          </div>
        </div>
      </div>
    </div>
     <div class=" col-sm-9">
      <div class="row ibox-title">
        <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
          <li class="">
            <a href="<?php echo e(url('workorder/'.$node->id.'/show')); ?>"><?php echo e($node->name); ?></a>
          </li>
        </ol>
        <a href="<?php echo e(url('workorder')); ?>">
          <button class="btn btn-sm btn-outline btn-warning pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
          </button>
        </a>
        <?php if(Sentinel::getUser()->hasAccess(['workorder.edit'])): ?>
        <a href="<?php echo e(url('workorder/'.$node->id.'/edit')); ?>" class="btn btn-sm btn-outline btn-primary pull-right" style="margin-right: 10px">  <i class="fa fa-edit" ></i> Edit</a>
        <?php endif; ?>
      </div>
      <div class="row ibox-content" style="min-height: 65vh">
        <div class="tabs-container" id="dataTabs">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#pop" class="dtl" data-status="true">POP List</a></li>
            <li class=""><a data-toggle="tab" href="#asset"  class="attr" d data-status="false">Assets List</a></li>
            <li class=""><a data-toggle="tab" href="#log"  class="attr" d data-status="false">Log</a></li>
          </ul>
          <div class="tab-content">
              <div id="pop" class="tab-pane active">
                <div class="col-xs-12 col-sm-12" style="margin-top: 20px">
                  <table class="table-responsive table table-striped table-bordered table-hover  dataTables-example"  id="editable">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>POP Code</th>
                        <th>POP Name</th>
                        <th>Region</th>
                        <th>Province</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $x = 0 ?>
                      <?php $__currentLoopData = $pops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $x++ ?>
                        <tr>
                          <td><?php echo e($x); ?></td>
                          <td><?php echo e($pop->code); ?></td>
                          <td><?php echo e($pop->name); ?></td>
                          <td><?php echo empty($pop->getregion->name)? "No Data" : $pop->getregion->name; ?>

                          </td>
                          <td><?php echo empty($pop->getprovince->name)? "No Data" : $pop->getprovince->name; ?>

                          </td>
                          <td><?php echo empty($pop->updatedby->first_name)? "": $pop->updatedby->first_name; ?> <?php echo empty($pop->updatedby->last_name)? "" : $pop->updatedby->last_name; ?></td>
                          <td><?php echo e($pop->created_at); ?></td>
                          <td>
                            <?php if(($pop->asset_ttl - $pop->asset_fin) == 0 && $pop->asset_ttl != 0): ?>
                            <a href="#" class="btn btn-xs btn-primary">Complete</a>
                            <?php else: ?>
                            <a href="#" class="btn btn-xs btn-warning">Not Complete</a>
                            <?php endif; ?>
                          </td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>

                  </table>
                </div>
              </div>
              <div id="asset" class="tab-pane">
                <div class="table-responsive" style="margin-top: 20px">
                   <table class=" table table-striped table-bordered table-hover" id="asset_table">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>QR Code</th>
                        <th>Brand</th>
                        <th style="width: 30%">Model</th>
                        <th>SBU</th>
                        <th>POP</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Complete</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
              <div id="log" class="tab-pane">
                <div class="table-responsive" style="margin-top: 20px">
                  <table class="table table-striped table-bordered table-hover  dataTables-example" id="editable3">
                    <thead>

                      <tr>
                        <th>No.</th>
                        <th>Description</th>
                        <th>Created By</th>
                        <th>Created At</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $x = 0 ?>
                      <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $x++ ?>
                        <tr>
                          <td><?php echo e($x); ?></td>
                          <td><?php echo e($log->description); ?></td>
                          <td><?php echo e($log->user()->first()->first_name.' '.$log->user()->first()->last_name); ?></td>
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
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<?php echo e(HTML::script('assets_back/js/plugins/dataTables/datatables.min.js')); ?>

<!-- Page-Level Scripts -->
<script>

    $(document).ready(function(){
      $('.dataTables-example').DataTable( {
          responsive: true,
          "dom": 'T<"clear">lfrtip'
      } );
    });

    $('#asset_table').DataTable({
       processing: true,
       serverSide: true,
       ajax: '/assetwoapi?sbu=<?php echo e($node->sbu_id); ?>',
       columns: [
           {data: 'rownum', name: 'rownum'},
           {data: 'qr_code', name: 'qr_code'},
           {data: 'brand', name: 'brand'},
           {data: 'model', name: 'model'},
           {data: 'sbu', name: 'sbu'},
           {data: 'pop', name: 'pop'},
           {data: 'username', name: 'username'},
           {data: 'created_at', name: 'created_at'},
           {data: 'action', name: 'action', orderable: false, searchable: false}
       ],

       order: [ 0, 'asc' ]


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