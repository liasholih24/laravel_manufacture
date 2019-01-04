<?php $__env->startSection('title'); ?>
POP
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
            <a href="<?php echo e(url('#')); ?>">
              <?php echo e($pop->name); ?>

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
        <h2><?php echo e($pop->name); ?></h2>
        <small>
          <i class="fa fa-clock-o"></i>
          Last updated at <?php echo e($pop->updated_at); ?> by <strong>
          </strong>
        </small>
        <div class="row" style="padding-top: 10px">
          <div class="col-md-12">
            <a id="pilihDetail" class="btn btn-sm btn-outline btn-primary">
            <i class="fa fa-info-circle"></i> Detail</a>
            <a id="pilihBuilding" class="btn btn-sm btn-outline btn-primary">  <i class="fa fa-globe"></i> Model/Type</a>
            <a id="pilihLog" class="btn btn-sm btn-outline btn-primary">  <i class="fa fa-book"></i> Logs</a>
            <div class="pull-right">
              <?php if($pop->id != 1): ?>
              <?php echo Form::open([
                'method'=>'DELETE',
                'url' => ['sbu', $pop->id],
                'style' => 'display:inline',
                'onsubmit' => 'return ConfirmDelete()'
              ]); ?>

              <button type="submit" class="btn btn-sm btn-outline btn-danger"><i class="fa fa-times-circle"></i> Delete</button>
              <?php echo Form::close(); ?>

              <?php endif; ?>
              <a href="<?php echo e(url('sbu/'.$pop->id.'/edit')); ?>" class="btn btn-sm btn-outline btn-primary">  <i class="fa fa-edit" ></i> Edit</a>

              <a href="<?php echo e(url('sbu/'.$pop->id.'/create')); ?>" class="btn btn-sm btn-outline btn-primary">  <i class="fa fa-plus" ></i> Add New</a>

            </div>
            </a>
          </div>
          <div class="col-md-12">
            <div id="tabDetail">
              <br/>
              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Reg Name</p>
                  <p class="col-sm-8 col-xs-9 row">: <strong><?php echo e($pop->code); ?> </strong></p>
                </div>
              </div>
              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Name</p>
                  <p class="col-sm-8 col-xs-9 row">: <strong><?php echo e($pop->name); ?> </strong></p>
                </div>
              </div>
              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">City/Region</p>
                  <p class="col-sm-8 col-xs-9 row">: <?php echo e($pop->getregion->name); ?> </p>
                </div>
              </div>
              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Province</p>
                  <p class="col-sm-8 col-xs-9 row">: <?php echo e($pop->getprovince->name); ?> </p>
                </div>
              </div>
              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Description</p>
                  <p class="col-sm-8 col-xs-9 row">:  <?php echo e($pop->desc); ?> </p>
                </div>
              </div>

                  </div>
                  <div id="tabBuilding">
                    <br>
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover dataTables-example2" >
                        <thead>

                          <tr>
                              <th>No.</th>
                              <th>Code</th>
                              <th>Name</th>
                              <th>City/Region</th>
                              <th>Province</th>
                              <th>Last Update</th>
                              <th>Updated By</th>
                              <th>Actions</th>
                          </tr>
                        </thead>


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
        // Tab
        $('#tabBuilding').hide();
        $('#tabLog').hide();

        $('#pilihDetail').addClass("active");

        // Klik Tab
        $('#pilihModules').click(function(){
          $('#tabDetail').hide();
          $('#tabBuilding').hide();
          $('#tabLog').hide();

          $('#pilihBuilding').removeClass("active");
          $('#pilihDetail').removeClass("active");
          $('#pilihLog').removeClass("active");

        });
        $('#pilihBuilding').click(function(){
          $('#tabDetail').hide();
          $('#tabBuilding').show();
          $('#tabLog').hide();

          $('#pilihBuilding').addClass("active");
          $('#pilihDetail').removeClass("active");
          $('#pilihLog').removeClass("active");
        });
        $('#pilihDetail').click(function(){
          $('#tabDetail').show();
          $('#tabBuilding').hide();
          $('#tabLog').hide();

          $('#pilihDetail').addClass("active");
          $('#pilihBuilding').removeClass("active");
          $('#pilihLog').removeClass("active");
        });
        $('#pilihLog').click(function(){
          $('#tabDetail').hide();
          $('#tabBuilding').hide();
          $('#tabLog').show();
            $('#pilihLog').addClass("active");
            $('#pilihDetail').removeClass("active");
            $('#pilihBuilding').removeClass("active");
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