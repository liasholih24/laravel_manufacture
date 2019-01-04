@extends('backLayout.apppos')
@section('title')
Frozen Kita  / {{Sentinel::getUser()->getunit->name}}
@stop
@section('desc')
Point Of Sales
@stop
@section('style')
  {{ HTML::style('assets_back/css/plugins/chosen/chosen.css')}}
  {{ HTML::style('assets_back/css/plugins/dataTables/datatables.min.css') }}
  {{ HTML::style('assets_back/css/plugins/select2/select2.min.css')}}
  {{ HTML::style('assets_back/css/plugins/datapicker/datepicker3.css')}}
  <style>
  .disabled {
  pointer-events: none;
  cursor: default;
  opacity: 0.6;
}
  </style>
@endsection
@section('content')
<div class="wrapper wrapper-content">
<div class="row">
@foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))
      <div class="alert alert-{{ $msg }} alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    {{ Session::get('alert-' . $msg) }}.
      </div>
      @endif
    @endforeach
<div class="col-md-8">
    @foreach($items as $item)
                <div class="col-md-3 Item {{$item->stock == 0 ?'disabled':''}}" id="{{$item->id}}" data-id="{{$item->id}}" data-name="{{$item->name}}" data-satuan="{{$item->satuan}}"  data-stock="{{$item->stock}}" data-price="{{number_format($item->sell_price,0)}}">
                    <div class="ibox">
                        <div class="ibox-content product-box">
                            <img src="{{empty($item->thumbnail)?'images/noimage.jpg':$item->thumbnail}}" style="height:150px;width:170px;"/>
                         
                            <div class="product-desc">
                                <span class="product-price">
                                    {{number_format($item->sell_price,0)}}
                                </span>
                                <small class="text-muted">{{empty($item->parent->name)?"Category Not Set":$item->parent->name}}</small>
                                <a href="#" class="product-name"> {{$item->name}}</a>
                                <div class="small m-t-xs">
                                    Stock : {{$item->stock}}
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
    @endforeach
 </div>

                <!--chart summary-->
                <div class="col-md-4">

                    <div class="ibox">
                    {!! Form::open(['url' => 'penjualan', 'class' => 'form-horizontal','id'=>'formfield']) !!}
                    {!! Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']) !!}
                    {!! Form::hidden('created_at', date('Y-m-d'), ['class' => 'form-control']) !!}
                    {!! Form::hidden('gudang', Sentinel::getUser()->getunit->id, ['class' => 'form-control']) !!}
                    {!! Form::hidden('code', $code, ['class' => 'form-control']) !!}
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
                                <a href="{{'pos'}}" class="btn btn-white btn-sm"> Cancel</a>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>

                  


                </div>
            </div>
					
</div>
@endsection
@section('script')
{{ HTML::script('assets_back/js/plugins/chosen/chosen.jquery.js') }}
{{ HTML::script('assets_back/js/plugins/dataTables/datatables.min.js') }}
{{ HTML::script('assets_back/js/plugins/select2/select2.full.min.js') }}
{{ HTML::script('assets_back/js/plugins/datapicker/bootstrap-datepicker.js') }}
{{ HTML::script('assets_back/js/plugins/inputmask/jquery.inputmask.bundle.js') }}
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
@endsection
