<?php $__env->startSection('title'); ?>
Satuan
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Kelola Data Satuan
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
        <ol class="breadcrumb col-sm-8 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
          <li class="active">
              <a class="detail2" href="">
                Satuan
              </a>
          </li>
          </ol>
          <a href="<?php echo e(url()->previous()); ?>" class="btn btn-sm btn-outline btn-primary pull-right">
              <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
          </a>
          <?php if(Sentinel::getUser()->hasAccess(['satuan.create'])): ?>
          <a href="<?php echo e(url('satuan/create')); ?>">
          <button class="detail2 btn btn-sm btn-outline btn-success pull-right" style="margin-right: 10px">
              <i class="fa fa-plus-circle" style="margin-right: 5px"></i>
                  Tambah Satuan

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
            <table class="table table-striped table-bordered table-hover" id="tblsatuan">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Nilai Standar</th>
                    <th>Last Update</th>
                    <th>Updated By</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $satuan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item->id); ?></td>
                    <td><?php echo e($item->code); ?></td>
                    <td><?php echo e($item->name); ?></td>
                    <td><?php echo e($item->standard_value); ?> <?php echo e(empty($item->getbasis->name)? $item->code : $item->getbasis->code); ?></td>
                   
                    <td><?php echo empty($item->updated_at)? "<i>No Updated</i>" : $item->updated_at; ?></td>
                    <td><?php echo empty($item->updatedby->first_name)?"<i>No Updated</i>": $item->updatedby->first_name; ?> <?php echo empty($item->updatedby->last_name)?"<i></i>" : $item->updatedby->last_name; ?></td>
                    <td>
                    <?php if( $item->status == "3"): ?>
                    <a href="#" class="btn btn-xs btn-success btn-outline active">Active</a>
                   <?php else: ?>
                  <a href="#" class="btn btn-xs btn-default btn-outline">Inactive</a>
                  <?php endif; ?>
                </td>
                    <td>
                        <a href="<?php echo e(url('satuan/' . $item->id . '/edit')); ?>" class="btn btn-primary btn-outline btn-xs">Edit</a> 
                        <a href="<?php echo e(url('satuan/' . $item->id . '')); ?>" class="btn btn-primary  btn-outline btn-xs">View</a> 
                       
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

<script type="text/javascript">
    $(document).ready(function(){
        var oTable = $('#tblsatuan').DataTable();


    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>