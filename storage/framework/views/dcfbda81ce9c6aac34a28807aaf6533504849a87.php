<?php $__env->startSection('title'); ?>
Transfer
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="wrapper wrapper-content">
    					<div class="row detail_content3">
    	<div class="col-lg-12 detail_content2" style="background-color: white"><style>
    						.ibox { margin: 1px 2px 0px 0px !important }
    						.ibox.float-e-margins{ margin: 0px 2px !important}
    						</style>
          <div class="row ibox-title">
       <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
            <li class="">
                <a href="<?php echo e(url('%%routeGroup%%%%crudName%%')); ?>">  Transfer
            </li>
            /
            <li class="">
                    <a href="#">
                        Edit Transfer
                    </a>
            </li>
        </ol>
                <a href="<?php echo e(url('%%routeGroup%%%%crudName%%')); ?>">
                <button class="btn btn-sm btn-outline btn-warning pull-right">
                <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
                </button>
                </a>
        </div>
    <div class="row ibox-content" style="min-height: 65vh; ">
    	<div class="col-xs-12 col-sm-12">
        <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover dataTables-example">
          <thead>
              <tr>
                  <th>ID.</th> <th>Gdg From</th><th>Gdg To</th><th>Qty Kg</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td><?php echo e($transfer->id); ?></td> <td> <?php echo e($transfer->gdg_from); ?> </td><td> <?php echo e($transfer->gdg_to); ?> </td><td> <?php echo e($transfer->qty_kg); ?> </td>
              </tr>
          </tbody>
      </table>
      </div>
      </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>