<?php $__env->startSection('title'); ?>
<?php echo e($title); ?> Data
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Import Data
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php echo e(HTML::style('assets_back/css/plugins/select2/select2.min.css')); ?>

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
          <li class="">
            <a href="<?php echo e(url('#')); ?>"><?php echo e($title); ?></a>
          </li>
          <li class="active">
            <a href="<?php echo e(url('#')); ?>">Import</a>
          </li>
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
        <h2>Import <?php echo e($title); ?> Data</h2>
        <small>
          <i class="fa fa-file-excel-o"></i>
          Import Excel Data (*xls,*xlsx)
          </strong>
        </small>
        <div class="row" style="padding-top: 10px">
          <div class="col-md-12">
            <a id="pilihDetail" class="btn btn-sm btn-outline btn-primary">
            <i class="fa fa-list"></i> Import Data</a>
            <a id="pilihLog" class="btn btn-sm btn-outline btn-primary">  <i class="fa fa-book"></i> Logs</a>

            </a>
          </div>
          <div class="col-md-12">
            <div id="tabDetail">
              <br/>

          <!--    <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="<?php echo e(URL::to('importExcel')); ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
          -->
          <?php echo Form::open(['url' => 'importsid', 'class' => 'form-horizontal','style' => 'border: 1px solid #e2e2e2;border-width:1px;border-style:dashed;margin-top: 15px;padding: 10px;','enctype'=>'multipart/form-data']); ?>

          <input class="form-control" value="<?php echo e($id); ?>" type="hidden" name="id" />
      <div class="form-group">
    		<?php echo Form::label('datasid', 'File', ['class' => 'col-sm-1 control-label']); ?>

    		<div class="col-sm-5 <?php echo e($errors->has('datasid') ? 'has-error' : ''); ?>">
    			  <input class="form-control" type="file" name="datasid" />
    				<?php echo $errors->first('datasid', '<p class="help-block">:message</p>'); ?>

    		</div>
      </div>
      <div class="form-group">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-5">

			<button class="btn btn-outline btn-primary"><i class="fa fa-upload"></i> Import</button>
    </div>
        <?php echo Form::close(); ?>

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
                  <tbody>

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

        $('#tabLog').hide();
        $('#pilihDetail').addClass("active");



        $('#pilihDetail').click(function(){
          $('#tabDetail').show();
          $('#tabLog').hide();
          $('#tabDescendant').hide();

          $('#pilihDetail').addClass("active");
          $('#pilihLog').removeClass("active");
          $('#pilihDescendant').removeClass("active");
        });
        $('#pilihLog').click(function(){
          $('#tabDetail').hide();
          $('#tabLog').show();
          $('#tabDescendant').hide();

          $('#pilihLog').addClass("active");
            $('#pilihDetail').removeClass("active");
            $('#pilihDescendant').removeClass("active");
        });

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
        $('.dataTables-example2').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [

            ]

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