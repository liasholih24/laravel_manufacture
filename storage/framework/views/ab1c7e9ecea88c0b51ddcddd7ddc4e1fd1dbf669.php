<?php $__env->startSection('title'); ?>
<?php echo e($node->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
<?php echo e($node->subtitle); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
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
      <div class="row ibox-title">
        <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
          <?php if($node->depth == 0): ?>
          <li class="">
            <a href="<?php echo e(url('organization/'. $node->id .'/show')); ?>">
              <?php echo e($node->name); ?>

            </a>
          </li>
          <?php endif; ?>

          <?php if($node->depth > 1): ?>
          <li class="">
            <a href="<?php echo e(url('organization/'.$node->root()->id.'/show')); ?>"><?php echo e($node->root()->name); ?></a>
          </li><?php endif; ?>
          <?php if($node->depth != 0): ?>
          <li class="">
            <a href="<?php echo e(url('organization/'.$node->parent()->get()->first()->id.'/show')); ?>"><?php echo e($node->parent()->get()->first()->name); ?></a>
          </li>
          <li class="">
            <a href="<?php echo e(url('organization/'.$node->id.'/show')); ?>"><?php echo e($node->name); ?></a>
          </li>
          <?php endif; ?>
        </ol>
        <a href="<?php echo e(url()->previous()); ?>">
          <button class="btn btn-sm btn-outline btn-warning pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
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

        <h2><?php echo e($node->name); ?></h2>
        <small>
          <i class="fa fa-clock-o"></i>
          Last updated at <?php echo e($node->updated_at); ?> by <?php echo empty($node->updated_by)?"":$node->updatedby->first_name; ?> <?php echo empty($node->updated_by)?"":$node->updatedby->last_name; ?><strong>
          </strong>
        </small>
        <div class="row" style="padding-top: 10px">
          <div class="col-md-12">
            <a id="pilihDescendant" class="btn btn-sm btn-outline btn-primary">  <i class="fa <?php echo e($node->depthicon); ?>"></i> <?php echo e($node->depthname); ?></a>
            <a id="pilihLog" class="btn btn-sm btn-outline btn-primary">  <i class="fa fa-book"></i> Logs</a>
            <div class="pull-right">
              <?php if($node->id != 1): ?>
              <?php echo Form::open([
                'method'=>'DELETE',
                'url' => ['organization', $node->id],
                'style' => 'display:inline',
                'onsubmit' => 'return ConfirmDelete()'
              ]); ?>

              <?php echo Form::close(); ?>

              <?php endif; ?>
              <?php if(Sentinel::getUser()->hasAccess(['organization.edit'])): ?>
              <a href="<?php echo e(url('organization/'.$node->id.'/edit')); ?>" class="btn btn-sm btn-outline btn-primary">  <i class="fa fa-edit" ></i> Edit</a>
              <?php endif; ?>
              <?php if($node->depth >= 1): ?>
                <?php if(Sentinel::getUser()->hasAccess(['organization.create'])): ?>
              <a href="<?php echo e(url('organization/'.$node->id.'/create')); ?>" class="btn btn-sm btn-outline btn-primary">
                  <i class="fa fa-plus" ></i> Add New
              </a>
                <?php endif; ?>
               <?php elseif($node->depth == 0): ?>
                 <?php if(Sentinel::getUser()->hasAccess(['organization.create'])): ?>
               <a href="<?php echo e(url('organization/'.$node->id.'/create')); ?>" class="btn btn-sm btn-outline btn-primary">
                   <i class="fa fa-plus" ></i> Add Sub
               </a>
                  <?php endif; ?>
                <?php endif; ?>

            </div>
            </a>
          </div>

          <div class="col-md-12">
            
                  <div id="tabDescendant">
                    <br>
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover" id="editable">
                        <thead>

                          <tr>
                              <th>No.</th>
                              <th>Code</th>
                              <th>Name</th>
                              <th>Desc</th>
                              <th>Total Sub</th>
                              <th>Last Update</th>
                              <th>Updated By</th>
                              <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i=0 ?>
                          <?php $__currentLoopData = $nodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php $i++ ?>
                            <tr>
                                <td><?php echo e($i); ?></td>
                                <td><?php echo e($item->code); ?></td>
                                <td><?php echo e($item->name); ?></td>
                                <td><?php echo empty($item->desc)? "<i>No Description</i>" :  $item->desc; ?></td>
                                <td><?php echo e(count($item->children()->get())); ?></td>
                                <td><?php echo e($item->updated_at); ?></td>
                                <td><?php echo e($item->updatedby->first_name); ?> <?php echo e($item->updatedby->last_name); ?></td>
                                <td>
                                  <?php if( $item->status == 3): ?>
                                  <a href="#" class="btn btn-xs btn-primary btn-outline active">Active</a>
                                  <?php else: ?>
                                  <a href="#" class="btn btn-xs btn-default btn-outline">Inactive</a>
                                  <?php endif; ?>
                                  <?php if( $item->depth != 3): ?>
                                  <?php if(Sentinel::getUser()->hasAccess(['organization.show'])): ?>
                                  <a href="<?php echo e(url('organization/' . $item->id . '/show')); ?>" class="btn btn-primary btn-outline btn-xs">View</a>
                                  <?php endif; ?>
                                  <?php endif; ?>

                                  <?php if(Sentinel::getUser()->hasAccess(['organization.edit'])): ?>
                                  <a href="<?php echo e(url('organization/' . $item->id . '/edit')); ?>" class="btn btn-outline btn-primary btn-xs">Edit</a>
                                  <?php endif; ?>
                                </td>
                            </tr>

                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                      </table>
                    </div>
                  </div>

            <div id="tabLog">
              <br>
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="editable2">
                  <thead>

                    <tr>
                      <th>No.</th>
                      <th>Description</th>
                      <th>Action By</th>
                      <th>Action At</th>
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
        // Tab
        $('#tabDescendant').show();
        $('#tabLog').hide();
        $('#tabLeaves').hide();
        $('#pilihDescendant').addClass("active");
        $('#pilihLeaves').hide();

        // Klik Tab

        $('#pilihDescendant').click(function(){
          $('#tabDetail').hide();
          $('#tabDescendant').show();
          $('#tabLog').hide();
          $('#tabLeaves').hide();


          $('#pilihLeaves').show();

          $('#pilihDescendant').addClass("active");
          $('#pilihDetail').removeClass("active");
          $('#pilihLog').removeClass("active");
          $('#pilihLeaves').removeClass("active");
        });
        $('#pilihLeaves').click(function(){
          $('#tabDetail').hide();
          $('#tabDescendant').hide();
          $('#tabLeaves').show();
          $('#tabLog').hide();


          $('#pilihLeaves').show();

          $('#pilihLeaves').addClass("active");
          $('#pilihDescendant').removeClass("active");
          $('#pilihDetail').removeClass("active");
          $('#pilihLog').removeClass("active");
        });

        $('#pilihLog').click(function(){
          $('#tabDetail').hide();
          $('#tabDescendant').hide();
          $('#tabLog').show();
          $('#tabLeaves').hide();

          $('#pilihLeaves').hide();
            $('#pilihLog').addClass("active");
            $('#pilihDetail').removeClass("active");
            $('#pilihDescendant').removeClass("active");
        });

        /* Init DataTables */
        var oTable = $('#editable').DataTable();
        var oTable = $('#editable2').DataTable({order:[[3,'desc']]});







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