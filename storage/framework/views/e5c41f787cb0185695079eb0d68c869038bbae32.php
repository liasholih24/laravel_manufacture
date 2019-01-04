
<link rel="stylesheet" type="text/css" href="../assets_back/css/bootstrap.min.css">
<input type="hidden" id="token" value="<?php echo e(csrf_token()); ?>">
<div style="margin-right: auto; margin-left: auto; margin-top: 20px; max-width: 750px">
	<button class="btn btn-sm btn-outline btn-primary printQrcode"  onclick="javascript:printdiv();" style="margin-right: 10px">
        <i class="fa fa-print" style="margin-right: 5px"></i> Print
    </button>
    <div class="row"   id="print" >
		<div class="row col-sm-12" style="max-width: 750px">
			<?php $qr = $qrData; $qrcode = explode(',',$qr) ;?>
			<?php $i = 1; foreach($qrcode as $q){ ;?>
				<?php $i++; $s = $i%2; $pbreak = $i%10;?>
				<div class="row col-sm-6 <?php if($s > 0){ echo 'pull-right' ;}else{ echo 'pull-left' ;}?>" style="width: 350px; background-color: #fff;">
		            <div style="width: 100%; margin-top: 10px">
		                <div style="width: 40%;  <?php if($i >= 11){ if(($pbreak == 2) || ($pbreak == 3)){ echo '' ;}elseif($pbreak == 0){ echo 'margin-top: 20px' ;}else{ echo 'margin-top: 20px' ;} ;}else{ echo 'margin-top: 20px' ; } ;?>; <?php if( ($i%2) > 0){ echo 'margin-left: -35px'; }?>" class="pull-left <?php if($i > 10){ if(($pbreak == 1) || ($pbreak == 2)){ echo 'pagebreak' ;} ;} ;?>" >
		                    <div style="margin: 7px; width: 70%">
		                            <div id="qr1_<?php echo $q ;?>"  class="pull-left" style="margin-right: 5px">
										<img src="data:image/png;base64, <?php echo base64_encode(QrCode::format('png')->size(50)->margin(0)->generate($q)); ?> " style="max-height:30px">
									</div>
		                            <p style="margin: 0px; font-size: 9px; text-align: right"><small>M.ASET ICON+</small></p>
		                            <p style="margin: 0px; font-size: 9px; text-align: right"><small><?php echo substr($q, 0, 9) ;?></small></p>
		                            <p style="margin: 0px; font-size: 9px; text-align: right"><small><?php echo substr($q, 9, 9) ;?></small></p>
		                    </div>
		                    <div style="margin: 7px; width: 70%">
		                            <div id="qr2_<?php echo $q ;?>"  class="pull-left" style="margin-right: 5px">
										<img src="data:image/png;base64, <?php echo base64_encode(QrCode::format('png')->size(50)->margin(0)->generate($q)); ?> " style="max-height:30px">
									</div>
		                            <p style="margin: 0px; font-size: 9px; text-align: right"><small>M.ASET ICON+</small></p>
		                            <p style="margin: 0px; font-size: 9px; text-align: right"><small><?php echo substr($q, 0, 9) ;?></small></p>
		                            <p style="margin: 0px; font-size: 9px; text-align: right"><small><?php echo substr($q, 9, 9) ;?></small></p>
		                    </div>
		                     <div style="margin: 7px; width: 70%">
		                            <div id="qr3_<?php echo $q ;?>"  class="pull-left" style="margin-right: 5px">
										<img src="data:image/png;base64, <?php echo base64_encode(QrCode::format('png')->size(50)->margin(0)->generate($q)); ?> " style="max-height:30px">
									</div>
		                            <p style="margin: 0px; font-size: 9px; text-align: right"><small>M.ASET ICON+</small></p>
		                            <p style="margin: 0px; font-size: 9px; text-align: right"><small><?php echo substr($q, 0, 9) ;?></small></p>
		                            <p style="margin: 0px; font-size: 9px; text-align: right"><small><?php echo substr($q, 9, 9) ;?></small></p>
		                    </div>
		                    <div style="margin: 7px; width: 70%">
		                            <div id="qr4_<?php echo $q ;?>"  class="pull-left" style="margin-right: 5px">
										<img src="data:image/png;base64, <?php echo base64_encode(QrCode::format('png')->size(50)->margin(0)->generate($q)); ?> " style="max-height:30px">
									</div>
		                            <p style="margin: 0px; font-size: 9px; text-align: right"><small>M.ASET ICON+</small></p>
		                            <p style="margin: 0px; font-size: 9px; text-align: right"><small><?php echo substr($q, 0, 9) ;?></small></p>
		                            <p style="margin: 0px; font-size: 9px; text-align: right"><small><?php echo substr($q, 9, 9) ;?></small></p>
		                    </div>
		                </div>
		                <div style="width: 28%; margin-right: 10px " class="pull-left">
		                    <div style="margin: 20px; width: 100%">
		                         <div id="qr5_<?php echo $q ;?>"  class="pull-left" style="margin-right: 5px;margin-left: -40px"></div>
		                            <p style="margin: 0px; font-size: 12px; text-align: right"><small>M.ASET ICON+</small></p>
		                            <p style="margin: 0px; font-size: 12px; text-align: right"><small><?php echo substr($q, 0, 9) ;?></small></p>
		                            <p style="margin: 0px; font-size: 12px; text-align: right"><small><?php echo substr($q, 9, 9) ;?></small></p>
		                    </div>
		                    <div style="margin: 30px 20px 20px; width: 100%">
		                         <div id="qr6_<?php echo $q ;?>"  class="pull-left" style="margin-right: 5px;margin-left: -40px"></div>
		                            <p style="margin: 0px; font-size: 12px; text-align: right"><small>M.ASET ICON+</small></p>
		                            <p style="margin: 0px; font-size: 12px; text-align: right"><small><?php echo substr($q, 0, 9) ;?></small></p>
		                            <p style="margin: 0px; font-size: 12px; text-align: right"><small><?php echo substr($q, 9, 9) ;?></small></p>
		                    </div>
		                </div>
		                <div style="width: 28%; margin-left: 2px " class="pull-left">
		                    <div style="margin: 20px; width: 100%">
		                        <div id="qr7_<?php echo $q ;?>"  class="pull-left" style="margin-right: 15px; margin-left: auto; margin-right: auto;margin-bottom: 5px"></div>
		                        <div>
		                            <p style="margin: 0px; text-align: right; font-size: 12px ">M.ASET ICON+</p>
		                            <p style="margin: 0px; text-align: right; font-size: 12px ""><small><?php echo $q ;?></small></p>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		        <?php if($i > 10){ if($pbreak == 1){ echo '</div><div class="row col-sm-12"style="max-width: 750px; margin-top: 100px">' ;} ;} ;?>
			<?php unset($q);};?>
		</div>
	</div>
</div>

<script type="text/javascript" src="../assets_back/js/qrcode.js"></script>

<script type="text/javascript" src="../assets_back/js/jquery-2.1.1.js"></script>
<script type="text/javascript">
	<?php foreach($qrcode as $q){ ;?>

		var qrcode = new QRCode("qr5_<?php echo $q ;?>", {
	        text: "<?php echo $q ;?>",
	        width: 70,
	        height: 70,
	        colorDark : "#000000",
	        colorLight : "#ffffff",
	        correctLevel : QRCode.CorrectLevel.H
	    });

		var qrcode = new QRCode("qr6_<?php echo $q ;?>", {
	        text: "<?php echo $q ;?>",
	        width: 70,
	        height: 70,
	        colorDark : "#000000",
	        colorLight : "#ffffff",
	        correctLevel : QRCode.CorrectLevel.H
	    });

		var qrcode = new QRCode("qr7_<?php echo $q ;?>", {
	        text: "<?php echo $q ;?>",
	        width: 120,
	        height: 120,
	        colorDark : "#000000",
	        colorLight : "#ffffff",
	        correctLevel : QRCode.CorrectLevel.H
	    });
	<?php unset($q);};?>
	var csrf = $('meta[name="csrf-token"]').attr('content');
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
        var popupWin = window.open('', '_blank', 'width=795');
        popupWin.document.open();
        popupWin.document.write('<html> <link rel="stylesheet" type="text/css" href="'+css+'" id="style_color"/><style>page-break { margin-top: 100px !important ;} </style><body onload="window.print()"><div class="row col-sm-12" style="max-width: 780px !important; margin-top: 50px" >'+ newstr + '</div></html>');
        popupWin.document.close();
        
        //return false;
    }
    //$(document).ready(function(){
    	$('.printQrcode').click(function(){
    		var qrData  	= '<?php echo e($qrId); ?>',
	        	url 		= window.location.origin+'/printed?qr='+qrData,
	        	nurl 		= window.location.origin+'/qrcode';
		    	console.log(qrData);
		    $.ajax({
		      url : url,
		      type: "GET",
		      datatype: 'html',
		      data: {_token: csrf, qr: qrData},
		      success: function(html){
	        	alert(nurl);

		      },
		      error: function (html) {
		      	console.log(data);
		      }
		    });
    	});
    //})
</script>
