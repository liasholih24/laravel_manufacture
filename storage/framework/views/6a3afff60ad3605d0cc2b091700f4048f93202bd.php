<?php $__env->startSection('title'); ?>
Brand
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Manage Brand
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php echo e(HTML::style('assets_back/css/plugins/select2/select2.min.css')); ?>

<?php echo e(HTML::style('assets_back/css/plugins/dataTables/datatables.min.css')); ?>

<?php echo e(HTML::style('assets_back/css/plugins/chosen/chosen.css')); ?>

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
                  <strong>Brands</strong>
              </a>
          </li>
          </ol>
          <a href="<?php echo e(url()->previous()); ?>" class="btn btn-sm btn-outline btn-warning pull-right">
              <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
          </a>
          <?php if(Sentinel::getUser()->hasAccess(['brand.create'])): ?>
          <a href="<?php echo e(url('brand/create')); ?>">  
          <button class="detail2 btn btn-sm btn-outline btn-primary pull-right" style="margin-right: 10px">
              <i class="fa fa-plus-circle" style="margin-right: 5px"></i>
                  Add Brand
          </button>
          </a>
          <?php endif; ?>
          <?php if(Sentinel::getUser()->hasAccess(['templates.index'])): ?>
          <a href="<?php echo e(url('templates')); ?>">
          <button class="detail2 btn btn-sm btn-outline btn-info pull-right" style="margin-right: 10px">
              <i class="fa fa-list" style="margin-right: 5px"></i>
                  Templates
          </button>
        </a>
        <?php endif; ?>
        <?php if(Sentinel::getUser()->hasAccess(['model.index'])): ?>
        <a href="<?php echo e(url('brand')); ?>">
        <button class="detail2 btn btn-sm btn-outline btn-info pull-right" style="margin-right: 10px">
            <i class="fa fa-list" style="margin-right: 5px"></i>
                Model
        </button>
      </a>
      <?php endif; ?>


    </div>
  <div class="col-xs-14 col-sm-14 ibox-content row" style="min-height:65vh;">
    <?php $__currentLoopData = ['danger', 'warning', 'success', 'info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(Session::has('alert-' . $msg)): ?>
        <div class="alert alert-<?php echo e($msg); ?> alert-dismissable">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          <?php echo e(Session::get('alert-' . $msg)); ?>.
        </div>
        <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div class="table-responsive">

      <table class="table table-responsive table-striped table-bordered table-hover dataTable" id="brand_table">
<thead>
    <tr>
        <th>No.</th>
        <th>Abbreviation</th>
        <th>Name</th>
        <th>Desrciption</th>
        <th>Last Update</th>
        <th>Updated By</th>
        <th>Status</th>
        <th>Actions</th>
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

    });

    $('#brand_table').DataTable({
       processing: true,
       serverSide: true,
       ajax: '/brandindexapi',
       columns: [
           {data: 'rownum', name: 'rownum'},
           {data: 'code', name: 'code'},
           {data: 'brand', name: 'brand'},
           {data: 'desc', name: 'desc'},
           {data: 'updated_at', name: 'updated_at'},
           {data: 'username', name: 'username'},
           {data: 'status', name: 'status'},
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
       order: [ 4, 'desc' ]

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