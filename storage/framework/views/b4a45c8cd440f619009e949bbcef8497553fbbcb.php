<?php $__env->startSection('title'); ?>
Frozen Kita  / <?php echo e(Sentinel::getUser()->getunit->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Point Of Sales
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
  <?php echo e(HTML::style('assets_back/css/plugins/chosen/chosen.css')); ?>

  <?php echo e(HTML::style('assets_back/css/plugins/dataTables/datatables.min.css')); ?>

  <?php echo e(HTML::style('assets_back/css/plugins/select2/select2.min.css')); ?>

  <?php echo e(HTML::style('assets_back/css/plugins/datapicker/datepicker3.css')); ?>

  <style>
  .disabled {
  pointer-events: none;
  cursor: default;
  opacity: 0.6;
}
  </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="wrapper wrapper-content">
<div class="row">
<?php $__currentLoopData = ['danger', 'warning', 'success', 'info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if(Session::has('alert-' . $msg)): ?>
      <div class="alert alert-<?php echo e($msg); ?> alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    <?php echo e(Session::get('alert-' . $msg)); ?>.
      </div>
      <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<div class="col-md-8">
    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3 Item <?php echo e($item->stock == 0 ?'disabled':''); ?>" id="<?php echo e($item->id); ?>" data-id="<?php echo e($item->id); ?>" data-name="<?php echo e($item->name); ?>" data-satuan="<?php echo e($item->satuan); ?>"  data-stock="<?php echo e($item->stock); ?>" data-price="<?php echo e(number_format($item->sell_price,0)); ?>">
                    <div class="ibox">
                        <div class="ibox-content product-box">
                            <img src="<?php echo e(empty($item->thumbnail)?'images/noimage.jpg':$item->thumbnail); ?>" style="height:150px;width:170px;"/>
                         
                            <div class="product-desc">
                                <span class="product-price">
                                    <?php echo e(number_format($item->sell_price,0)); ?>

                                </span>
                                <small class="text-muted"><?php echo e(empty($item->parent->name)?"Category Not Set":$item->parent->name); ?></small>
                                <a href="#" class="product-name"> <?php echo e($item->name); ?></a>
                                <div class="small m-t-xs">
                                    Stock : <?php echo e($item->stock); ?>

                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 </div>

                <!--chart summary-->
                <div class="col-md-4">

                    <div class="ibox">
                    <?php echo Form::open(['url' => 'penjualan', 'class' => 'form-horizontal','id'=>'formfield']); ?>

                    <?php echo Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

                    <?php echo Form::hidden('created_at', date('Y-m-d'), ['class' => 'form-control']); ?>

                    <?php echo Form::hidden('gudang', Sentinel::getUser()->getunit->id, ['class' => 'form-control']); ?>

                    <?php echo Form::hidden('code', $code, ['class' => 'form-control']); ?>

                        <div class="ibox-title">
                            <h5>Cart Summary</h5>
                        </div>
                        <div class="ibox-content">
                             <span>
                                Items
                            </span>
                            <table class="table shoping-cart-table" id="tableCart" width="100%">

                            </table>
                            <hr>
                            
                            <form class="form-horizontal">
                            <div class="form-group"><label class="col-lg-2 control-label">Diskon</label>
                                <div class="col-lg-10"><input name="diskon" id="Diskon" value="0" class="form-control numeric">
                                </div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">Tunai</label>
                                <div class="col-lg-10"><input name="tunai" id="Tunai" placeholder="0" class="form-control numeric">
                                </div>
                            </div>
                            </form>
                            <dl class="dl-horizontal m-t-md text-right">
                                        <dt>Total</dt>
                                        <dd><h3 class="font-bold text-right" id="AllTotal"></h3>
                                        </dd>
                                        <dt>Kembali</dt>
                                        <dd><h3 class="font-bold text-right" id="Kembali"></h3>
                                        </dd>
                            </dl>
                            <hr>
                           <input type="hidden" id="IAllTotal" name="total_rp" value="">
                           <input name="kembali" id="IKembali" type="hidden">
                            <div class="m-t-sm">
                                <div class="btn-group">
                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target = "#confirm-submit" ><i class="fa fa-shopping-cart"></i> Checkout</a>
                                <div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                Konfirmasi
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin memproses penjualan?
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                <a href="#" id="submit" class="btn btn-primary">Proses</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?php echo e('pos'); ?>" class="btn btn-white btn-sm"> Cancel</a>
                                </div>
                            </div>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>

                  


                </div>
            </div>
					
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<?php echo e(HTML::script('assets_back/js/plugins/chosen/chosen.jquery.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/dataTables/datatables.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/select2/select2.full.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/datapicker/bootstrap-datepicker.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/inputmask/jquery.inputmask.bundle.js')); ?>

<script>
$(document).ready(function () {


    $(".Item").on("click", function(){  

         var id = $(this).data('id');
         var name = $(this).data('name');
         var price = $(this).data('price');
         var satuan = $(this).data('satuan');
         var stock = $(this).data('stock');

        $('#tableCart').append('<tr id='+id+'><td width="60%"><small>'+name+'</small><input type="hidden" name="item[]" value='+id+'><input type="hidden" name="satuan[]" class="satuan" value='+satuan+'><input hidden="text" name="jumlah[]" class="jumlah" value=1><input type="hidden" name="harga_jual[]" value='+Number(price.replace(/\,/g,''))+'><input type="hidden" name="nilai_rp[]" class="nilai_rp" value='+Number(price.replace(/\,/g,''))+'></td><td width="20%"><input type="text" name="Qty" class="form-control itemQty" value="1" min-value="0"></td><td><small class="itemPrice">'+price+'</small><small class="stock" style="display:none;">'+stock+'</small></td><td><strong class="itemTotal">  '+price+' </strong></td><td width="5%"><button class="btn btn-default btn-xs removebutton" type="button"><i class="fa fa-close"></i></button></td></tr>');
        
        CalcSum();

         $('#'+id+'').addClass("disabled");


        
    });
    //remove button
    $(document).on('click', 'button.removebutton', function () { 

        var id = $(this).closest('tr').attr('id');

        $(this).closest('tr').remove();
        CalcSum();
        $('#'+id+'').removeClass("disabled");

     
     return false;
    });
    $(document).on('keyup', 'input.itemQty', function () {
 
        var stock = $(this).parent().parent().find("small[class='stock']").text(); 
        var qty = $(this).parent().parent().find("input[name='Qty']").val(); 
        


        if(Number(stock) < qty){
            alert("Maaf, stock kurang!");
            $(this).parent().parent().find("input[name='Qty']").val(1);
                
        }else {


        var price = $(this).parent().parent().find("small[class='itemPrice']").text();
        var total = qty * Number(price.replace(/,/g, ""));

        $(this).parent().parent().find("strong[class='itemTotal']").html(Number(total.toFixed(1)).toLocaleString());
        $(this).parent().parent().find("input[class='nilai_rp']").val(total);
        $(this).parent().parent().find("input[class='jumlah']").val(qty);
        
        CalcSum();

        
        
     return false;
        }
    });

    $(document).on('keyup', 'input#Diskon', function () { 


       var Diskon = $('#Diskon').val();
       var IAllTotal = $('#IAllTotal').val();

       var NewAllTotal = Number(IAllTotal.replace(/\,/g,'')) - Number(Diskon.replace(/\,/g,'')) ;
   
       $('#AllTotal').html(Number(NewAllTotal.toFixed(1)).toLocaleString());
       


    });

    $(document).on('keyup', 'input#Tunai', function () { 

       

        var Tunai = $('#Tunai').val();
        var IAllTotal = $('#IAllTotal').val();


        var Kembali = Number(Tunai.replace(/\,/g,'')) - Number(IAllTotal.replace(/\,/g,'')) ;

          $('#IKembali').val(Kembali);
          $('#Kembali').html(Number(Kembali.toFixed(1)).toLocaleString());

    });




function CalcSum(){

     var sum = 0;
            // iterate through each td based on class and add the values
            $(".itemTotal").each(function() {

                var value = $(this).text();

                // add only if the value is number
                if(!isNaN(Number(value.replace(/,/g, ""))) && value.length != 0) {
                    sum += parseFloat(Number(value.replace(/,/g, "")));
                }
            });


        $('#IAllTotal').val(sum);
        $('#AllTotal').html(Number(sum.toFixed(1)).toLocaleString());
}

$('#Diskon').inputmask("numeric", {
    radixPoint: ".",
    groupSeparator: ",",
    digits: 2,
    autoGroup: true,
    prefix: '', 
    rightAlign: false,
    removeMaskOnSubmit: true,
    oncleared: function () { self.Value(''); }
});

$('#Tunai').inputmask("numeric", {
    radixPoint: ".",
    groupSeparator: ",",
    digits: 2,
    autoGroup: true,
    prefix: '', 
    rightAlign: false,
    removeMaskOnSubmit: true,
    oncleared: function () { self.Value(''); }
});

$('#submit').click(function(){


        $('#formfield').submit(); 
});


});



</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.apppos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>