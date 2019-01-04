<?php $__env->startSection('title'); ?>
QR Code
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Generate QR Code
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php echo e(HTML::style('assets_back/css/plugins/select2/select2.min.css')); ?>

<?php echo e(HTML::style('assets_back/css/plugins/dataTables/datatables.min.css')); ?>

<?php echo e(HTML::style('assets_back/css/plugins/iCheck/custom.css')); ?>

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
        <ol class="breadcrumb col-sm-7 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
          <li class="active">
              <a class="detail2" href="">
                QRCode
              </a>
          </li>
          </ol>
          <a href="<?php echo e(url()->previous()); ?>" class="btn btn-sm btn-outline btn-warning pull-right">
              <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
          </a>
          <?php if(Sentinel::getUser()->hasAccess(['qrcode.create'])): ?>
          <a href="<?php echo e(url('qrcode/create')); ?>">
          <button class="detail2 btn btn-sm btn-outline btn-primary pull-right" style="margin-right: 10px">
              <i class="fa fa-plus-circle" style="margin-right: 5px"></i>
                  Add QRCode
          </button>
          </a>
          <?php endif; ?>
         <button class="btn btn-sm btn-outline btn-primary pull-right" onClick="printQR()" style="margin-right: 10px">
              <i class="fa fa-print" style="margin-right: 5px"></i>
                  Print QR
          </button>
          <select class="form-control chosen-select chosen-update SBUSelect" style="max-width:185px;margin-right: 15px;" onchange="if (this.value) window.location.href=this.value">
            <option value="<?php echo e(url('qrcode')); ?>">Select SBU</option>
            <?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e(url('qrcode/' . $filter->id . '/filter')); ?>" <?php if ($filter->id == $id) echo ' selected="selected"'; ?>>
              <?php echo e($filter->name); ?>

            </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
       

    </div>
  <div class="col-xs-12 col-sm-12 ibox-content row" style="min-height:65vh;">
    <input id="dataSelected" name="inputan" type="text" class="form-control hide" value=""></input>
    <input id="idSelected" name="inputan" type="text" class="form-control hide" value=""></input>
    <div class="tabs-container" id="dataTabs">
        <ul class="nav nav-tabs" id="tabMenu">
            <li class="<?php echo e($idl); ?>"><a data-toggle="tab" href="#iddle" class="tabQR" data-status="true">Idle</a></li>
            <li class="<?php echo e($book); ?>"><a data-toggle="tab" href="#booked"  class="tabQR"  data-status="false">Booked </a></li>
            <li class="<?php echo e($use); ?>"><a data-toggle="tab" href="#used"  class="tabQR" data-status="false">Used</a></li>
        </ul>
        <div class="tab-content">
            <div id="iddle" class="tab-pane <?php echo e($idl); ?>">
              <br/>
              <div class="row">
                <div class="col-sm-1 m-b-xs">
                  <select class="input-sm form-control input-s-sm inline" id="SelectRow">
                  <option value="">Rows</option>
                  <option value="10" <?php if ($start == 10) echo ' selected="selected"'; ?> >10</option>
                  <option value="25" <?php if ($start == 25) echo ' selected="selected"'; ?> >25</option>
                  <option value="50" <?php if ($start == 50) echo ' selected="selected"'; ?> >50</option>
                  <option value="100" <?php if ($start == 100) echo ' selected="selected"'; ?> >100</option>
                  <option value="150" <?php if ($start == 150) echo ' selected="selected"'; ?> >150</option>
                  </select>
                </div>
                <div class="col-sm-8 m-b-xs"></div>
                <div class="col-sm-3">
                   <div class="input-group">
                    <input type="text" placeholder="Search" value="<?php echo empty($search)?"" : $search; ?>" class="input-sm form-control valueSearch" id="idlvalueSearch"> 
                    <span class="input-group-btn">
                       <button type="button" class="btn btn-sm btn-primary btnSearch" id="idlbtnSearch"> Go!</button> 
                     </span>
                   </div>
                </div>
                </div>
              <div class="table-responsive" style="margin-top: 20px">

                <table class="table table-striped table-hover" id="">
                    <thead>

                        <tr>
                            <th><input type="checkbox" class="i-checks selectAll"/></th>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Qrcode</th>
                            <th>SBU</th>
                            <th>Remark</th>
                            <th>Status</th>
                            <th >Total Print</th>
                            <th>Last Updated</th>
                            <th>Updated By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $i= ($start_idl - 1) * 10; ?>
                    <?php $__currentLoopData = $qrcode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $i++ ?>
                        <tr>
                            <td> <input type="checkbox" class="i-checks child" data-checked="false" id="ck_<?php echo e($i); ?>" data-id="<?php echo e($item->id); ?>" data-qr="<?php echo e($item->qrcode); ?>"></td>
                            <td><?php echo e($i); ?></td>
                            <td style="width: 10%">
                              <div id="qr_<?php echo e($item->id); ?>" style="max-width: 10%"></div>
                            </td>
                            <td><?php echo e($item->qrcode); ?></td>
                            <td><?php echo e(empty($item->getsbu->name)?null :  $item->getsbu->name); ?></td>
                            <td><?php echo e($item->remark); ?></td>
                            <td><?php if($item->status == 0): ?> Idle <?php elseif($item->status == 1): ?> Booked <?php elseif($item->status == 2): ?> Used <?php endif; ?></td>
                            <td style="text-align: center"><?php echo !empty($item->qrtotal)? $item->qrtotal: 0; ?></td>
                            <td><?php echo e($item->updated_at); ?></td>
                            <td><?php echo e($item->updatedby->first_name); ?> <?php echo e($item->updatedby->last_name); ?></td>
                          <td>
                                <a href="<?php echo e(url('qrcode/' . $item->id . '/show')); ?>" class="btn btn-primary btn-xs">View</a>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                Showing <?php echo e($qrcode->firstItem()); ?> to <?php echo e($qrcode->lastItem()); ?> of <?php echo e($qrcode->total()); ?> entries
             
                <div style="text-align: right;">
                <?php echo $qrcode->render(); ?>

                </div>
              </div>
            </div>
            <div id="booked" class="tab-pane <?php echo e($book); ?>">
              <br/>
              <div class="row">
                <div class="col-sm-1 m-b-xs">
                  <select class="input-sm form-control input-s-sm inline" id="SelectRow2">
                  <option value="">Rows</option>
                  <option value="10" <?php if ($start == 10) echo ' selected="selected"'; ?> >10</option>
                  <option value="25" <?php if ($start == 25) echo ' selected="selected"'; ?> >25</option>
                  <option value="50" <?php if ($start == 50) echo ' selected="selected"'; ?> >50</option>
                  <option value="100" <?php if ($start == 100) echo ' selected="selected"'; ?> >100</option>
                  <option value="150" <?php if ($start == 150) echo ' selected="selected"'; ?> >150</option>
                  </select>
                </div>
                <div class="col-sm-8 m-b-xs"></div>
                <div class="col-sm-3">
                   <div class="input-group">
                    <input type="text" placeholder="Search" value="<?php echo empty($search)?"" : $search; ?>" class="input-sm form-control valueSearch" id="bookvalueSearch"> 
                    <span class="input-group-btn">
                       <button type="button" class="btn btn-sm btn-primary btnSearch" id="bookbtnSearch"> Go!</button> 
                     </span>
                   </div>
                </div>
                </div>
              <div class="table-responsive" style="margin-top: 20px">
                <table class="table table-striped table-hover" id="">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Qrcode</th>
                            <th>SBU</th>
                            <th>Remark</th>
                            <th>Status</th>
                            <th >Total Print</th>
                            <th>Last Updated</th>
                            <th>Updated By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $j= ($start_book - 1) * 10; ?>
                    <?php $__currentLoopData = $booked; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $j++ ?>
                        <tr>
                            <td><?php echo e($j); ?></td>
                            <td style="width: 10%"><div id="qr_<?php echo e($b->id); ?>" style="max-width: 10%"></div></td>
                            <td><?php echo e($b->qrcode); ?></td>
                            <td><?php echo e(empty($b->getsbu->name)?null :  $b->getsbu->name); ?></td>
                            <td><?php echo e($b->remark); ?></td>
                            <td><?php if($b->status == 0): ?> Idle <?php elseif($b->status == 1): ?> Booked <?php elseif($b->status == 2): ?> Used <?php endif; ?></td>
                            <td style="text-align: center"><?php echo !empty($b->qrtotal)? $b->qrtotal: 0; ?></td>
                            <td><?php echo e($b->updated_at); ?></td>
                            <td><?php echo e($b->updatedby->first_name); ?> <?php echo e($b->updatedby->last_name); ?></td>
                          <td>
                                <a href="<?php echo e(url('qrcode/' . $b->id . '/show')); ?>" class="btn btn-primary btn-xs">View</a>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                Showing <?php echo e($booked->firstItem()); ?> to <?php echo e($booked->lastItem()); ?> of <?php echo e($booked->total()); ?> entries
             
                <div style="text-align: right;">
                <?php echo $booked->render(); ?>

                </div>
              </div>
            </div>
            <div id="used" class="tab-pane <?php echo e($use); ?>">
              <br/>
              <div class="row">
                <div class="col-sm-1 m-b-xs">
                  
                  <select class="input-sm form-control input-s-sm inline" id="SelectRow3">
                  <option value="">Rows</option>
                  <option value="10" <?php if ($start == 10) echo ' selected="selected"'; ?> >10</option>
                  <option value="25" <?php if ($start == 25) echo ' selected="selected"'; ?> >25</option>
                  <option value="50" <?php if ($start == 50) echo ' selected="selected"'; ?> >50</option>
                  <option value="100" <?php if ($start == 100) echo ' selected="selected"'; ?> >100</option>
                  <option value="150" <?php if ($start == 150) echo ' selected="selected"'; ?> >150</option>
                  </select> 

                </div>
                
                <div class="col-sm-8 m-b-xs"></div>
                <div class="col-sm-3">
                   <div class="input-group">
                    <input type="text" placeholder="Search" value="<?php echo empty($search)?"" : $search; ?>" class="input-sm form-control valueSearch" id="usevalueSearch"> 
                    <span class="input-group-btn">
                       <button type="button" class="btn btn-sm btn-primary btnSearch" id="usebtnSearch"> Go!</button> 
                     </span>
                   </div>
                </div>
                </div>
              <div class="table-responsive" style="margin-top: 20px">
                <table class="table table-striped table-hover" id="">
                    <thead>
                        <tr><th><input type="checkbox" class="i-checks selectAll2"/></th>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Qrcode</th>
                            <th>SBU</th>
                            <th>Remark</th>
                            <th>Status</th>
                            <th >Total Print</th>
                            <th>Last Updated</th>
                            <th>Updated By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $k= ($start_use - 1) * 10; $l = $i+1 ?>
                    <?php $__currentLoopData = $used; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $k++; $l++ ?>
                        <tr>
                          <td> <input type="checkbox" class="i-checks child2" data-checked="false" id="ck_<?php echo e($l); ?>" data-id="<?php echo e($u->id); ?>" data-qr="<?php echo e($u->qrcode); ?>"></td>
                            <td><?php echo e($k); ?></td>
                            <td style="width: 10%"><div id="qr_<?php echo e($u->id); ?>" style="max-width: 10%"></div></td>
                            <td><?php echo e($u->qrcode); ?></td>
                            <td><?php echo e(empty($u->getsbu->name)?null :  $u->getsbu->name); ?></td>
                            <td><?php echo e($u->remark); ?></td>
                            <td><?php if($u->status == 0): ?> Idle <?php elseif($u->status == 1): ?> Booked <?php elseif($u->status == 2): ?> Used <?php endif; ?></td>
                            <td style="text-align: center"><?php echo !empty($u->qrtotal)? $u->qrtotal: 0; ?></td>
                            <td><?php echo e($u->updated_at); ?></td>
                            <td><?php echo e($u->updatedby->first_name); ?> <?php echo e($u->updatedby->last_name); ?></td>
                          <td>
                                <a href="<?php echo e(url('qrcode/' . $u->id . '/show')); ?>" class="btn btn-primary btn-xs">View</a>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                Showing <?php echo e($used->firstItem()); ?> to <?php echo e($used->lastItem()); ?> of <?php echo e($used->total()); ?> entries
             
                <div style="text-align: right;">
                <?php echo $used->render(); ?>

                </div>
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



<?php echo e(HTML::script('assets_back/js/qrcode.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/dataTables/datatables.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/select2/select2.full.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/iCheck/icheck.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/chosen/chosen.jquery.js')); ?>


<!-- Page-Level Scripts -->
<script>
     <?php $__currentLoopData = $qrcode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        var qr = 'qr_'+ <?php echo e($q->id); ?>;
        var qrcode = new QRCode(""+qr+"", {
            text: "<?php echo e($q->qrcode); ?>",
            width: 64,
            height: 64,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
        //new QRCode(document.getElementById(""+qr+""), "<?php echo e($q->qrcode); ?>");
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

     <?php $__currentLoopData = $booked; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        var qrs = 'qr_'+ <?php echo e($bs->id); ?>;
        var qrcode = new QRCode(""+qrs+"", {
            text: "<?php echo e($bs->qrcode); ?>",
            width: 64,
            height: 64,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
        //new QRCode(document.getElementById(""+qr+""), "<?php echo e($bs->qrcode); ?>");
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      <?php $__currentLoopData = $used; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $us): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        var qrc = 'qr_'+ <?php echo e($us->id); ?>;
        var qrcode = new QRCode(""+qrc+"", {
            text: "<?php echo e($us->qrcode); ?>",
            width: 64,
            height: 64,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
        //new QRCode(document.getElementById(""+qr+""), "<?php echo e($us->qrcode); ?>");
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


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



$('#tabMenu a[href="#<?php echo e(old('tab')); ?>"]').tab('show');

$('#SelectRow').on('change', function(e){
     console.log(e);

     var value = e.target.value;

     if(value !== ""){

     window.location.href = '?start='+value+'&search=<?php echo e($search); ?>&iddle=1' ;
    }
    else{

      window.location.href= '?start=10&search=<?php echo e($search); ?>&iddle=1' ;

    }

     });

$('#SelectRow2').on('change', function(e){
     console.log(e);

     var value = e.target.value;

     if(value !== ""){

     window.location.href = '?start='+value+'&search=<?php echo e($search); ?>&booked=1' ;
    }
    else{

      window.location.href= '?start=10&search=<?php echo e($search); ?>&booked=1' ;

    }

     });

$('#SelectRow3').on('change', function(e){
     console.log(e);

     var value = e.target.value;

     if(value !== ""){

     window.location.href = '?start='+value+'&search=<?php echo e($search); ?>&used=1' ;
    }
    else{

      window.location.href= '?start=10&search=<?php echo e($search); ?>&used=1' ;

    }

     });


$('#idlbtnSearch').on('click', function(e){
     console.log(e);
     var type_id = e.target.value;
   
     var value =  $('#idlvalueSearch').val();

     if(value !== ""){

     window.location.href = '?search='+value+'&iddle=1&start=<?php echo e($start); ?>' ;
    }
    else{

      window.location.href= '?iddle=1' ;

    }

     });

$('#bookbtnSearch').on('click', function(e){
     console.log(e);
     var type_id = e.target.value;
   
     var value =  $('#bookvalueSearch').val();

     if(value !== ""){

     window.location.href= '?search='+value+'&booked=1&start=<?php echo e($start); ?>' ;
    }
    else{

      window.location.href= '?booked=1' ;

    }

     });

$('#usebtnSearch').on('click', function(e){
     console.log(e);
     var type_id = e.target.value;
   
     var value =  $('#usevalueSearch').val();

     if(value !== ""){

     window.location.href= '?search='+value+'&used=1&start=<?php echo e($start); ?>' ;
    }
    else{

      window.location.href= '?used=1' ;

    }

     });

        /* Init DataTables */
        $('.i-checks').iCheck({
              checkboxClass: 'icheckbox_square-green',
              radioClass: 'iradio_square-green',
          });

          var checkAll = $('.i-checks.selectAll');
          var checkboxes = $('.i-checks.child');

          checkAll.on('ifChecked ifUnchecked', function(event) {
              if (event.type == 'ifChecked') {
                  checkboxes.iCheck('check');
              } else {
                  checkboxes.iCheck('uncheck');
              }
          });

          checkboxes.on('ifChanged', function(event){
              if(checkboxes.filter(':checked').length == checkboxes.length) {
                  checkAll.prop('checked', 'checked');
              } else {
                  checkAll.removeProp('checked');
              }
              checkAll.iCheck('update');
              dataCheck();
          });


          function dataCheck() {
              var ck = [];
              var codex = [];
              var childs = checkboxes.filter(':checked');
              //console.log(childs);
              childs.each(function (index, value) {
                      var id = $(this).attr("id");
                      var code = $(this).attr("data-id");
                      var lang = $(this).attr("data-qr");
                      ck.push(lang);
                      codex.push(code);

              });
              //console.log(ck);
              $("#dataSelected").val(ck);
              $("#idSelected").val(codex);
          }



//i-check function used

  var checkAll2 = $('.i-checks.selectAll2');
          var checkboxes2 = $('.i-checks.child2');

          checkAll2.on('ifChecked ifUnchecked', function(event) {
              if (event.type == 'ifChecked') {
                  checkboxes2.iCheck('check');
              } else {
                  checkboxes2.iCheck('uncheck');
              }
          });

          checkboxes2.on('ifChanged', function(event){
              if(checkboxes2.filter(':checked').length == checkboxes2.length) {
                  checkAll2.prop('checked', 'checked');
              } else {
                  checkAll2.removeProp('checked');
              }
              checkAll2.iCheck('update');
              dataCheck2();
          });


          function dataCheck2() {
              var ck2 = [];
              var codex2 = [];
              var childs2 = checkboxes2.filter(':checked');
              //console.log(childs);
              childs2.each(function (index, value) {
                      var id2 = $(this).attr("id");
                      var code2 = $(this).attr("data-id");
                      var lang2 = $(this).attr("data-qr");
                      ck2.push(lang2);
                      codex2.push(code2);

              });
              //console.log(ck);
              $("#dataSelected").val(ck2);
              $("#idSelected").val(codex2);
          }


        var oTable = $('#editable').DataTable();
        var oTable = $('#editable-2').DataTable();
        var oTable = $('#editable-3').DataTable();
    });


  function printQR(){

    var qrData = $("#dataSelected").val(),
        qrId = $("#idSelected").val(),
        csrf = $('meta[name="csrf-token"]').attr('content'),
        url = window.location.origin+'/printqr?qrcode='+qrData+'&qrId='+qrId;
    //alert(qrId);
    $.ajax({
      url : url,
      type: "GET",
      dataType: 'html',
      data: {_token: csrf},
      success: function(html){
        window.open(url,'_self');
        //window.open(url, "_blank");
        //location.reload(url);
        },
        error: function (html) {
            console.log(data);
        }
    });
  }

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