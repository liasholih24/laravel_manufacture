<?php $__env->startSection('title'); ?>
<?php echo e($node->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
<?php echo e($node->subtitle); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('style'); ?>
<?php echo e(HTML::style('assets_back/css/jquery-gmaps-latlon-picker.css')); ?>

<?php echo e(HTML::style('assets_back/css/plugins/dataTables/datatables.min.css')); ?>

<?php $__env->stopSection(); ?>
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
              <a href="<?php echo e(url('sbu/'. $node->id .'/show')); ?>">
                <?php echo e($node->name); ?>

              </a>
            </li>
            <?php endif; ?>
            <?php if($node->depth != 0): ?>
            <?php if($node->depth > 1): ?> <li class="">
              <a href="<?php echo e(url('sbu/'.$node->getsbu->id.'/show')); ?>"><?php echo empty($node->getsbu->name)? "No SBU" : $node->getsbu->name; ?></a>
            </li><?php endif; ?>
            <li class="">
              <a href="<?php echo e($node->getsbu->id); ?>"><?php echo empty($node->getsbu->name)? "No SBU" : $node->getsbu->name; ?></a>
            </li>
            <li class="">
              <a href="<?php echo e(url('sbu/'.$node->id.'/show')); ?>"><?php echo e($node->name); ?></a>
            </li>
            <?php endif; ?>
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
        <h2><?php echo e($node->name); ?></h2>
        <small>
          <i class="fa fa-clock-o"></i>
          Last updated at <?php echo e($node->updated_at); ?> by <?php echo empty($node->updated_by)?"":$node->updatedby->first_name; ?> <?php echo empty($node->updated_by)?"":$node->updatedby->last_name; ?><strong>
          </strong>
        </small>
        <div class="row" style="padding-top: 10px">
          <div class="col-md-12">
            <a id="pilihDetail" class="btn btn-sm btn-outline btn-primary">
            <i class="fa fa-info-circle"></i> Detail</a>
            <a id="pilihMaps" class="btn btn-sm btn-outline btn-primary">  <i class="fa fa-globe"></i> Maps</a>

            <a id="pilihDescendant" class="btn btn-sm btn-outline btn-primary">  <i class="fa <?php echo e($node->depthicon); ?>"></i> <?php echo e($node->depthname); ?></a>

            <?php if($node->depth == 1): ?>
            <a id="pilihLeaves" class="btn btn-sm btn-outline btn-primary">  <i class="fa fa-book"></i> Room</a>
            <?php endif; ?>
            <a id="pilihLog" class="btn btn-sm btn-outline btn-primary">  <i class="fa fa-book"></i> Logs</a>
            <div class="pull-right">

              <a href="<?php echo e(url('sbu/'.$node->id.'/edit')); ?>" class="btn btn-sm btn-outline btn-primary">  <i class="fa fa-edit" ></i> Edit</a>
              <?php if($node->depth == 1): ?>
              <a href="<?php echo e(url('sbu/2/'.$node->id.'/create')); ?>" class="btn btn-sm btn-outline btn-primary" id="addBuilding">
                  <i class="fa fa-plus" ></i> Add Building
              </a>
              <a href="<?php echo e(url('sbu/3/'.$node->id.'/create')); ?>" class="btn btn-sm btn-outline btn-primary" id="addRoom">
                  <i class="fa fa-plus" ></i> Add Room
              </a>
               <?php elseif($node->depth == 0): ?>
               <a href="<?php echo e(url('sbu/1/'.$node->id.'/create')); ?>" class="btn btn-sm btn-outline btn-primary">
                   <i class="fa fa-plus" ></i> Add POP
               </a>

                <?php endif; ?>

            </div>
            </a>
          </div>
          <div class="col-md-12">
            <div id="tabDetail">
              <br/>
              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Code</p>
                  <p class="col-sm-8 col-xs-9 row">: <strong><?php echo e($node->code); ?> </strong></p>
                </div>
              </div>
              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Name</p>
                  <p class="col-sm-8 col-xs-9 row">: <strong><?php echo e($node->name); ?> </strong></p>
                </div>
              </div>
                <?php if($node->depth == 1): ?>
                <div class="col-sm-12 col-xs-12 row">
                  <div class="col-sm-6 col-xs-12">
                    <p class="col-sm-4 col-xs-3 row">Region</p>
                    <p class="col-sm-8 col-xs-9 row">: <?php echo e($node->getregion->name); ?> </p>
                  </div>
                </div>
                <div class="col-sm-12 col-xs-12 row">
                  <div class="col-sm-6 col-xs-12">
                    <p class="col-sm-4 col-xs-3 row">Province</p>
                    <p class="col-sm-8 col-xs-9 row">: <?php echo e($node->getprovince->name); ?> </p>
                  </div>
                </div>
                <?php endif; ?>
              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Address</p>
                  <p class="col-sm-8 col-xs-9 row">: <?php echo empty($node->address)?"<i>No Address</i>":$node->address; ?> </p>
                </div>
              </div>
              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Description</p>
                  <p class="col-sm-8 col-xs-9 row">:  <?php echo empty($node->desc)?"<i>No Description</i>":$node->desc; ?> </p>
                </div>
              </div>
              <div class="col-sm-12 col-xs-12 row">
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Oflline Mode</p>
                  <p class="col-sm-8 col-xs-9 row">:  <?php if($node->offline_sts == 1): ?> Yes <?php else: ?> No ; <?php endif; ?> </p>
                </div>
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
                  <p class="col-sm-8 col-xs-9 row">:  <?php echo empty($node->created_by)?"":$node->createdby->first_name; ?> <?php echo empty($node->created_by)?"":$node->createdby->last_name; ?> </p>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <p class="col-sm-4 col-xs-3 row">Updated By</p>
                  <p class="col-sm-8 col-xs-9 row">:  <?php echo empty($node->updated_by)?"":$node->updatedby->first_name; ?> <?php echo empty($node->updated_by)?"":$node->updatedby->last_name; ?> </p>
                </div>
              </div>

                  </div>
                  <div id="tabDescendant">
                    <br>
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover" id="editable">
                        <thead>

                          <tr>
                              <th>No.</th>
                              <th>Code</th>
                              <th>Name</th>
                              <?php if($node->depth == 0): ?>
                              <th>City/Region</th>
                              <th>Province</th>
                              <?php endif; ?>
                              <th>Last Update</th>
                              <th>Updated By</th>
                              <th>Status</th>
                              <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i=0 ?>
                          <?php $__currentLoopData = $nodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php if($item->depth != 4): ?>
                          <?php $i++ ?>
                            <tr>
                                <td><?php echo e($i); ?></td>
                                <td><?php echo e($item->code); ?></td>
                                <td><?php echo e($item->name); ?></td>
                                <?php if($node->depth == 0): ?>
                                <td><?php echo e($item->getregion->name); ?></td>
                                <td><?php echo e($item->getprovince->name); ?></td>
                                <?php endif; ?>
                                <td><?php echo e($item->updated_at); ?></td>
                                <td><?php echo e($item->updatedby->first_name); ?> <?php echo e($item->updatedby->last_name); ?></td>
                                <td><?php if( $item->status == 3): ?>
                                <a href="#" class="btn btn-xs btn-primary btn-outline active">Active</a>
                                <?php else: ?>
                                <a href="#" class="btn btn-xs btn-default btn-outline">Inactive</a>
                                <?php endif; ?></td>
                                <td>

                                  <?php if($item->depth !== 3): ?>
                                  <?php if(Sentinel::getUser()->hasAccess(['sbu.show'])): ?>
                                  <a href="<?php echo e(url('sbu/' . $item->id . '/show')); ?>" class="btn btn-primary btn-outline btn-xs">View</a>
                                  <?php endif; ?>
                                  <?php endif; ?>
                                  <?php if($item->depth == 1): ?>
                                  <?php if(Sentinel::getUser()->hasAccess(['sbu.edit'])): ?>
                                  <a href="<?php echo e(url('sbu/' . $item->id . '/edit')); ?>" class="btn btn-outline btn-primary btn-xs">Edit</a>
                                  <?php endif; ?>
                                  <?php endif; ?>
                                  <?php if($item->depth == 3): ?>
                                  <?php if(Sentinel::getUser()->hasAccess(['sbu.edit'])): ?>
                                  <a href="<?php echo e(url('sbu/' . $item->id . '/edit2')); ?>" class="btn btn-outline btn-primary btn-xs">Edit</a>
                                  <?php endif; ?>
                                  <?php endif; ?>
                                </td>
                            </tr>
                            <?php endif; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>


                      </table>
                    </div>
                  </div>
                  <div id="tabLeaves">
                    <br>
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover" id="editable2">
                        <thead>

                          <tr>
                              <th>No.</th>
                              <th>Code</th>
                              <th>Name</th>
                              <th>Building</th>
                              <th>Desc</th>
                              <th>Last Update</th>
                              <th>Updated By</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i=0 ?>
                          <?php $__currentLoopData = $nodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($item->depth == 4): ?>
                          <?php $i++ ?>
                            <tr>
                                <td><?php echo e($i); ?></td>
                                <td><?php echo e($item->code); ?></td>
                                <td><?php echo e($item->name); ?></td>
                                <td><?php echo e($item->getbuilding->name); ?></td>
                                <td><?php echo e($item->desc); ?></td>
                                <td><?php echo e($item->updated_at); ?></td>
                                <td><?php echo e($item->updatedby->first_name); ?> <?php echo e($item->updatedby->last_name); ?></td>
                                <td><?php if( $item->status == 3): ?>
                                <a href="#" class="btn btn-xs btn-primary btn-outline active">Active</a>
                                <?php else: ?>
                                <a href="#" class="btn btn-xs btn-default btn-outline">Inactive</a>
                                <?php endif; ?></td>
                                <td>


                                    <?php if(Sentinel::getUser()->hasAccess(['sbu.show'])): ?>
                                    <a href="<?php echo e(url('sbu/' . $item->id . '/edit2')); ?>" class="btn btn-outline btn-primary btn-xs">Edit</a>
                                    <?php endif; ?>

                                </td>

                            </tr>
                            <?php endif; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>


                      </table>
                    </div>
                  </div>
            <div id="tabMaps">
              <br>
              <div class="col-xs-12 col-sm-22">
                <?php echo Form::model($node, [
                    'method' => 'PATCH',
                    'url' => ['sbu', $node->id],
                    'class' => 'form-horizontal'
                ]); ?>

                <?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

                <?php echo Form::hidden('level', $node->depth); ?>

                <?php echo Form::hidden('code', $node->code); ?>

                <?php echo Form::hidden('name', $node->name); ?>

            <fieldset class="gllpLatlonPicker">

              		<div class="gllpMap">Google Maps </div>
              		<br/>
                  <div class="form-group">
                    <?php echo Form::label('lat', 'Lat', ['class' => 'col-sm-1 control-label']); ?>

                  <div class="col-sm-3 col-xs-12">
              			<input type="text" name="lat" class="gllpLatitude form-control" value="<?php echo empty($node->lat)?"-6.178777493843233":$node->lat; ?>"/>

                  </div>
                    <?php echo Form::label('lon', 'Lon', ['class' => 'col-sm-1 control-label']); ?>

              			<div class="col-sm-3 col-xs-12">
              			<input type="text" name="lon" class="gllpLongitude form-control" value="<?php echo empty($node->lon)?"106.98014671006422":$node->lon; ?>"/>
                  </div>
              		<?php echo Form::label('zoom', 'Zoom', ['class' => 'col-sm-1 control-label']); ?>

                  <div class="col-sm-3 col-xs-12">
                  <input type="text" class="gllpZoom form-control" value="11"/>
                </div>
              </div>

                <div class="form-group">
            <a href="<?php echo e(url('sbu')); ?>" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
                  <button type="submit" class="create_mdl btn btn-outline btn-primary pull-right">
                        <i class="fa fa-pencil"></i>  Update
                  </button>

              </div>

              </fieldset>


            <?php echo Form::close(); ?>

                </div>
            </div>
            <div id="tabLog">
              <br>
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="editable3">
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

<?php echo e(HTML::script('assets_back/js/jquery-gmaps-latlon-picker.js')); ?>

<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<!-- Page-Level Scripts -->
<script>
    $(document).ready(function(){
      //initMap
      function initialize() {
                var myLatLng = {lat: <?php echo empty($node->lat)?"-1.2467423194":$node->lat; ?>, lng:  <?php echo empty($node->lon)?"116.99":$node->lon; ?>};
                var zom = <?php echo empty($node->lat)? 5 : 15; ?> ;
                var myOptions = {
                    zoom: zom,
                    center: new google.maps.LatLng(myLatLng),
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                  }
                map = new google.maps.Map($(".gllpMap")[0],
                                                myOptions);
                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    draggable:true
                  });

                google.maps.event.addListener(marker, 'dragend', function(e) {
                    console.log("pos changed");
                    $('input[name="lat"]').val(e.latLng.lat());
                    $('input[name="lon"]').val(e.latLng.lng());
                  });

                function placeMarkerAndPanTo(latLng, map) {
                  var marker = new google.maps.Marker({
                    position: latLng,
                    map: map
                  });
                  map.panTo(latLng);
                }
                google.maps.event.trigger($(".gllpMap")[0], 'resize');
        }

        // Tab
        $('#tabDescendant').hide();
        $('#tabLog').hide();
        $('#tabLeaves').hide();
        $('#tabMaps').hide();
        $('#pilihDetail').addClass("active");
        $('#pilihLeaves').hide();
        $('#addBuilding').hide();
        $('#addRoom').hide();

        // Klik Tab
        $('#pilihModules').click(function(){
          $('#tabDetail').hide();
          $('#tabDescendant').hide();
          $('#tabLog').hide();
          $('#tabLeaves').hide();
          $('#tabMaps').hide();
          $('#addBuilding').hide();
          $('#addRoom').hide();

          $('#pilihLeaves').hide();

          $('#pilihDescendant').removeClass("active");
          $('#pilihDetail').removeClass("active");
          $('#pilihLog').removeClass("active");
            $('#pilihMaps').removeClass("active");

        });
        $('#pilihDescendant').click(function(){
          $('#tabDetail').hide();
          $('#tabDescendant').show();
          $('#tabLog').hide();
          $('#tabLeaves').hide();
          $('#tabMaps').hide();
          $('#addBuilding').show();
          $('#addRoom').hide();

          $('#pilihLeaves').show();

          $('#pilihDescendant').addClass("active");
          $('#pilihDetail').removeClass("active");
          $('#pilihLog').removeClass("active");
          $('#pilihLeaves').removeClass("active");
            $('#pilihMaps').removeClass("active");
        });
        $('#pilihMaps').click(function(){
          $('#tabDetail').hide();
          $('#tabDescendant').hide();
          $('#tabMaps').show();
          $('#tabLog').hide();
          $('#tabLeaves').hide();
          $('#addBuilding').hide();
          $('#addRoom').hide();

          initialize();

          $('#pilihLeaves').hide();

          $('#pilihMaps').addClass("active");
          $('#pilihDescendant').removeClass("active");
          $('#pilihDetail').removeClass("active");
          $('#pilihLog').removeClass("active");
          $('#pilihLeaves').removeClass("active");
        });
        $('#pilihLeaves').click(function(){
          $('#tabDetail').hide();
          $('#tabDescendant').hide();
          $('#tabLeaves').show();
          $('#tabLog').hide();
          $('#tabMaps').hide();
          $('#addBuilding').hide();
          $('#addRoom').show();


          $('#pilihLeaves').show();

          $('#pilihLeaves').addClass("active");
          $('#pilihDescendant').removeClass("active");
          $('#pilihDetail').removeClass("active");
          $('#pilihLog').removeClass("active");
            $('#pilihMaps').removeClass("active");
        });
        $('#pilihDetail').click(function(){
          $('#tabDetail').show();
          $('#tabDescendant').hide();
          $('#tabLog').hide();
          $('#tabLeaves').hide();
          $('#pilihLeaves').hide();
          $('#tabMaps').hide();
          $('#addBuilding').hide();
          $('#addRoom').hide();

          $('#pilihDetail').addClass("active");
          $('#pilihDescendant').removeClass("active");
          $('#pilihLog').removeClass("active");
            $('#pilihMaps').removeClass("active");
        });
        $('#pilihLog').click(function(){
          $('#tabDetail').hide();
          $('#tabDescendant').hide();
          $('#tabLog').show();
          $('#tabLeaves').hide();
          $('#tabMaps').hide();
          $('#addBuilding').hide();
          $('#addRoom').hide();

          $('#pilihLeaves').hide();
            $('#pilihLog').addClass("active");
            $('#pilihDetail').removeClass("active");
            $('#pilihDescendant').removeClass("active");
          $('#pilihMaps').removeClass("active");
        });

        /* Init DataTables */
        var oTable = $('#editable').DataTable();
        var oTable = $('#editable2').DataTable();
        var oTable = $('#editable3').DataTable({order:[[3,'asc']]});





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