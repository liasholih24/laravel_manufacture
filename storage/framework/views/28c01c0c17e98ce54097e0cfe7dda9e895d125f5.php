<?php $__env->startSection('title'); ?>
Lokasi
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Preview
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
          <?php if($node->depth == 0): ?>
          <li class="">
            <a href="<?php echo e(url('organization/'. $node->parent_id .'/filter')); ?>">
              <?php echo e($node->first()->name); ?>

            </a>
          </li>
          <?php endif; ?>
          <?php if($node->depth != 0): ?>
          <?php if($node->depth > 1): ?> <li class="">
            <a href="<?php echo e(url('organization/'.$node->root()->id.'/show')); ?>"><?php echo e($node->root()->name); ?></a>
          </li><?php endif; ?>
          <li class="">
            <a href="<?php echo e(url('organization/'.$node->root()->id.'/show')); ?>"><?php echo e($node->parent()->get()->first()->name); ?></a>
          </li>
          <li class="">
            <a href="<?php echo e(url('organization/'.$node->root()->id.'/show')); ?>"><?php echo e($node->name); ?></a>
          </li>
          <?php endif; ?>
        </ol>
        <a href="<?php echo e(url()->previous()); ?>">
          <button class="btn btn-sm btn-outline btn-primary pull-right">
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
        <h2><?php echo e($node->name); ?></h2>
        <small>
          <i class="fa fa-clock-o"></i>
          Last updated at <?php echo e($node->updated_at); ?> by <?php echo empty($node->updated_by)?"":$node->updatedby->first_name; ?> <?php echo empty($node->updated_by)?"":$node->updatedby->last_name; ?> <strong>
          </strong>
        </small>
        <div class="row" style="padding-top: 10px">
          <div class="col-md-12">
            <a id="pilihDetail" class="btn btn-sm btn-outline btn-primary">
            <i class="fa fa-info-circle"></i> Detail</a>
            <a id="pilihLog" class="btn btn-sm btn-outline btn-primary">  <i class="fa fa-book"></i> Logs</a>
            <div class="pull-right">
             
              <?php if(Sentinel::getUser()->hasAccess(['lokasi.edit'])): ?>
              <a href="<?php echo e(url('lokasi/'.$node->id.'/edit')); ?>" class="btn btn-sm btn-outline btn-success">  <i class="fa fa-edit" ></i> Edit</a>
              <?php endif; ?>
              <?php if(Sentinel::getUser()->hasAccess(['lokasi.destroy'])): ?>
        <?php echo Form::open([
                            'method'=>'DELETE',
                            'url' => ['lokasi', $node->id],
                            'style' => 'display:inline',
                            'id'=>'formfield'
                        ]); ?>

                            <?php echo Form::button('<i class="fa fa-trash" ></i> Delete', ['class' => 'btn btn-sm btn-outline btn-danger',
                            'name' => 'btn', 'value' => 'Submit', 'id' => 'submitBtn', 'data-toggle' =>'modal', 'data-target' => '#confirm-submit' ]); ?>

                        <?php echo Form::close(); ?>


        <div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Konfirmasi
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data?
                <br/><br/>
                <table class="table">
                   <tr>
                        <th>Kode</th>
                        <td >: <?php echo e($node->code); ?></td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>: <?php echo e($node->name); ?></td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>: <?php echo empty($penadah->name)?"<i>Tidak ada keterangan</i>": $penadah->name; ?></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" id="submit" class="btn btn-danger success">Delete</a>
            </div>
        </div>
    </div>
  </div>
                        <?php endif; ?>


            </div>
            </a>
          </div>
          <div class="col-md-12">
            <div id="tabDetail">
              <br/>
              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Kode</p>
                  <p class="col-sm-8 col-xs-9 row">: <strong><?php echo e($node->code); ?> </strong></p>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Wilayah</p>
                  <p class="col-sm-8 col-xs-9 row">: <strong><?php echo empty($node->getwilayah->name)?"<i></i>":$node->getwilayah->name; ?> </strong></p>
                </div>
              </div>
              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Nama</p>
                  <p class="col-sm-8 col-xs-9 row">: <strong><?php echo e($node->name); ?> </strong></p>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Status</p>
                  <p class="col-sm-8 col-xs-9 row">:  <?php echo empty($node->getstatus->name)?"<i></i>":$node->getstatus->name; ?></p>
                </div>
              </div>
              <div class="col-sm-12 col-xs-12 row">
                
              </div>

              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Created At</p>
                  <p class="col-sm-8 col-xs-9 row">:  <?php echo e($node->created_at); ?> </p>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Updated At</p>
                  <p class="col-sm-8 col-xs-9 row">:  <?php echo e($node->updated_at); ?> </p>
                </div>
              </div>
              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Created By</p>
                  <p class="col-sm-8 col-xs-9 row">:  <?php echo empty($node->created_by)?"":$node->createdby->first_name; ?> </p>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Updated By</p>
                  <p class="col-sm-8 col-xs-9 row">:  <?php echo empty($node->updated_by)?"":$node->updatedby->first_name; ?> </p>
                </div>
              </div>
              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Deskripsi</p>
                  <p class="col-sm-8 col-xs-9 row">:  <?php echo empty($node->notes)?"<i>Tidak ada Deskripsi</i>":$node->notes; ?></p>
                </div>
              </div>

                  </div>

            <div id="tabLog">
              <br>
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="tablog">
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


       var oTable = $('#tablog').DataTable();
        // Tab

        $('#tabLog').hide();
        $('#pilihDetail').addClass("active");

        // Klik Tab
        $('#pilihModules').click(function(){
          $('#tabDetail').hide();
          $('#tabLog').hide();

          $('#pilihDetail').removeClass("active");
          $('#pilihLog').removeClass("active");

        });

        $('#pilihDetail').click(function(){
          $('#tabDetail').show();
          $('#tabLog').hide();

          $('#pilihDetail').addClass("active");
          $('#pilihLog').removeClass("active");
        });
        $('#pilihLog').click(function(){
          $('#tabDetail').hide();
          $('#tabLog').show();

          $('#pilihLog').addClass("active");
            $('#pilihDetail').removeClass("active");
        });

     




    });

            $('#submit').click(function(){
  //  alert('submitting');
    $('#formfield').submit();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>