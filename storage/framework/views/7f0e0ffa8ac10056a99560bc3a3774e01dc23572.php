<?php $__env->startSection('title'); ?>
<?php echo e(trans('Role')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
<?php echo e(trans('Manage Role of User')); ?>

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
            <li class="">
              <a href="<?php echo e(url('kategori')); ?>"> Role
            </li>
            /
            <li class="">
              <a href="#">
                <strong><?php echo e($role->name); ?></strong>
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
          <?php $__currentLoopData = ['danger', 'warning', 'success', 'info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if(Session::has('alert-' . $msg)): ?>
              <div class="alert alert-<?php echo e($msg); ?> alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <?php echo e(Session::get('alert-' . $msg)); ?>.
              </div>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <h2><?php echo e($role->name); ?></h2>
          <small>
            <i class="fa fa-clock-o"></i>
            Last updated at <?php echo e($role->updated_at); ?> by <?php echo empty($role->updatedby->first_name)? " " : $role->updatedby->first_name; ?> <?php echo empty($role->updatedby->last_name)? " " : $role->updatedby->last_name; ?> <strong>
            </strong>
          </small>
          <div class="row" style="padding-top: 10px">
            <div class="col-md-12">
              <a id="pilihDetail" class="btn btn-sm btn-outline btn-primary">
                <i class="fa fa-info-circle"></i> Detail</a>
              <a id="pilihModules" class="btn btn-sm btn-outline btn-primary">  <i class="fa fa-list"></i> Modules</a>
              <a id="pilihUsers" class="btn btn-sm btn-outline btn-primary">  <i class="fa fa-user"></i> Users</a>
              <a id="pilihLog" class="btn btn-sm btn-outline btn-primary">  <i class="fa fa-book"></i> Logs</a>
              <div class="pull-right">
                <?php if(Sentinel::getUser()->hasAccess(['role.edit'])): ?>
                <a href="<?php echo e(url('role/'.$role->id.'/edit')); ?>" class="btn btn-sm btn-outline btn-primary">  <i class="fa fa-edit" ></i> Edit</a>
              </div>
              </a>
              <?php endif; ?>
            </div>
            <div class="col-md-12">
              <div id="tabDetail">
                <br/>
                <div class="col-sm-12 col-xs-12 row">
                  <div class="col-sm-6 col-xs-12">
                    <p class="col-sm-4 col-xs-3 row">Name</p>
                    <p class="col-sm-8 col-xs-9 row">: <strong>
                      <?php echo e($role->name); ?></strong></p>
                            </div>
                  <div class="col-sm-6 col-xs-12">
                    <p class="col-sm-5 col-xs-3 row">
                        Status
                    </p>
                    <p class="col-sm-7 col-xs-9 row">
                      : <strong><?php echo e(($role->status == 1 ? 'Active' : 'Inactive')); ?></strong>
                    </p>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <p class="col-sm-4 col-xs-3 row">
                                    Date Creation
                                </p>
                                <p class="col-sm-8 col-xs-9 row">
                                    : <?php echo e($role->created_at); ?>

                                </p>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <p class="col-sm-5 col-xs-3 row">
                                    Created By
                                </p>
                                <p class="col-sm-7 col-xs-9 row">
                                    : <?php echo empty($role->created_by)? " " : $role->createdby->first_name; ?> <?php echo empty($role->created_by)? " " : $role->createdby->last_name; ?>

                                </p>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <p class="col-sm-4 col-xs-3 row">
                                    Last Update
                                </p>
                                <p class="col-sm-8 col-xs-9 row">
                                    :   <?php echo e($role->updated_at); ?>        </p>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <p class="col-sm-5 col-xs-3 row">
                                    Updated By
                                </p>
                                <p class="col-sm-7 col-xs-9 row">
                                    : <?php echo empty($role->updatedby->first_name)? " " : $role->updatedby->first_name; ?> <?php echo empty($role->updatedby->last_name)? " " : $role->updatedby->last_name; ?>   </p>
                            </div>
                            <p class="col-sm-12 col-xs-12">
                                Description :
                            </p>
                            <br>
                            <p class="col-sm-12 col-xs-12">
                              <?php echo empty($role->desc)? "<i>No Description</i>" : $role->desc; ?>

                            </p>
                                </div>
                    </div>
              <div id="tabModules">
                <br>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover" id="editable">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Module</th>
                        <th>Function</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php $x = 0 ?>
                      <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $x++ ?>
                      <?php

                      $first= array_values($action)[0];
                      $firstname =explode(".", $first)[0];
                      ?>
                      <tr>
                        <td><?php echo e($x); ?></td>
                        <td><?php echo e($firstname); ?></td>
                        <td>
                          <?php $__currentLoopData = $action; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(array_key_exists($act, $role->permissions)): ?>

                            <?php echo explode(".", $act)[1]; ?>

                            <?php endif; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                      <td>
                        <?php if(Sentinel::getUser()->hasAccess(['role.edit'])): ?>
                        <a href="<?php echo e(url('role/' . $role->id . '/'. $firstname .'/permissions')); ?>" class="btn btn-primary btn-xs btn-outline ">Permission</a>
                        <?php endif; ?>
                        </td>
                      </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div id="tabUsers">
                <br>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover dataTables-example2" >
                    <thead>

                      <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $x = 0 ?>
                      <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $x++ ?>
                        <tr>
                          <td><?php echo e($x); ?></td>
                          <td><?php echo e(empty($user2->usern->first_name)?"":$user2->usern->first_name); ?> <?php echo e(empty($user2->usern->last_name)?"": $user2->usern->last_name); ?> </td>
                          <td><?php echo e(empty($user2->usern->email)?"": $user2->usern->email); ?></td>

                          <td><?php echo e($user2->created_at); ?></td>
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


      var oTable = $('#editable').DataTable();

        // Tab
        $('#tabModules').hide();
        $('#tabUsers').hide();
        $('#tabLog').hide();

        $('#pilihDetail').addClass("active");

        // Klik Tab
        $('#pilihModules').click(function(){
          $('#tabDetail').hide();
          $('#tabModules').show();
          $('#tabUsers').hide();
          $('#tabLog').hide();

          $('#pilihModules').addClass("active");
          $('#pilihUsers').removeClass("active");
          $('#pilihDetail').removeClass("active");
          $('#pilihLog').removeClass("active");

        });
        $('#pilihUsers').click(function(){
          $('#tabDetail').hide();
          $('#tabModules').hide();
          $('#tabUsers').show();
          $('#tabLog').hide();

          $('#pilihUsers').addClass("active");
          $('#pilihModules').removeClass("active");
          $('#pilihDetail').removeClass("active");
          $('#pilihLog').removeClass("active");
        });
        $('#pilihDetail').click(function(){
          $('#tabDetail').show();
          $('#tabModules').hide();
          $('#tabUsers').hide();
          $('#tabLog').hide();

          $('#pilihDetail').addClass("active");
          $('#pilihUsers').removeClass("active");
          $('#pilihModules').removeClass("active");
          $('#pilihLog').removeClass("active");
        });
        $('#pilihLog').click(function(){
          $('#tabDetail').hide();
          $('#tabModules').hide();
          $('#tabUsers').hide();
          $('#tabLog').show();
            $('#pilihLog').addClass("active");
            $('#pilihDetail').removeClass("active");
            $('#pilihUsers').removeClass("active");
            $('#pilihModules').removeClass("active");
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