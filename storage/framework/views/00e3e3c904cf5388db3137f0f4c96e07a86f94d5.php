<?php $__env->startSection('title'); ?>
Asset
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Manage Asset
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php echo e(HTML::style('assets_back/css/plugins/dataTables/datatables.min.css')); ?>

<?php echo e(HTML::style('assets_back/css/plugins/select2/select2.min.css')); ?>

<?php echo e(HTML::style('assets_back/css/plugins/chosen/chosen.css')); ?>

<?php echo e(HTML::style('assets_back/css/plugins/blueimp/css/blueimp-gallery.min.css')); ?>

<style type="text/css">
  .chosen-container.chosen-container-single {
    width: 350px !important; /* or any value that fits your needs */
}
/* property images */
#links {
    z-index:10;
}

#links .property-image {
    display:block;
    width: 200px;
    height:200px;
    float:left;
    position:relative;
    margin-bottom:10px;
    margin-right:10px;
}

    #links .property-image img {
        display:block;
        width: 200px;
        height:200px;
        background-color:#cccccc;
        float:left;
        text-align:center;
    }

    #links .property-image button {
        display:block;
        width:200px;
        background-color:#d2322d;
        position:absolute;
        bottom:0;
        text-align:center;
        font-family: "proxima-nova";
        font-size: 0.688em;
        font-weight: 700;
        color: #ffffff;
        margin-top:2px;
        padding: 6px 0px;
        z-index:1000;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row wrapper wrapper-content">
    <div class="row ibox col-sm-12" style="min-height: 70vh">
        <div class="col-sm-3">
          <div class="ibox-title">
            Asset Detail
          </div>
          <div class="ibox-content" style="min-height: 75vh">

            <a href="#" title="" data-gallery="">
              <img style="max-width:200px;min-width:200px" src="<?php echo e($node->getmodel->url_image?asset($node->getmodel->url_image):asset('images/noimage.jpg')); ?>"></a>

            <div class="col-sm-12" style="margin-top: 20px">
              <h3 style="text-align: center;"><?php echo empty($node->name)?"":$node->name; ?></h3>

            </div>
            <div class="col-sm-12">
              <p >
                QRCODE : <?php echo empty($node->qr_code)?'<font color="red">Not Set</font>':'<strong>'.$node->qr_code.'</strong>'; ?>

              </p>
              <p>
                Status : <strong><?php echo empty($node->getstatus->name)?'Not Set':$node->getstatus->name; ?></strong>
              </p>
              <p>
                Condition : <strong><?php echo empty($node->getcondition->name)?'Not Set':$node->getcondition->name; ?></strong>
              </p>
              <p>
                Brand : <?php echo empty($node->getbrand->name)?"":$node->getbrand->name; ?>

              </p>
              <p>
                Model : <?php echo empty($node->getmodel->name)?"":$node->getmodel->name; ?>

              </p>
              <p>
                Type : <?php echo empty($node->gettype->name)?"":$node->gettype->name; ?>

              </p>
              <p>
                Category : <?php echo empty($node->getcategory->name)?"":$node->getcategory->name; ?>

              </p>
              <p>
                Asset Category : <?php echo empty($node->getassetcategory->name)?"":$node->getassetcategory->name; ?>

              </p>
              <p>
                <?php if($node->c_status == 1): ?> <a href="#" class="btn btn-primary btn-xs">Complete</a> <?php else: ?> <a href="#" class="btn btn-warning btn-xs">Not Complete</a> <?php endif; ?>
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-9">
          <div class="row ibox-title">
              <ol class="breadcrumb col-sm-10 col-xs-12" style="font-size: 14px; ">
                <li class="">
                  <a href="<?php echo e(url('asset')); ?>">
                    Asset List
                  </a>
                </li>
                <li class="">
                  <a href="<?php echo e(url('asset/' .$node->getsbu->id. '/filter')); ?>">
                    <?php echo empty($node->getsbu->name)?"":$node->getsbu->name; ?>

                  </a>
                </li>
                <li class="">
                  <a href="<?php echo e(url('asset/' .$node->getpop->parent_id. '/' .$node->getpop->id. '/filter2')); ?>">
                    <?php echo empty($node->getpop->name)?"":$node->getpop->name; ?>

                  </a>
                </li>
                <li class="">
                  <a href="<?php echo e(url('#')); ?>">
                    <?php echo empty($node->getmodel->name)?"":$node->getmodel->name; ?>

                  </a>
                </li>
              </ol>
              <a href="<?php echo e(url('asset')); ?>">
                <button class="btn btn-sm btn-outline btn-warning pull-right" style="margin-top: -5px">
                  <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px; "></i> Back
                </button>
              </a>
          </div>
          <div class="row ibox-content" style="min-height: 70vh">
            <?php $__currentLoopData = ['danger', 'warning', 'success', 'info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(Session::has('alert-' . $msg)): ?>
                <div class="alert alert-<?php echo e($msg); ?> alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <?php echo e(Session::get('alert-' . $msg)); ?>.
                </div>
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="tabs-container" id="dataTabs">
              <ul class="nav nav-tabs" id="tabMenu">
                  <li class="active"><a data-toggle="tab" href="#dtl" class="dtl" data-status="true">Detail Info</a></li>
                  <li class=""><a data-toggle="tab" href="#attr"  class="attr" d data-status="false">Attributes</a></li>
                   <?php if($datas){  $x = explode(',', $datas);?>
                    <?php foreach($x as $dt){ ;?>
                      <?php echo '<li class=""><a data-toggle="tab" href="#'.strtolower($dt).'"  class="attr"  data-status="false">'.$dt.'</a></li>' ;?>
                    <?php ; }; unset($dt);?>
                  <?php ;} ;?>
                  <li class=""><a data-toggle="tab" href="#log"  class="attr" d data-status="false">Logs</a></li>
                  <li class=""><a data-toggle="tab" href="#img"  class="attr" d data-status="false">Images</a></li>

                <?php if(Sentinel::getUser()->hasAccess(['asset.edit'])): ?>
                 <?php if($node->getpop->offline_sts != 1): ?>
                <a href="<?php echo e(url('asset/' .$node->id. '/edit')); ?>" style="margin-left:10px;" class="btn btn-sm btn-outline btn-primary pull-right">  <i class="fa fa-edit"></i> Edit</a>
                 <?php endif; ?>
                <?php endif; ?>

                <?php if(Sentinel::getUser()->hasAccess(['asset.mutation'])): ?>
                  <?php if($node->getpop->offline_sts != 1): ?>
                <a href="<?php echo e(url('asset/' .$node->id. '/mutation')); ?>" class="btn btn-sm btn-outline btn-info pull-right">  <i class="fa fa-truck" ></i> Mutation</a>
                  <?php endif; ?>
                <?php endif; ?>


              </ul>
              <div class="tab-content">
                  <div id="dtl" class="tab-pane active">
                    <div class="row col-sm-12" style="margin-top: 20px">
                      <div class="col-sm-12 col-xs-12 row">
                        <div class="col-sm-6 col-xs-12">
                          <p class="col-sm-5 col-xs-3 row">Code</p>
                          <p class="col-sm-7 col-xs-9 row">: <strong><?php echo empty($node->code)?"<b>No Code</b>":$node->code; ?></strong></p>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                          <p class="col-sm-4 col-xs-3 row">SBU</p>
                          <p class="col-sm-8 col-xs-9 row">: <strong><?php echo empty($node->getsbu->name)?"":$node->getsbu->name; ?></strong></p>
                        </div>
                      </div>
                      <div class="col-sm-12 col-xs-12 row">
                        <div class="col-sm-6 col-xs-12">
                          <p class="col-sm-5 col-xs-3 row">Name</p>
                          <p class="col-sm-7 col-xs-9 row">: <strong><?php echo empty($node->name)?"Not Set":$node->name; ?></strong></p>
                        </div>

                        <div class="col-sm-6 col-xs-12">
                          <p class="col-sm-4 col-xs-3 row">Site</p>
                          <p class="col-sm-8 col-xs-9 row">: <strong><?php echo empty($node->getpop->name)?"Not Set":$node->getpop->name; ?></strong></p>
                        </div>
                      </div>
                      <div class="col-sm-12 col-xs-12 row">
                        <div class="col-sm-6 col-xs-12">
                          <p class="col-sm-5 col-xs-3 row">Serial No</p>
                          <p class="col-sm-7 col-xs-9 row">: <strong><?php echo empty($node->serial_no)?'<font color="red">Not Set</font>':$node->serial_no; ?></strong></p>
                        </div>
                        <div class="col-sm-6 col-xs-12">

                          <p class="col-sm-4 col-xs-3 row">Building</p>
                          <p class="col-sm-8 col-xs-9 row">: <strong><?php echo empty($node->getbuilding->name)?'<font color="red">Building Not Set</font>':$node->getbuilding->name; ?></strong> </p>
                        </div>
                      </div>
                      <div class="col-sm-12 col-xs-12 row">
                        <div class="col-sm-6 col-xs-12">
                          <p class="col-sm-5 col-xs-3 row">IO No</p>
                          <p class="col-sm-7 col-xs-9 row">: <strong><?php echo empty($node->io_no)?"Not Set":$node->io_no; ?></strong></p>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                          <p class="col-sm-4 col-xs-3 row">Room</p>
                          <p class="col-sm-8 col-xs-9 row">: <strong><?php echo empty($node->getroom->name)?'<font color="red">Not Set</font>':$node->getroom->name; ?></strong></p>
                        </div>
                      </div>
                      <div class="col-sm-12 col-xs-12 row">
                        <?php if(Sentinel::getUser()->hasAccess(['asset.price'])): ?>
                        <div class="col-sm-6 col-xs-12">
                          <p class="col-sm-5 col-xs-3 row">Assets Value </p>
                          <p class="col-sm-7 col-xs-9 row">: <strong ><?php echo empty($node->investasi)?'<font color="red">Not Set</font>':"Rp.".number_format($node->investasi, 2, '.', ','); ?></strong></p>
                        </div>
                        <?php endif; ?>
                        <div class="col-sm-6 col-xs-12">
                          <p class="col-sm-4 col-xs-3 row">Rack </p>
                          <p class="col-sm-8 col-xs-9 row">: <strong>QRCode : <?php echo empty($node->getrack->qr_code)?"<i>N/A</i>":$node->getrack->qr_code; ?> ; SN :<?php echo empty($node->getrack->serial_no)?"<i>N/A</i>":$node->getrack->serial_no; ?> ; Name: <?php echo empty($node->getrack->name)?"<i>N/A</i>":$node->getrack->name; ?></strong></p>
                        </div>
                      </div>
                      <div class="col-sm-12 col-xs-12 row">

                        <div class="col-sm-6 col-xs-12">
                          <p class="col-sm-5 col-xs-3 row">Accounting No</p>
                          <p class="col-sm-7 col-xs-9 row">: <strong><?php echo empty($node->acc_no)?"Not Set":$node->acc_no; ?></strong></p>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                          <p class="col-sm-4 col-xs-3 row">Material No</p>
                          <p class="col-sm-8 col-xs-9 row">: <strong><?php echo empty($node->material_no)?'<font color="red">Not Set</font>':$node->material_no; ?></strong></p>
                        </div>

                      </div>
                      <div class="col-sm-12 col-xs-12 row">
                        <div class="col-sm-6 col-xs-12">
                          <p class="col-sm-5 col-xs-3 row">Has License</p>
                          <p class="col-sm-7 col-xs-9 row">: <strong><?php echo ($node->license == 1 ? 'Yes' : 'No'); ?></strong></p>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                          <p class="col-sm-4 col-xs-3 row">Has Port</p>
                          <p class="col-sm-8 col-xs-9 row">: <strong> <?php echo empty($node->getmodel->port)?"No":"Yes"; ?>  </strong></p>
                        </div>

                      </div>
                      <div class="col-sm-12 col-xs-12 row">
                        <div class="col-sm-6 col-xs-12">
                          <p class="col-sm-5 col-xs-3 row">Electricity Source</p>
                          <p class="col-sm-7 col-xs-9 row">: <strong>  <?php echo empty($node->getmodel->source)?"No":"Yes"; ?></strong></p>

                        </div>
                        <div class="col-sm-6 col-xs-12">
                          <p class="col-sm-4 col-xs-3 row">Has Slot</p>
                          <p class="col-sm-8 col-xs-9 row">: <strong>  <?php echo empty($node->getmodel->slot)?"No":"Yes"; ?></strong></p>
                            <!--<strong>  <?php $__currentLoopData = $attr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $has): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($has->nameAttr->type == "asset"): ?>  <?php echo empty($has->nameAttr->type)?"No":"Yes"; ?> <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></strong></p>
                            -->
                        </div>
                      </div>
                      <div class="col-sm-12 col-xs-12 row">
                        <div class="col-sm-6 col-xs-12">
                          <p class="col-sm-5 col-xs-3 row">Power</p>
                          <p class="col-sm-7 col-xs-9 row">: <strong><?php echo empty($node->getmodel->power)?"No Power":$node->getmodel->power; ?></strong></p>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                          <p class="col-sm-4 col-xs-3 row">MPLS</p>
                          <p class="col-sm-8 col-xs-9 row">: <strong><?php echo empty($node->getmodel->mpls_hierarchy)?"No MPLS":$node->getmodel->mpls_hierarchy; ?></strong></p>
                        </div>
                      </div>
                      <div class="col-sm-12 col-xs-12 row">
                        <div class="col-sm-6 col-xs-12">
                          <p class="col-sm-5 col-xs-3 row">Rack Unit</p>
                          <p class="col-sm-7 col-xs-9 row">: <strong><?php echo empty($node->getmodel->rack_unit)?"Not Set": $node->getmodel->rack_unit." RU"; ?></strong></p>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                          <p class="col-sm-4 col-xs-3 row">Dimension</p>
                          <p class="col-sm-8 col-xs-9 row">:<?php echo e($node->getmodel->length); ?> X <?php echo e($node->getmodel->width); ?> X <?php echo e($node->getmodel->height); ?>  </p>
                        </div>
                      </div>
                      <div class="col-sm-12 col-xs-12 row">
                        <div class="col-sm-6 col-xs-12">
                          <p class="col-sm-5 col-xs-3 row">Installation Year</p>
                          <p class="col-sm-7 col-xs-9 row">:  <?php echo empty($node->installation_year)?"Not Set":$node->installation_year; ?> </p>
                        </div>
                      </div>
                      <div class="col-sm-12 col-xs-12 row">
                        <div class="col-sm-6 col-xs-12">
                          <p class="col-sm-5 col-xs-3 row">Longitude</p>
                          <p class="col-sm-7 col-xs-9 row">:  <?php echo e($node->getpop->lon); ?> </p>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                          <p class="col-sm-4 col-xs-3 row">Latitude</p>
                          <p class="col-sm-8 col-xs-9 row">:  <?php echo e($node->getpop->lat); ?> </p>
                        </div>
                      </div>
                      <div class="col-sm-12 col-xs-12 row">
                        <div class="col-sm-6 col-xs-12">
                          <p class="col-sm-5 col-xs-3 row">Created At</p>
                          <p class="col-sm-7 col-xs-9 row">:  <?php echo e($node->created_at); ?> </p>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                          <p class="col-sm-4 col-xs-3 row">Updated At</p>
                          <p class="col-sm-8 col-xs-9 row">:  <?php echo e($node->updated_at); ?> </p>
                        </div>
                      </div>
                      <div class="col-sm-12 col-xs-12 row">
                        <div class="col-sm-6 col-xs-12">
                          <p class="col-sm-5 col-xs-3 row">Created By</p>
                          <p class="col-sm-7 col-xs-9 row">:  <?php echo empty($node->created_by)?"":$node->createdby->first_name; ?> </p>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                          <p class="col-sm-4 col-xs-3 row">Updated By</p>
                          <p class="col-sm-8 col-xs-9 row">:  <?php echo empty($node->updated_by)?"":$node->updatedby->first_name; ?> </p>
                        </div>
                      </div>
                      <div class="col-sm-12 col-xs-12 row">
                        <div class="col-sm-12 col-xs-12">
                          <h3 class="col-sm-12 col-xs-3 row">Notes about <?php echo e($node->getmodel->name); ?></h3>
                        </div>
                      </div>
                      <div class="col-sm-12 col-xs-12 row">
                        <div class="col-sm-12 col-xs-12">
                          <p class="col-sm-12 col-xs-3 row"><?php echo empty($node->desc)?"No Notes Data": $node->desc; ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="attr" class="tab-pane">
                    <div class="table-responsive" style="margin-top: 20px">
                      <table class="table table-striped table-bordered table-hover" id="editable">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Category</th>
                            <th>Attribut</th>
                            <th>Total</th>
                            <th>Updated At</th>
                            <th>Updated By</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i = 0 ?>
                          <?php $__currentLoopData = $attrs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php $i++ ?>
                          <tr>
                          <td><?php echo e($i); ?></td>
                          <td><?php echo e($item->nameAttr->name); ?></td>
                          <td><?php echo e($item->catAttr->name); ?></td>
                          <td><?php echo e($item->value); ?></td>
                          <td><?php echo e($item->updated_at); ?></td>
                          <td><?php echo empty($item->updatedby->first_name)?"":$item->updatedby->first_name; ?> <?php echo empty($item->updatedby->last_name)?"":$item->updatedby->last_name; ?></td>

                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div id="log" class="tab-pane">
                    <br>
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover" id="editable5">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Description</th>
                            <th>Updated By</th>
                            <th>Updated At</th>
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
                  <div id="img" class="tab-pane">
                    <br/>
                    <!--
                    <div id="tabImage" class="col-sm-12 lightBoxGallery" style="margin-top: 20px">
                      <?php $__currentLoopData = $node->getimages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(url('/').'/'.$image->url_image); ?>" title="" data-gallery=""><img style="max-width:200px;min-width:200px" src="<?php echo e(url('/').'/'.$image->url_image); ?>"></a>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <div id="blueimp-gallery" class="blueimp-gallery">
                        <div class="slides"></div>
                        <h3 class="title"></h3>
                        <a class="prev">‹</a>
                        <a class="next">›</a>
                        <a class="close">×</a>
                        <a class="play-pause"></a>
                        <ol class="indicator"></ol>
                      </div>
                    </div>-->
                    <div id="links">
                      <?php $__currentLoopData = $node->getimages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="property-image">
                        <a href="<?php echo e(url('/').'/'.$image->url_image); ?>" title="" data-gallery=""><img src="<?php echo e(url('/').'/'.$image->url_image); ?>"></a>
                        <?php if(Sentinel::getUser()->hasAccess(['asset.edit'])): ?>
                          <?php if($node->getpop->offline_sts != 1): ?>
                        <button class="btn btn-danger deleteImage delete-confirm-ajax" value="<?php echo e($image->id); ?>">Delete</button>
                          <?php endif; ?>
                        <?php endif; ?>
                      </div>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
                    <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
                      <div class="slides"></div>
                      <h3 class="title"></h3>
                      <a class="prev"><</a>
                      <a class="next">></a>
                      <a class="close">×</a>
                      <a class="play-pause"></a>
                      <ol class="indicator"></ol>
                    </div>

                  </div>
                  <?php if($datas){ ;?>
                    <div id="port" class="tab-pane">
                      <div class="col-sm-12" style="margin-top: 20px; margin-bottom: 20px" id="dataRevenue">
                        <?php if(Sentinel::getUser()->hasAccess(['asset.edit'])): ?>
                          <?php if($node->getpop->offline_sts != 1): ?>
                      <button id="addRevenue" type="button" class="btn btn-sm btn-outline btn-primary pull-right">Add Port</button>
                          <?php endif; ?>
                        <?php endif; ?>
                      </div>
                      <div class="col-sm-12 table-responsive" id="tableReveneu">

                        <table class="table table-striped table-bordered table-hover" id="editable2">
                          <thead>

                            <tr>
                              <th>No.</th>
                              <th>Customer Name</th>
                              <th>SID</th>
                              <th>Revenue</th>
                              <th>Port Name</th>
                              <th>Port No</th>
                              <th>Created By</th>
                              <th>Created At</th>
                              <th>Status</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i = 0 ?>
                            <?php $__currentLoopData = $revenues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $revenue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $i++ ?>
                              <tr>
                                  <td><?php echo e($i); ?></td>
                                  <td><?php echo e($revenue->getcust?$revenue->getcust->name:"No costumer defined"); ?></td>
                                  <td><?php echo e($revenue->getsid?$revenue->getsid->sid:"No SID defined"); ?></td>
                                  <td><?php echo e($revenue->getsid?$revenue->getsid->revenue:"No revenue defined"); ?></td>
                                  <td><?php echo e($revenue->getattr?$revenue->getattr->name:"No port defined"); ?></td>
                                  <td><?php echo e($revenue->attr_no); ?></td>
                                  <td><?php echo e($revenue->updated_at); ?></td>
                                  <td><?php echo empty($revenue->updatedby->first_name)?"":$revenue->updatedby->first_name; ?> <?php echo empty($revenue->updatedby->last_name)?"":$revenue->updatedby->last_name; ?></td>
                                  <td>
                                    <?php if($revenue->status == 3): ?>
                                    <a href="#" class="btn btn-xs btn-primary btn-outline active">Active</a>
                                    <?php else: ?>
                                    <a href="#" class="btn btn-xs btn-default btn-outline">Inactive</a>
                                    <?php endif; ?>
                                  </td>
                                  <td>
                                    <?php if(Sentinel::getUser()->hasAccess(['asset.edit'])): ?>
                                      <?php if($node->getpop->offline_sts != 1): ?>
                                    <a href="<?php echo e(url('assetport/' . $revenue->id . '/edit')); ?>" class="btn btn-xs btn-primary btn-outline">Edit</a>
                                      <?php endif; ?>
                                    <?php endif; ?>
                                  </td>
                              </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </tbody>
                        </table>
                      </div>
                      <div class="col-sm-12 row" id="newRevenue" style="margin-top: 20px" >
                        <div class="col-xs-12 col-sm-12">
                          <?php echo Form::open(['url' => 'store/revenue', 'class' => 'form-horizontal']); ?>

                          <?php echo Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

                          <?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

                          <?php echo Form::hidden('asset_id', $node->id, ['class' => 'form-control']); ?>

                          <?php echo Form::hidden('sbu_id', $node->sbu_id, ['class' => 'form-control']); ?>

                          <?php echo Form::hidden('pop_id', $node->pop_id, ['class' => 'form-control']); ?>

                          <?php echo Form::hidden('attrinput', "revenue", ['class' => 'form-control']); ?>

                            <div class="form-group <?php echo e($errors->has('cust_id') ? 'has-error' : ''); ?>">
                              <?php echo Form::label('cust_id', 'Customer', ['class' => 'col-sm-2 control-label']); ?>

                              <div class="col-sm-6 col-xs-12">
                              <?php echo e(Form::select('cust_id', $customers, null, ['class' => 'form-control chosen-select CustSelect cust_chosen','style' => 'width:350px','id' => 'cust_id','placeholder'=>'Select Customer'])); ?>


                              <?php echo $errors->first('cust_id', '<p class="help-block">:message</p>'); ?>

                              </div>
                            </div>
                            <div class="form-group <?php echo e($errors->has('sid') ? 'has-error' : ''); ?>">
                                <?php echo Form::label('sid', 'SID: ', ['class' => 'col-sm-2 control-label']); ?>

                                <div class="col-sm-6 col-xs-12">
                                  <?php echo e(Form::select('sid', $customers, null, ['class' => 'form-control chosen-select SIDSelect chosen-update2 sid_chosen','style' => 'width:350px','id' => 'sid_id','placeholder'=>'Select SID'])); ?>

                                  <?php echo $errors->first('sid', '<p class="help-block">:message</p>'); ?>

                              </div>
                            </div>
                          <div class="form-group <?php echo e($errors->has('attr_type') ? 'has-error' : ''); ?>">
                            <?php echo Form::label('attr_type', 'Port Type', ['class' => 'col-sm-2 control-label']); ?>

                            <div class="col-sm-6 col-xs-12">
                              <select  name="attr_type" class="form-control  chosen-select portType" data-placeholder="Port Type" id="attr_type"  style="width: 350px">
                                <option value="0">Select Port Type</option>
                                <?php $__currentLoopData = $attrs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <?php if($attr->catAttr->parent_id == '4'): ?>
                                <option value="<?php echo e($attr->catAttr->id); ?>"><?php echo e($attr->catAttr->name); ?> <?php echo e($attr->value); ?></option>
                                  <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                            <?php echo $errors->first('attr_type', '<p class="help-block">:message</p>'); ?>

                            </div>
                          </div>
                          <div class="form-group <?php echo e($errors->has('attr_no') ? 'has-error' : ''); ?>">
                            <?php echo Form::label('attr_no', 'Port No', ['class' => 'col-sm-2 control-label']); ?>

                            <div class="col-sm-6 col-xs-12">
                              <select  name="attr_no" class="form-control chosen-select chosen-update port_chosen" data-placeholder="Port No" id="attr_no">

                              </select>
                            <?php echo $errors->first('attr_no', '<p class="help-block">:message</p>'); ?>

                            </div>
                          </div>
                          <div class="form-group <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">
                          <?php echo Form::label('status', 'Status: ', ['class' => 'col-sm-2 control-label']); ?>

                          <div class="col-sm-6">
                            <?php echo e(Form::select('status', $activations, null, ['class' => 'form-control'])); ?>

                              <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

                            </div>
                          </div>
                          <div class="form-group <?php echo e($errors->has('desc') ? 'has-error' : ''); ?>">
                            <?php echo Form::label('desc', 'Desc: ', ['class' => 'col-sm-2 control-label']); ?>

                            <div class="col-sm-6 col-xs-12">
                                  <textarea name="desc" type="text" class="form-control" placeholder="Description of Asset. [ Maks. 500 char ]" style="height: auto"></textarea>
                                <?php echo $errors->first('desc', '<p class="help-block">:message</p>'); ?>

                            </div>
                          </div>
                          <div class="hr-line-dashed"></div>
                          <div class="form-group">
                              <button type="submit" class="create_mdl btn btn-outline btn-primary pull-right" style="margin-right: 20px; ">
                                <i class="fa fa-plus-circle"></i>  Create
                              </button>
                              <a id="cancelRevenue" class="detail2 btn btn-md btn-outline btn-danger pull-right" style="margin-right: 10px">  <i class="fa fa-times-circle" ></i> Cancel</a>

                          </div>
                            <?php echo Form::close(); ?>

                        </div>
                      </div>
                    </div>
                    <div id="slot" class="tab-pane">
                      <div class="col-sm-12" id="dataAsset" style="margin-top: 20px; margin-bottom: 20px">
                        <?php if(Sentinel::getUser()->hasAccess(['asset.edit'])): ?>
                          <?php if($node->getpop->offline_sts != 1): ?>
                        <button id="addAsset" type="button" class="btn btn-sm btn-outline btn-primary pull-right">Add Slot</button>
                          <?php endif; ?>
                        <?php endif; ?>
                      </div>
                      <div class="col-sm-12 table-responsive" id="tableAsset">
                        <table class="table table-striped table-bordered table-hover DataTable3" id="editable3">
                          <thead>
                            <tr>
                              <th>No.</th>
                              <th>QRCode</th>
                              <th>Serial No</th>
                              <th>Brand</th>
                              <th>Model</th>
                              <th>Slot Name</th>
                              <th>Slot No</th>
                              <th>Created By</th>
                              <th>Created At</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i = 0 ?>
                            <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $i++ ?>
                              <tr>
                                  <td><?php echo e($i); ?></td>
                                  <td><?php echo empty($detail->getasset->qr_code)? "No QR Data" : $detail->getasset->qr_code; ?></td>
                                  <td><?php echo empty($detail->getasset->serial_no)? "No Serial Data" : $detail->getasset->serial_no; ?></td>
                                  <td><?php echo e($detail->getbrand->name); ?></td>
                                  <td><?php echo e($detail->getmodel->name); ?></td>
                                  <td><?php echo e($detail->attr_name); ?></td>
                                  <td><?php echo e($detail->attr_no); ?></td>
                                  <td><?php echo empty($detail->updatedby->first_name)?"":$detail->updatedby->first_name; ?> <?php echo empty($detail->updatedby->last_name)?"":$detail->updatedby->last_name; ?></td>
                                  <td><?php echo e($detail->updated_at); ?></td>
                                  <td>
                                    <?php if($detail->status == 3): ?>
                                    <a href="#" class="btn btn-xs btn-primary btn-outline active">Active</a>
                                    <?php else: ?>
                                    <a href="#" class="btn btn-xs btn-default btn-outline">Inactive</a>
                                    <?php endif; ?>
                                  </td>
                                  <td>
                                    <?php if(Sentinel::getUser()->hasAccess(['asset.edit'])): ?>
                                      <?php if($node->getpop->offline_sts != 1): ?>
                                    <a href="<?php echo e(url('assetslot/' . $detail->id . '/edit')); ?>" class="btn btn-xs btn-primary btn-outline">Edit</a>
                                      <?php endif; ?>
                                    <?php endif; ?>
                                  </td>
                              </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </tbody>
                        </table>
                      </div>

                      <div class="row col-sm-12" id="newAsset" style="margin-top: 20px">

                          <div class="col-xs-12 col-sm-12">
                            <?php echo Form::open(['url' => 'store/detail', 'class' => 'form-horizontal']); ?>

                            <?php echo Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

                            <?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

                            <?php echo Form::hidden('attrinput', "asset", ['class' => 'form-control']); ?>

                            <?php echo Form::hidden('asset_id', $node->id, ['class' => 'form-control']); ?>

                            <div class="form-group <?php echo e($errors->has('attr_type') ? 'has-error' : ''); ?>">
                              <?php echo Form::label('attr_type', 'Slot Type*', ['class' => 'col-sm-2 control-label']); ?>

                              <div class="col-sm-6 col-xs-12">
                                <select  name="attr_type" class="form-control  chosen-select slotType chosen-update" data-placeholder="Port Type" id="attr_type" width="100%">
                                  <option value="0">Select Slot Type</option>
                                  <?php $__currentLoopData = $attrs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($attr->catAttr->parent_id == '9'): ?>
                                    <option value="<?php echo e($attr->catAttr->id); ?>"><?php echo e($attr->catAttr->name); ?></option>
                                    <?php endif; ?>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                              <?php echo $errors->first('attr_type', '<p class="help-block">:message</p>'); ?>

                              </div>
                            </div>
                            <div class="form-group <?php echo e($errors->has('attr_no') ? 'has-error' : ''); ?>">
                              <?php echo Form::label('attr_no', 'Slot No*', ['class' => 'col-sm-2 control-label']); ?>

                              <div class="col-sm-6 col-xs-12">
                                <select name="attr_no" class="col-sm-12 form-control chosen-select chosen-update slot_chosen" data-placeholder="Slot No" id="slot_no" style="width: 350px">
                                </select>
                              <?php echo $errors->first('attr_no', '<p class="help-block">:message</p>'); ?>

                              </div>
                            </div>
                            <div class="form-group <?php echo e($errors->has('brand_id') ? 'has-error' : ''); ?>">
                              <?php echo Form::label('brand_id', 'Brand*', ['class' => 'col-sm-2 control-label']); ?>

                              <div class="col-sm-6 col-xs-12">
                              <!--  <select  name="brand_id" class="form-control select2_demo_1" data-placeholder="Select Brand" id="brand_id" style="width: 350px">
                                </select>-->
                                <select name="brand_id" class="col-sm-12 form-control chosen-select BrandSelect chosen-update2 brand_chosen" data-placeholder="Select Brand" id="brand_idx" style="width: 350px">

                                </select>
                              <?php echo $errors->first('brand_id', '<p class="help-block">:message</p>'); ?>

                              </div>
                            </div>
                            <div class="form-group <?php echo e($errors->has('model_id') ? 'has-error' : ''); ?>">
                              <?php echo Form::label('model_id', 'Model*', ['class' => 'col-sm-2 control-label']); ?>

                              <div class="col-sm-6 col-xs-12">
                                <select name="model_id" class="col-sm-12 form-control chosen-select ModelSelect chosen-update model_chosen" data-placeholder="Select Model" id="model_id" style="width: 350px">

                                </select>
                              <?php echo $errors->first('model_id', '<p class="help-block">:message</p>'); ?>

                              </div>
                            </div>
                            <div class="form-group <?php echo e($errors->has('asset_child') ? 'has-error' : ''); ?>">
                              <?php echo Form::label('asset_child', 'Asset*', ['class' => 'col-sm-2 control-label']); ?>


                              <div class="col-sm-6 col-xs-12">
                                <select name="asset_child" class="col-sm-12 form-control chosen-select AssetSelect chosen-update3 asset_chosen" data-placeholder="Select Serial No" id="asset_id" style="width: 350px">

                                </select>
                              <?php echo $errors->first('asset_child', '<p class="help-block">:message</p>'); ?>

                              </div>

                            </div>
                            <div class="form-group <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">
                            <?php echo Form::label('status', 'Status*', ['class' => 'col-sm-2 control-label']); ?>

                            <div class="col-sm-6">
                              <?php echo e(Form::select('status', $activations, null, ['class' => 'form-control'])); ?>

                                <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

                              </div>
                            </div>
                            <div class="form-group <?php echo e($errors->has('attr_name') ? 'has-error' : ''); ?>">
                              <?php echo Form::label('attr_name', 'Slot Name*', ['class' => 'col-sm-2 control-label']); ?>

                              <div class="col-sm-4 col-xs-12">
                                <?php echo Form::text('attr_name', null, ['class' => 'form-control','placeholder'=>'Slot Name.']); ?>

                                <?php echo $errors->first('attr_name', '<p class="help-block">:message</p>'); ?>

                              </div>
                            </div>
                            <div class="form-group <?php echo e($errors->has('desc') ? 'has-error' : ''); ?>">
                              <?php echo Form::label('desc', 'Desc', ['class' => 'col-sm-2 control-label']); ?>

                              <div class="col-sm-6 col-xs-12">
                                    <textarea name="desc" type="text" class="form-control" placeholder="Description of Asset. [ Maks. 500 char ]" style="height: auto"></textarea>
                                  <?php echo $errors->first('desc', '<p class="help-block">:message</p>'); ?>

                              </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                              <a id="cancelAsset" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>

                              <button type="submit" class="create_mdl btn btn-outline btn-primary pull-right" style="margin-right: 20px; ">
                                  <i class="fa fa-plus-circle"></i>  Create
                                </button>
                            </div>
                              <?php echo Form::close(); ?>

                          </div>
                      </div>
                      <div class="row col-sm-12" id="feditAsset" style="margin-top: 20px">

                      </div>
                    </div>
                  <?php };?>
              </div>
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

<?php echo e(HTML::script('assets_back/js/plugins/blueimp/jquery.blueimp-gallery.min.js')); ?>

<!-- Page-Level Scripts -->
<script>
  jQuery(document).ready(function() {

    //slide image
    $('#links a.image').on('click', function(event){
    	event = event || window.event;
      var target = event.target || event.srcElement,
          link = target.src ? target.parentNode : target.parentNode,
          options = { index: link, event: event },
          links = $(this);
      blueimp.Gallery(links, options);
    });

    $('#links a.delete-confirm-ajax').on('click',function(){
      var val = $(this).val();
      alert(val);
    	//alert(id_img);
    });

    $(".deleteImage").click(function() {
    var val = $(this).val(),
          x = confirm('Are you sure you want to delete '+val+' ?');
    if (x)
      window.location.href = '/asset/'+val+'/<?php echo e($node->id); ?>/delete';
    else
      return false;

    });


     $('#tabMenu a[href="#<?php echo e(old('tab')); ?>"]').tab('show')
     $('#tabMenu a[href="#<?php echo e(old('tab2')); ?>"]').tab('show')

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

     $('.portType').on('change', function(e){

        if ($(this).find(':selected').val() != '') {
            var val     = $(this).find(':selected').val(),
                item_d  = $(this).find(':selected').data(),
                url     =  window.location.origin+'/attrvalue?attr_id='+val+'&model_id=<?php echo e($node->getmodel->id); ?>'+'&asset_id=<?php echo e($node->id); ?>';
              //alert(val);
              $.ajax({
                  url : url,
                  type: "GET",
                  dataType: 'html',
                  success: function(datas){
                      $('.port_chosen').html(datas);
                      $(".chosen-update").trigger("chosen:updated");
                      return false;
                  }
              });
        }
      });

    $('.slotType').on('change', function(e){

     if ($(this).find(':selected').val() != '') {

            // SLOT NO
         var val     = $(this).find(':selected').val(),
             item_d  = $(this).find(':selected').data(),
             url     =  window.location.origin+'/attrvalue2?attr_id='+val+'&model_id=<?php echo e($node->getmodel->id); ?>'+'&asset_id=<?php echo e($node->id); ?>';
          // alert(val);
           $.ajax({
               url : url,
               type: "GET",
               dataType: 'html',
               success: function(datas){
                   $('.slot_chosen').html(datas);
                   $(".chosen-update").trigger("chosen:updated");
                   return false;
               }
           });
           //END SLOT NO
           //BRAND SLOT
           var url2     =  window.location.origin+'/brandslot?data=' +val;
             //alert(val);
             $.ajax({
                 url : url2,
                 type: "GET",
                 dataType: 'html',
                 success: function(datas2){
                     $('.brand_chosen').html(datas2);
                     $(".chosen-update2").trigger("chosen:updated");
                     return false;
                 }
             });
          //END BRAND SLOT
          //Asset SLOT
          var url3    =  window.location.origin+'/assetslot?data='+val+'&pop_id=<?php echo e($node->pop_id); ?>';
            //alert(val);
            $.ajax({
                url : url3,
                type: "GET",
                dataType: 'html',
                success: function(datas3){
                    $('.asset_chosen').html(datas3);
                    $(".chosen-update3").trigger("chosen:updated");
                    return false;
                }
            });
          //End Asset Slot
     }

   });
   $('.BrandSelect').on('change', function(e){

     if ($(this).find(':selected').val() != '') {

            // SLOT NO
         var attr_type =  $('.slotType').find(':selected').val(),
             val     = $(this).find(':selected').val(),
             item_d  = $(this).find(':selected').data(),
             url     =  window.location.origin+'/modelslot?data='+attr_type+'&brand_id='+ val;

             $.ajax({
                 url : url,
                 type: "GET",
                 dataType: 'html',
                 success: function(datas){
                     $('.model_chosen').html(datas);
                     $(".chosen-update").trigger("chosen:updated");
                     return false;
                 }
             });

             //Material SLOT
             var  val     = $(this).find(':selected').val(),
                  item_d  = $(this).find(':selected').data(),
                  url2     =  window.location.origin+'/materialslotbybrand?brand_id=' +val;
               $.ajax({
                   url : url2,
                   type: "GET",
                   dataType: 'html',
                   success: function(datas2){
                       $('.material_chosen').html(datas2);
                       $(".chosen-update2").trigger("chosen:updated");
                       return false;
                   }
               });

   }
   });
   $('.ModelSelect').on('change', function(e){

     if ($(this).find(':selected').val() != '') {

   //Material SLOT
   var  val     = $(this).find(':selected').val(),
        item_d  = $(this).find(':selected').data(),
        url2     =  window.location.origin+'/materialslot?model_id=' +val;
     $.ajax({
         url : url2,
         type: "GET",
         dataType: 'html',
         success: function(datas2){
             $('.material_chosen').html(datas2);
             $(".chosen-update2").trigger("chosen:updated");
             return false;
         }
     });


    var url3  =  window.location.origin+'/assetbymodel?model_id='+val+'&pop_id=<?php echo e($node->pop_id); ?>';
  $.ajax({
      url : url3,
      type: "GET",
      dataType: 'html',
      success: function(datas3){
          $('.asset_chosen').html(datas3);
          $(".chosen-update3").trigger("chosen:updated");
          return false;
      }
  });

   }
   });
   $('.AssetSelect').on('change', function(e){

     if ($(this).find(':selected').val() != '') {
   //Material SLOT
   var  val     = $(this).find(':selected').val(),
        item_d  = $(this).find(':selected').data(),
        url2     =  window.location.origin+'/modelslotbyasset?asset_id=' +val;
     $.ajax({
         url : url2,
         type: "GET",
         dataType: 'html',
         success: function(datas){
             $('.model_chosen').html(datas);
             $(".chosen-update").trigger("chosen:updated");
             return false;
         }
     });

  var url3     =  window.location.origin+'/brandslotbyasset?asset_id=' +val;
  $.ajax({
      url : url3,
      type: "GET",
      dataType: 'html',
      success: function(datas3){
          $('.brand_chosen').html(datas3);
          $(".chosen-update2").trigger("chosen:updated");
          return false;
      }
  });

   }
   });
   //END Material SLOT

    $(".select2_demo_1").select2();
    //if modelslot changed
    //add slot click get value


    $('#addRevenue').on('click', function(e){
        $('#dataRevenue').hide();
        $('#tableReveneu').hide();
        $('#newRevenue').slideDown('slow');
    });
    $('#cancelAsset').on('click', function(e){
        $('#dataAsset').show();
        $('#tableAsset').show();
        $('#newAsset').slideUp('slow');
    });

    $('#cancelRevenue').on('click', function(e){
        $('#dataRevenue').show();
        $('#tableReveneu').show();
        $('#newRevenue').slideUp('slow');
    });
    $('#addAsset').on('click', function(e){
      console.log(e);
      var value = e.target.value;
      $('#dataAsset').hide();
      $('#tableAsset').hide();
      $('#newAsset').slideDown('slow');
      });
      $('#editAsset').on('click', function(e){
        console.log(e);
        var value = e.target.value;
        $('#dataAsset').hide();
        $('#tableAsset').hide();
        $('#newAsset').slideUp('slow');
        $('#feditAsset').slideDown('slow');
        });

        $('.CustSelect').on('change', function(e){
          if ($(this).find(':selected').val() != '') {

              var val     = $(this).find(':selected').val(),
                  item_d  = $(this).find(':selected').data(),
                  url     =  window.location.origin+'/datasid?cust_id=' + val;

                  $.ajax({
                      url : url,
                      type: "GET",
                      dataType: 'html',
                      success: function(datas){
                          $('.sid_chosen').html(datas);
                          $(".chosen-update2").trigger("chosen:updated");
                          return false;
                      }
                  });


        }
        });
        /* Init DataTables */
        var oTable = $('#editable').DataTable();
        var oTable = $('#editable2').DataTable({order:[[5,'asc']]});
        var oTable = $('#editable3').DataTable();
        var oTable = $('#editable4').DataTable();
        var oTable = $('#editable5').DataTable({order:[[3,'desc']]});
    });

    function ConfirmDelete()
  {
  var x = confirm("Are you sure you want to delete?");
  if (x)
    return true;
  else
    return false;
  }
   $('#newAsset').hide();
    $('#newRevenue').hide();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>