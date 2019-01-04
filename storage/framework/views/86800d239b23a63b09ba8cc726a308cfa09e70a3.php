<?php $__env->startSection('title'); ?>
Brand
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Manage Brand
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php echo e(HTML::style('assets_back/css/plugins/dataTables/datatables.min.css')); ?>

<?php echo e(HTML::style('assets_back/css/plugins/blueimp/css/blueimp-gallery.min.css')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row wrapper wrapper-content">
  <div class="row ibox col-sm-12" style="min-height: 70vh">
      <div class=" col-sm-3">
        <div class="ibox-title">Model Detail</div>
        <div class="ibox-content" style="min-height: 70vh">
        <a href="<?php echo e($node->url_image?asset($node->url_image):asset('images/noimage.jpg')); ?>" title="" data-gallery=""><img style="max-width:200px;min-width:200px" src="<?php echo e($node->url_image?asset($node->url_image):asset('images/noimage.jpg')); ?>"></a>
          <div class="col-sm-12" style="margin-top: 20px">
            <h3 style="text-align: center;"><?php echo empty($node->name)?"":$node->name; ?></h3>
          </div>
          <div class="col-sm-12">
            <p>
              Brand : <?php echo empty($parent->name)?"":$parent->name; ?>

            </p>
            <p>
              Model : <?php echo empty($node->name)?"":$node->name; ?>

            </p>
            <p>
              Material No : <?php echo empty($node->material)?"":$node->material; ?>

            </p>
            <p>
              Status : <strong><?php echo empty($node->getstatus->name)?'<font color="red">Not Set</font>':$node->getstatus->name; ?></strong>
            </p>

          </div>
        </div>
      </div>
      <div class="col-sm-9">
        <div class="row ibox-title">
          <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
            <?php if($node->parent_id != null): ?>
            <li class="">
              <a href="<?php echo e(url('brand/'. $node->parent_id .'/showbrand')); ?>">
                 <?php echo e($parent->name); ?>

              </a>
            </li>
            <?php endif; ?>
            <li class="active">
              <a href="<?php echo e(url('brand/'. $node->id .'/show')); ?>">
                 <?php echo e($node->name); ?>

              </a>
            </li>
          </ol>
            <a href="<?php echo e(url('asset')); ?>">
              <button class="btn btn-sm btn-outline btn-warning pull-right" style="margin-top: -5px">
                <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px; "></i> Back
              </button>
            </a>
        </div>
        <div class="row ibox-content" style="min-height: 70vh">
          <?php $__currentLoopData = ['danger', 'warning', 'success', 'info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if(Session::has('alert-' . $msg)): ?>
              <div class="alert alert-<?php echo e($msg); ?> alert-dismissable">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                            <?php echo e(Session::get('alert-' . $msg)); ?>.
              </div>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <div class="tabs-container" id="dataTabs">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#dtl" class="dtl" data-status="true">Detail Info</a></li>
                <li class=""><a data-toggle="tab" href="#attr"  class="attr" d data-status="false">Attributes</a></li>
                <li class=""><a data-toggle="tab" href="#log"  class="attr" d data-status="false">Logs</a></li>
                <?php if(Sentinel::getUser()->hasAccess(['brand.edit'])): ?>
                <a href="<?php echo e(url('brand/' .$node->id. '/edit')); ?>" style="margin-left:10px;" class="btn btn-sm btn-outline btn-primary pull-right">  <i class="fa fa-edit"></i> Edit</a>
                <a href="<?php echo e(url('brand/' .$node->id. '/attr')); ?>" class="btn btn-sm btn-outline btn-info pull-right">  <i class="fa fa-plus" ></i> Add Attribute</a>
                <?php endif; ?>
                </ul>
            <div class="tab-content">
                <div id="dtl" class="tab-pane active">
                  <div class="row col-sm-12" style="margin-top: 20px">

                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Brand</p>
                        <p class="col-sm-8 col-xs-9 row">:  <?php echo e($parent->name); ?>

                        </p>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Type</p>
                        <p class="col-sm-8 col-xs-9 row">: <?php echo e($node->gettype->name); ?>

                        </p>
                      </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Abbreviation</p>
                        <p class="col-sm-8 col-xs-9 row">:  <?php echo e($node->code); ?>

                        </p>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Category</p>
                        <p class="col-sm-8 col-xs-9 row">: <?php echo e($node->getcategory->name); ?>

                        </p>
                      </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Model</p>
                        <p class="col-sm-8 col-xs-9 row">:  <?php echo e($node->name); ?>

                        </p>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Asset Category</p>
                        <p class="col-sm-8 col-xs-9 row">: <?php echo e($node->getassetcategory->name); ?>

                        </p>
                      </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Material No</p>
                        <p class="col-sm-8 col-xs-9 row">: <?php echo empty($node->material)?'<strong><font color="red">Material Not Set</font></strong>':'<strong>'.$node->material.'</strong>'; ?>

                        </p>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Assets Value</p>
                        <p class="col-sm-8 col-xs-9 row">: <?php echo empty($node->investation)?'<strong><font color="red">Assets Value Not Set</font></strong>':'<strong>Rp. '.number_format($node->investation, 2, '.', ',').'</strong>'; ?>

                        </p>
                      </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Status</p>
                        <p class="col-sm-8 col-xs-9 row">: <?php echo e($node->getstatus->name); ?></p>
                      </div>
                      
                    </div>
                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Power</p>
                        <p class="col-sm-7 col-xs-9 row">: <strong><?php echo empty($node->power)?"No Power":$node->power; ?></strong></p>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">MPLS</p>
                        <p class="col-sm-8 col-xs-9 row">: <strong><?php echo empty($node->mpls_hierarchy)?"No MPLS":$node->mpls_hierarchy; ?></strong></p>
                      </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Rack Unit</p>
                        <p class="col-sm-7 col-xs-9 row">: <strong><?php echo empty($node->rack_unit)?"Not Set": $node->rack_unit." RU"; ?></strong></p>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Dimension</p>
                        <p class="col-sm-8 col-xs-9 row">: <?php echo e($node->length); ?> X <?php echo e($node->width); ?> X <?php echo e($node->height); ?>  </p>
                      </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Has License</p>
                        <p class="col-sm-7 col-xs-9 row">: <strong><?php echo ($node->license == 1 ? 'Yes' : 'No'); ?></strong></p>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Has Port</p>
                        <p class="col-sm-8 col-xs-9 row">: <strong> <?php echo empty($node->port)?"No":"Yes"; ?>  </strong></p>
                      </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Has Slot</p>
                        <p class="col-sm-7 col-xs-9 row">: <strong><?php echo empty($node->slot)?"No":"Yes"; ?></strong></p>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Has Source</p>
                        <p class="col-sm-8 col-xs-9 row">: <strong> <?php echo empty($node->source)?"No":"Yes"; ?>  </strong></p>
                      </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Created At</p>
                        <p class="col-sm-8 col-xs-9 row">:  <?php echo e($node->created_at); ?> </p>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Updated At</p>
                        <p class="col-sm-8 col-xs-9 row">:  <?php echo e($node->updated_at); ?> </p>
                      </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Created By</p>
                        <p class="col-sm-8 col-xs-9 row">:  <?php echo empty($node->created_by)?"":$node->createdby->first_name; ?> </p>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row">Updated By</p>
                        <p class="col-sm-8 col-xs-9 row">:  <?php echo empty($node->updated_by)?"":$node->updatedby->first_name; ?> </p>
                      </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-12 col-xs-12">
                        <h3 class="col-sm-10 col-xs-3 row">Notes about <?php echo e($node->name); ?></h3>
                      </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-12 col-xs-12">
                        <p class="col-sm-5 col-xs-3 row"><?php echo empty($node->desc)?"No Notes Data":$node->desc; ?></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="attr" class="tab-pane">
                  <div class="table-responsive" style="margin-top: 20px">
                    <table class="table table-striped table-bordered table-hover" id="editable1">
                      <thead>
                        <tr>
                            <th>No.</th>
                            <th>Attribute Name</th>
                            <th>Template Name</th>
                            <th>Value</th>
                            <th>Last Update</th>
                            <th>Updated By</th>
                            <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php $i=0 ?>
                        <?php $__currentLoopData = $nodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $i++ ?>
                          <tr>
                              <td><?php echo e($i); ?></td>
                              <td><?php echo empty($item->catAttr->name)? null : $item->catAttr->name; ?></td>
                              <td><?php echo empty($item->nameAttr->name) ? null : $item->nameAttr->name; ?></td>
                              <td><?php echo e($item->value); ?></td>
                              <td><?php echo e($item->updated_at); ?></td>
                              <td><?php echo empty($item->updatedby->first_name) ? null : $item->updatedby->first_name; ?> <?php echo empty($item->updatedby->last_name) ? null : $item->updatedby->last_name; ?></td>
                              <td>
                                <?php if(Sentinel::getUser()->hasAccess(['brand.edit'])): ?>
                                  <?php if($item->nameAttr->id != 1): ?>
                                <a href="<?php echo e(url('brand/' . $item->brand_id . '/' . $item->id . '/editattr')); ?>" class="btn btn-outline btn-primary btn-xs">Edit</a>
                                  <?php endif; ?>
                                  <?php endif; ?>
                              </td>
                          </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>


                    </table>
                  </div>
                </div>
                <div id="log" class="tab-pane">
                  <br>
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="editable2">
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
<?php echo e(HTML::script('assets_back/js/plugins/blueimp/jquery.blueimp-gallery.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/dataTables/datatables.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/select2/select2.full.min.js')); ?>

<!-- Page-Level Scripts -->
<script>

    $(document).ready(function(){
      /* Init DataTables */
      var oTable = $('#editable1').DataTable();
      var oTable = $('#editable2').DataTable({order: [ 3, 'desc' ]});
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