<?php $__env->startSection('style'); ?>
  <?php echo e(HTML::style('assets_back/css/plugins/dataTables/datatables.min.css')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
Customer
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="wrapper wrapper-content">
    <div class="row detail_content3">
    <div class="col-lg-3 detail_content">
<div class="ibox float-e-margins">
    <div class="ibox-title row" style="height: 54px">
        <h5>Customer</h5>
    </div>
    <div class="ibox-content row" style="display: block;">
            <div>
              <table class="table dataTables-example2" >
              <thead>
                  <tr>
                      <th>Area</th>
                  </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><a href="<?php echo e(url('customer/'.$area->parent_id.'/area')); ?>"><?php echo e($area->lokasi->name); ?></a> (<?php echo e($area->total); ?>)</td>
                </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>

            </div>
    </div>
</div>
</div>
    <div class="col-lg-9 detail_content2" style="min-height: 600px; background-color: white">
  <style>
                        .ibox { margin: 1px 2px 0px 0px !important }
                        .ibox.float-e-margins{ margin: 0px 2px !important}
                        </style>
    <div class="ibox-title row">
        <ol class="breadcrumb col-sm-7 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
            <li class="active">
                <a class="detail2">
                    Customer
                </a>
            </li>
                    </ol>
          <a href="<?php echo e(url()->previous()); ?>" class="btn btn-sm btn-outline btn-warning pull-right">
              <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
          </a>
          <a href="<?php echo e(url('customer/create')); ?>">
          <button class="detail2 btn btn-sm btn-outline btn-primary pull-right" style="margin-right: 10px">
              <i class="fa fa-plus-circle" style="margin-right: 5px"></i> Add New
          </button>
        </a>
    </div>
  <div class="col-xs-12 col-sm-12 ibox-content row">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover dataTables-example" >
      <thead>

          <tr>
              <th>No.</th><th>No POP</th><th>Name</th><th>Area</th><th>Last Update</th><th>Update By</th><th>Status</th><th>Actions</th>
          </tr>
      </thead>
      <tbody>
      <?php $x = 0 ?>
      <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php $__currentLoopData = $customer->getDescendantsAndSelf(array('id','parent_id','name','depth'))->toHierarchy(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php $x++ ?>
          <tr>
            <td><?php echo e($x); ?></td>
            <td><?php echo e($relation->lokasi->name); ?></td>
            <td><a href="#"> <?php echo e($relation->name); ?></a></td>
              <td>
                  <a href="<?php echo e(url('customer/' . $relation->id . '/edit')); ?>" class="btn btn-outline btn-primary btn-xs">Update</a>
                  <?php echo Form::open([
                      'method'=>'DELETE',
                      'url' => ['customer', $relation->id],
                      'style' => 'display:inline',
                      'onsubmit' => 'return ConfirmDelete()'
                  ]); ?>

                      <?php echo Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']); ?>

                  <?php echo Form::close(); ?>

              </td>
          </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tfoot>
      </table>
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
        $('.dataTables-example').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

                {extend: 'print',
                 customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                }
                }
            ]

        });

        /* Init DataTables */
        var oTable = $('#editable').DataTable();

        /* Apply the jEditable handlers to the table */
        oTable.$('td').editable( '../example_ajax.php', {
            "callback": function( sValue, y ) {
                var aPos = oTable.fnGetPosition( this );
                oTable.fnUpdate( sValue, aPos[0], aPos[1] );
            },
            "submitdata": function ( value, settings ) {
                return {
                    "row_id": this.parentNode.getAttribute('id'),
                    "column": oTable.fnGetPosition( this )[2]
                };
            },

            "width": "90%",
            "height": "100%"
        } );


    });

    function fnClickAddRow() {
        $('#editable').dataTable().fnAddData( [
            "Custom row",
            "New row",
            "New row",
            "New row",
            "New row" ] );

    }

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