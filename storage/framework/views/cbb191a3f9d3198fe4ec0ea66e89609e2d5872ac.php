<?php $__env->startSection('title'); ?>
Brand
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Manage Brand
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('style'); ?>
<?php echo e(HTML::style('assets_back/css/plugins/dataTables/datatables.min.css')); ?>

<?php $__env->stopSection(); ?>
<div class="wrapper wrapper-content">
  <div class="row detail_content3">
    <div class="col-lg-12 detail_content2" style="background-color: white">
      <style>
        .ibox { margin: 1px 2px 0px 0px !important }
        .ibox.float-e-margins{ margin: 0px 2px !important}
      </style>
      <div class="row ibox-title">
        <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
          <li class="">
            <a href="<?php echo e(url('brand/'. $node->parent_id .'/filter')); ?>">
               <?php echo e($node->name); ?>

            </a>
          </li>
        </ol>
        <a href="<?php echo e(url()->previous()); ?>">
          <button class="btn btn-sm btn-outline btn-warning pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
          </button>
        </a>
      </div>
      <div class="row ibox-content" style="min-height: 65vh; ">
        <h2><?php echo e($node->name); ?></h2>
        <small>
          <i class="fa fa-clock-o"></i>
          Last updated at <?php echo e($node->updated_at); ?> by <?php echo empty($node->updatedby->first_name)?"":$node->updatedby->first_name; ?> <?php echo empty($node->updatedby->last_name)?"":$node->updatedby->last_name; ?>


        </small>
        <div class="row" style="padding-top: 10px">
          <div class="col-md-12">
            <a id="pilihDetail" class="btn btn-sm btn-outline btn-primary">
            <i class="fa fa-info-circle"></i> Detail</a>
            <a id="pilihDescendant" class="btn btn-sm btn-outline btn-primary">  <i class="fa fa-list"></i> Attributes</a>
            <a id="pilihLog" class="btn btn-sm btn-outline btn-primary">  <i class="fa fa-book"></i> Logs</a>
            <div class="pull-right">
              <a href="<?php echo e(url('template')); ?>" class="btn btn-sm btn-outline btn-primary">  <i class="fa fa-edit" ></i> Edit</a>

              <a href="<?php echo e(url('templates/create')); ?>" class="btn btn-sm btn-outline btn-primary">
                  <i class="fa fa-plus" ></i> Add Attribute
              </a>

            </div>
            </a>
          </div>
          <div class="col-md-12">
            <div id="tabDetail">
              <br/>
              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Code</p>
                  <p class="col-sm-8 col-xs-9 row">: <strong><?php echo e($node->code); ?> </strong></p>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Name</p>
                  <p class="col-sm-8 col-xs-9 row">: <strong><?php echo e($node->name); ?> </strong></p>
                </div>
              </div>
              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Total Attributes</p>
                  <p class="col-sm-8 col-xs-9 row">: <?php echo empty($node->getchild)?"":count($node->getchild); ?></p>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Status</p>
                  <p class="col-sm-8 col-xs-9 row">: <?php echo e($node->getstatus->name); ?></p>
                </div>
              </div>
              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Created By</p>
                  <p class="col-sm-8 col-xs-9 row">:  <?php echo empty($node->updatedby->first_name)?"":$node->updatedby->first_name; ?> <?php echo empty($node->updatedby->last_name)?"":$node->updatedby->last_name; ?> </p>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Updated By</p>
                  <p class="col-sm-8 col-xs-9 row">:  <?php echo empty($node->updatedby->first_name)?"":$node->updatedby->first_name; ?> <?php echo empty($node->updatedby->last_name)?"":$node->updatedby->last_name; ?> </p>
                </div>
              </div>
              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Created At</p>
                  <p class="col-sm-8 col-xs-9 row">:  <?php echo e($node->created_at); ?>   </p>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Updated At</p>
                  <p class="col-sm-8 col-xs-9 row">:  <?php echo e($node->updated_at); ?> </p>
                </div>
              </div>
              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Notes</p>
                  <p class="col-sm-8 col-xs-9 row">: <?php echo e($node->desc); ?>  </p>
                </div>


              </div>

                  </div>
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
                                <td><?php echo e($item->desc); ?></td>
                                <td><?php echo e($item->updated_at); ?></td>
                                <td><?php echo empty($node->updatedby->first_name)?"":$node->updatedby->first_name; ?> <?php echo empty($node->updatedby->last_name)?"":$node->updatedby->last_name; ?></td>
                                <td>
                                  <?php if( $item->status == 3): ?>
                                  <a href="#" class="btn btn-xs btn-primary btn-outline active">Active</a>
                                  <?php else: ?>
                                  <a href="#" class="btn btn-xs btn-default btn-outline">Inactive</a>
                                  <?php endif; ?>
                                  <?php if( $item->depth != 1): ?>
                                  <?php if(Sentinel::getUser()->hasAccess(['brand.show'])): ?>
                                  <a href="<?php echo e(url('brand/' . $item->id . '/show')); ?>" class="btn btn-primary btn-outline btn-xs">View</a>
                                  <?php endif; ?>
                                  <?php endif; ?>

                                  <?php if(Sentinel::getUser()->hasAccess(['brand.edit'])): ?>
                                  <a href="<?php echo e(url('brand/' . $item->id . '/show')); ?>" class="btn btn-outline btn-primary btn-xs">Edit</a>
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
                <table class="table table-striped table-bordered table-hover dataTables-example2" >
                  <thead>

                    <tr>
                      <th>No.</th>
                      <th>Description</th>
                      <th>Created By</th>
                      <th>Created At</th>
                    </tr>
                  </thead>




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

      /* Init DataTables */
      var oTable = $('#editable').DataTable();

        // Tab
        $('#tabDescendant').hide();
        $('#tabLog').hide();
        $('#tabLeaves').hide();
        $('#pilihDetail').addClass("active");
        $('#pilihLeaves').hide();

        // Klik Tab
        $('#pilihModules').click(function(){
          $('#tabDetail').hide();
          $('#tabDescendant').hide();
          $('#tabLog').hide();
          $('#tabLeaves').hide();

          $('#pilihLeaves').hide();

          $('#pilihDescendant').removeClass("active");
          $('#pilihDetail').removeClass("active");
          $('#pilihLog').removeClass("active");

        });
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
        $('#pilihDetail').click(function(){
          $('#tabDetail').show();
          $('#tabDescendant').hide();
          $('#tabLog').hide();
          $('#tabLeaves').hide();
          $('#pilihLeaves').hide();

          $('#pilihDetail').addClass("active");
          $('#pilihDescendant').removeClass("active");
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