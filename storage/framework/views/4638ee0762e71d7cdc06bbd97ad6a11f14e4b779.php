<?php $__env->startSection('title'); ?>
Referensi Sampah
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Kelola Data Sampah 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php echo e(HTML::style('assets_back/css/plugins/select2/select2.min.css')); ?>

<?php echo e(HTML::style('assets_back/css/plugins/dataTables/datatables.min.css')); ?>

<?php echo e(HTML::style('assets_back/css/plugins/chosen/chosen.css')); ?>

<style>
.select2-selection .select2-selection--single{
border: 1px solid #f8ac59 !important;
}
</style>
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
        <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
          <li class="active">
              <a class="detail2" href="">
                <strong>Data Sampah</strong>
              </a>
          </li>
         </ol>
          <a href="<?php echo e(url()->previous()); ?>" class="btn btn-sm btn-outline btn-primary pull-right">
              <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
          </a>
          <?php if(Sentinel::getUser()->hasAccess(['sampah.create'])): ?>
          <a href="<?php echo e(url('sampah/1/create')); ?>">
          <button class="detail2 btn btn-sm btn-outline btn-success pull-right" style="margin-right: 10px">
              <i class="fa fa-plus-circle" style="margin-right: 5px"></i>
                  Tambah
          </button>
          </a>
          <?php endif; ?>
          <a href="<?php echo e(url('kategori')); ?>">
          <button class="detail2 btn btn-sm btn-outline btn-info pull-right" style="margin-right: 10px">
              <i class="fa fa-list" style="margin-right: 5px"></i>
                  Kategori Sampah
          </button>
          </a>
          <select class="form-control chosen-select" style="max-width:265px;margin-right: 10px;" onchange="if (this.value) window.location.href=this.value">
						<option value="<?php echo e(url('sampah')); ?>">Pilih Kategori</option>
						<?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e(url('sampah/' . $filter->id . '/filter')); ?>" <?php if ($filter->id == $id) echo ' selected="selected"'; ?>>
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

<table class="table table-striped table-bordered table-hover" id="editable">
<thead>
    <tr>
        <th>No.</th>
        <th>Kode</th>
        <th>Nama</th>
        <th>Nilai Jual</th>
        <th>Nilai Beli</th>
        <th>Type</th>
        <th>Deskripsi</th>
        <th>Last Update</th>
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
      <td><?php echo e($table->code); ?></td>
      <td><?php echo e($table->name); ?></td>
      <td><?php echo e($table->sell_price); ?><?php echo empty($table->getsatuan->code)?"<i>No Data</i>":"/".$table->getsatuan->code; ?></td>
      <td><?php echo e($table->buy_price); ?><?php echo empty($table->getsatuan->code)?"<i>No Data</i>":"/".$table->getsatuan->code; ?></td>
      
      <td><?php echo empty($table->gettype->name)?"<i>Tidak ada Data</i>": $table->gettype->name; ?></td>
      <td><?php echo empty($table->note)?"<i>Tidak ada deskripsi</i>":$table->note; ?></td>
     <td><?php echo e($table->updated_at); ?></td>
      <td><?php echo empty($table->updatedby->first_name)?"": $table->updatedby->first_name; ?> <?php echo empty($table->updatedby->last_name)?"": $table->updatedby->last_name; ?></td>
      <td>
        <?php if( $table->status == "3"): ?>
        <a href="#" class="btn btn-xs btn-success btn-outline active">Active</a>
        <?php else: ?>
        <a href="#" class="btn btn-xs btn-default btn-outline">Inactive</a>
        <?php endif; ?>
      </td>
      <td>

        <?php if(Sentinel::getUser()->hasAccess(['sampah.show'])): ?>
        <a href="<?php echo e(url('sampah/' . $table->id . '/show')); ?>" class="btn btn-primary btn-outline btn-xs">View</a>
        <?php endif; ?>

        <?php if(Sentinel::getUser()->hasAccess(['sampah.edit'])): ?>
        <a href="<?php echo e(url('sampah/' . $table->id . '/edit')); ?>" class="btn btn-outline btn-primary btn-xs">Edit</a>
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

<?php echo e(HTML::script('assets_back/js/plugins/chosen/chosen.jquery.js')); ?>

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function(){
      var config = {
          '.chosen-select'           : {search_contains: true },
          '.chosen-select-deselect'  : {allow_single_deselect:true},
          '.chosen-select-no-single' : {disable_search_threshold:10},
          '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
          '.chosen-select-width'     : {width:"95%"}
          }
      for (var selector in config) {
          $(selector).chosen(config[selector]);
      }
        /* Init DataTables */
        var oTable = $('#editable').DataTable(
          {order: [ 4, 'desc' ]}
        );

$('#submit').click(function(){
  //  alert('submitting');
    $('#formfield').submit();
});

    });

		$(".select2_demo_1").select2();

</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>