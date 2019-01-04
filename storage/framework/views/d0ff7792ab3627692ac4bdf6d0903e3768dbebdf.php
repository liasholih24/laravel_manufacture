<?php $__env->startSection('title'); ?>
QRCODE
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Manage your QRCODE
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>

<?php echo e(HTML::style('assets_back/css/plugins/dataTables/datatables.min.css')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/jspdf/jspdf.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/jspdf/plugins/html2canvas.js')); ?>


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
            <a href="<?php echo e(url('qrcode')); ?>">
              QRCODE
            </a>
          </li>
          <li class="active">
            <a href="<?php echo e(url('qrcode/'. $qrcode->id .'/show')); ?>">
              <?php echo e($qrcode->qrcode); ?>

            </a>
          </li>
        </ol>
        <a href="<?php echo e(url('qrcode')); ?>">
          <button class="btn btn-sm btn-outline btn-warning pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
          </button>
        </a>
      </div>
      <div class="row ibox-content" style="min-height: 65vh; ">
        <div class="row col-sm-12">
            <div class="row col-sm-3">
                <div id="qrcode" style="max-width: 80%; height: auto"></div>
            </div>
            <div class="row col-sm-9">
                <h2><?php echo e($qrcode->qrcode); ?></h2>
                <small>
                  <i class="fa fa-clock-o"></i>
                  Last updated at <?php echo e($qrcode->updated_at); ?> by <strong>
                  </strong>
                </small>
                <div class="row col-sm-12" style="margin: 10px">
                    <button class="btn btn-sm btn-outline btn-primary viewDetail" style="margin-right: 10px; margin-left: -25px">
                        <i class="fa fa-info" style="margin-right: 5px"></i> Detail
                    </button>
                    <button class="btn btn-sm btn-outline btn-primary viewLog" style="margin-right: 10px">
                        <i class="fa fa-book" style="margin-right: 5px"></i> Log
                    </button>
                    <button class="btn btn-sm btn-outline btn-primary viewPrint" style="margin-right: 10px">
                        <i class="fa fa-file-picture-o" style="margin-right: 5px"></i> Image
                    </button>

                    <button class="btn btn-sm btn-outline btn-primary printQrcode"  onclick="javascript:printdiv();" style="margin-right: 10px">
                        <i class="fa fa-print" style="margin-right: 5px"></i> Print
                    </button>
                </div>
                <div class="col-sm-12" id="detail">
                    
                </div>

                <div class="col-sm-12" id="log">
                </div>
                <br>
                <div class="row col-sm-12" id="print" style="width: 400px; background-color: #fff;">
                    <div style="width: 100%; margin-left: -10px">
                        <div style="width: 40%; margin-top: 20px" class="pull-left">
                            <div style="margin: 7px; width: 100%">
                                    <div id="qr1"  class="pull-left" style="margin-right: 10px">
                                      <img src="data:image/png;base64, <?php echo base64_encode(QrCode::format('png')->size(50)->margin(0)->generate($qrcode->qrcode)); ?> " style="max-height:30px">
                                    </div>
                                    <p style="margin: 0px; font-size: 9px"><small>M.ASET ICON+</small></p>
                                    <p style="margin: 0px; font-size: 9px"><small><?php echo substr($qrcode->qrcode, 0, 9) ;?></small></p>
                                    <p style="margin: 0px; font-size: 9px"><small><?php echo substr($qrcode->qrcode, 9, 9) ;?></small></p>
                            </div>
                            <div style="margin: 7px; width: 100%">
                                    <div id="qr2"  class="pull-left" style="margin-right: 10px">
                                      <img src="data:image/png;base64, <?php echo base64_encode(QrCode::format('png')->size(50)->margin(0)->generate($qrcode->qrcode)); ?> " style="max-height:30px">
                                    </div>
                                    <p style="margin: 0px; font-size: 9px"><small>M.ASET ICON+</small></p>
                                    <p style="margin: 0px; font-size: 9px"><small><?php echo substr($qrcode->qrcode, 0, 9) ;?></small></p>
                                    <p style="margin: 0px; font-size: 9px"><small><?php echo substr($qrcode->qrcode, 9, 9) ;?></small></p>
                            </div>
                             <div style="margin: 7px; width: 100%">
                                    <div id="qr3"  class="pull-left" style="margin-right: 10px">
                                      <img src="data:image/png;base64, <?php echo base64_encode(QrCode::format('png')->size(50)->margin(0)->generate($qrcode->qrcode)); ?> " style="max-height:30px">
                                    </div>
                                    <p style="margin: 0px; font-size: 9px"><small>M.ASET ICON+</small></p>
                                    <p style="margin: 0px; font-size: 9px"><small><?php echo substr($qrcode->qrcode, 0, 9) ;?></small></p>
                                    <p style="margin: 0px; font-size: 9px"><small><?php echo substr($qrcode->qrcode, 9, 9) ;?></small></p>
                            </div>
                            <div style="margin: 7px; width: 100%">
                                    <div id="qr4"  class="pull-left" style="margin-right: 10px">
                                      <img src="data:image/png;base64, <?php echo base64_encode(QrCode::format('png')->size(50)->margin(0)->generate($qrcode->qrcode)); ?> " style="max-height:30px">
                                    </div>
                                    <p style="margin: 0px; font-size: 9px"><small>M.ASET ICON+</small></p>
                                    <p style="margin: 0px; font-size: 9px"><small><?php echo substr($qrcode->qrcode, 0, 9) ;?></small></p>
                                    <p style="margin: 0px; font-size: 9px"><small><?php echo substr($qrcode->qrcode, 9, 9) ;?></small></p>
                            </div>
                        </div>
                        <div style="width: 25%; margin-top: 10px; margin-left: -15px; margin-right: 5px" class="pull-left">
                            <div style="margin: 20px; width: 100%">
                                 <div id="qr5"  class="pull-left" style="margin-right: 5px;margin-left: -40px"></div>
                                    <p style="margin: 0px"><small>M.ASET ICON+</small></p>
                                    <p style="margin: 0px"><small><?php echo substr($qrcode->qrcode, 0, 9) ;?></small></p>
                                    <p style="margin: 0px"><small><?php echo substr($qrcode->qrcode, 9, 9) ;?></small></p>
                            </div>
                            <div style="margin: 20px; width: 100%">
                                 <div id="qr6"  class="pull-left" style="margin-right: 5px;margin-left: -40px"></div>
                                    <p style="margin: 0px"><small>M.ASET ICON+</small></p>
                                    <p style="margin: 0px"><small><?php echo substr($qrcode->qrcode, 0, 9) ;?></small></p>
                                    <p style="margin: 0px"><small><?php echo substr($qrcode->qrcode, 9, 9) ;?></small></p>
                            </div>
                        </div>
                        <div style="width: 25%; margin-top: 10px; " class="pull-left">
                            <div style="margin: 20px; width: 100%">
                                <div id="qr7"  class="pull-left" style="margin-right: 15px; margin-left: auto; margin-right: auto;margin-bottom: 10px"></div>
                                <div>
                                    <p style="margin: 0px; text-align: center ">M.ASET ICON+</p>
                                    <p style="margin: 0px; text-align: center "><small><?php echo $qrcode->qrcode ;?></small></p>
                                </div>
                            </div>
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

<?php echo e(HTML::script('assets_back/js/plugins/dataTables/datatables.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/qrcode.js')); ?>

<!-- Page-Level Scripts -->
<script>
    $('#print').hide();
    $('.printQrcode').hide();
    $('#log').hide();
    var qrcode = new QRCode("qrcode", {
        text: "<?php echo e($qrcode->qrcode); ?>",
        width: 200,
        height: 200,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
    });

    function demoFromHTML() {
        var pdf = new jsPDF("p", "mm", [210, 297]);
         pdf.addHTML($('#print')[0], function () {
             pdf.save(''+<?php echo e($qrcode->qrcode); ?>+'.pdf');
         });
    }
    $(document).ready(function(){
      /* Init DataTables */
        var oTable = $('#editable').DataTable();
        $('.viewPrint').click(function() {
            $('#print').slideDown('slow');
            $('.printQrcode').show();
            $('#detail').hide();
            $('#log').hide();
            var qr5 = '';
                qr6 = '';
                qr7 = '';
            $('#qr5').empty();
            $('#qr6').empty();
            $('#qr7').empty();

            var qr5 = new QRCode("qr5", {
                text: "<?php echo e($qrcode->qrcode); ?>",
                width: 70,
                height: 70,
                colorDark : "#000000",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H
            });
            var qr6 = new QRCode("qr6", {
                text: "<?php echo e($qrcode->qrcode); ?>",
                width: 70,
                height: 70,
                colorDark : "#000000",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H
            });
            var qr7 = new QRCode("qr7", {
                text: "<?php echo e($qrcode->qrcode); ?>",
                width: 120,
                height: 120,
                colorDark : "#000000",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H
            });
        });

         $('.viewLog').click(function() {
            $('#log').slideDown('slow');
            $('.printQrcode').hide();
            $('#detail').hide();
            $('#print').hide();
        });
         $('.viewDetail').click(function() {
            $('#detail').slideDown('slow');
            $('.printQrcode').hide();
            $('#log').hide();
            $('#print').hide();
        });
     });
    function printdiv()
    {
        //your print div data
        //alert(document.getElementById("printpage").innerHTML);
        var newstr=document.getElementById("print").innerHTML;
        var css = window.location.origin+'/assets_back/css/bootstrap.min.css';
        //alert(css);
        var header='<header><div align="center"><h3 style="color:#EB5005"> Your HEader </h3></div><br></header><hr><br>'

        var footer ="Your Footer";

        //You can set height width over here
        var popupWin = window.open('', '_blank', 'width=800,height=1125');
        popupWin.document.open();
        popupWin.document.write('<html> <link rel="stylesheet" type="text/css" href="'+css+'" id="style_color"/><body onload="window.print()"><div class="" style="max-width:400px; max-height: 220px">'+ newstr + '</div></html>');
        popupWin.document.close();
        return false;
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>