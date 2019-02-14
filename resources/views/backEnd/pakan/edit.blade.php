@extends('backLayout.app')
@section('title')
Pakan
@stop
@section('desc')
Edit Komposisi Pakan
@stop
@section('style')
  {{ HTML::style('assets_back/css/plugins/select2/select2.min.css')}}
  {{ HTML::style('assets_back/css/plugins/select2/select2-bootstrap.min.css')}}
  @endsection
@section('content')
<div class="wrapper wrapper-content">
					<div class="row detail_content3">
	<div class="col-lg-12 detail_content2" style="background-color: white"><style>
						.ibox { margin: 1px 2px 0px 0px !important }
						.ibox.float-e-margins{ margin: 0px 2px !important}
						</style>
      <div class="row ibox-title">
   <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
        <li class="">
            <a href="{{ url('pakan') }}"> Pakan
        </li>
        /
        <li class="">
                <a href="#">
                    Edit
                </a>
        </li>
    </ol>
            <a href="{{ url('pakan') }}">
            <button class="btn btn-sm btn-outline btn-warning pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
<div class="row ibox-content" style="min-height: 65vh; ">
	<div class="col-xs-12 col-sm-12">
    {!! Form::model($pakan, [
      'method' => 'PATCH',
      'url' => ['pakan', $pakan->id],
      'class' => 'form-horizontal'
    ]) !!}
    {!! Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']) !!}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', 'Nama', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nama [Max: 50 Katakter]']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('hpp') ? 'has-error' : ''}}">
                {!! Form::label('hpp', 'HPP', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::text('hpp', null, ['class' => 'form-control Numeric','id'=> 'hpp_pakan', 'placeholder' => 'HPP Pakan', 'readonly' => 'readonly']) !!}
                    {!! $errors->first('hpp', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('notes') ? 'has-error' : ''}}">
                 {!! Form::label('notes', 'Deskripsi', ['class' => 'col-sm-1 control-label']) !!}
                <div class="col-sm-5 col-xs-12">
                    {!! Form::textarea('notes', null, ['class' => 'form-control', 'rows' => '2', 'placeholder' => 'Deskripsi [Max: 500 Katakter]']) !!}
                    {!! $errors->first('notes', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="hr-line-dashed"></div>       

<div class="row clearfix">
            <div class="col-md-12 table-responsive">
              <table class="table table-bordered table-hover table-sortable" id="tab_logic">
    <thead>
      <tr>
      <th class="text-center" style="width:10px;">
        </th>
        <th class="text-center" style="width:300px;">
          Item
        </th>
        <th class="text-center" style="width:100px;">
          Harga
        </th> 
        <th class="text-center" style="width:100px;">
          Qty (Kg)
        </th> 
        <th class="text-center" style="width:100px;">
          Rupiah
        </th> 

      </tr>
    </thead>
    <tbody>
    <?php $i = 0;?>
    @foreach($details as $detail)
    <?php $i++;?>
        <tr id='addr{{$i}}' data-id="{{$i}}" >
        <td data-name="del">
            <button name="del0" class='btn btn-default btn-xs glyphicon glyphicon-remove row-remove'></button>
        </td>
        <td data-name="item">
          <select  name="item[]" id="item{{$i}}" class="form-control Item select2" data-placeholder="Pilih Item"  style="width:300px;">
                @foreach($items as $item)
                    <option value="{{$item->id}}" <?php if($detail->item == $item->id) echo"selected";?>>{{$item->name}}</option>
                @endforeach
          </select>
        </td>
        <td data-name="harga">
            {!! Form::text('harga[]', $detail->harga, ['id'=>'harga'.$i,'class' => 'form-control Hq Harga ','step'=>'any']) !!}
        </td>
        <td data-name="qty">
            {!! Form::number('qty[]', $detail->qty, ['id'=>'qty'.$i,'class' => 'form-control Hq Qty','step'=>'any']) !!}
        </td>
       
        <td data-name="rupiah">
            {!! Form::number('rupiah[]', $detail->rupiah, ['id'=>'rupiah'.$i,'class' => 'form-control Rupiah','step'=>'any']) !!}
        </td>
      </tr>
    @endforeach
    </tbody>

        @if(empty($details))
        <tbody>
            <tr id='addr0' data-id="0" class="hidden">
                        <td data-name="del">
                            <button name="del0" class='btn btn-default btn-xs glyphicon glyphicon-remove row-remove'></button>
                        </td>
                        <td data-name="item">
                        <select  name="item[]" class="form-control Item chosen-select" data-placeholder="Pilih Item"  style="width:300px;">
                                @foreach($items as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                        </select>
                        </td>
                        <td data-name="harga">
                            {!! Form::text('harga[]', null, ['class' => 'form-control Hq Harga ','step'=>'any']) !!}
                        </td>
                        <td data-name="qty">
                            {!! Form::number('qty[]', null, ['class' => 'form-control Hq Qty','step'=>'any']) !!}
                        </td>
                    
                        <td data-name="rupiah">
                            {!! Form::number('rupiah[]', null, ['class' => 'form-control Rupiah','step'=>'any','readonly'=>'readonly']) !!}
                        </td>
                    </tr>
        </tbody>

        @endif



    <tfoot>
    <tr>
        <td colspan="3">
             <a id="add_row" title="Tambah Baris" class="btn btn-primary btn-sm pull-left" style="margin-right:10px;"><i class="fa fa-plus"></i></a>
             <a id="kal" title="Kalkulasi" class="btn btn-warning btn-sm pull-right btn-outline" ><i class="fa fa-refresh"> Kalkukasi</i></a>
                       
        </td>
        <td>
            {!! Form::text('jqty', null, ['class' => 'form-control jqty Numeric','id' => 'total_kg','placeholder'=>'Total (Kg)']) !!}
        </td>
        <td>
            {!! Form::text('jharga', null, ['class' => 'form-control jharga Numeric','id' => 'total_rp','placeholder'=>'Total (Rp)']) !!}
        </td>
    </tr>
    </tfoot>
    </table>
    </div>
    </div>
      <br/>
    
    <div class="hr-line-dashed"></div> 



    <div class="form-group">
<a href="{{ url('pakan') }}" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
      <button type="submit" class="create_mdl btn btn-outline btn-primary pull-right" style="margin-right: 20px; ">
                        <i class="fa fa-save"></i>  Update
                      </button>
      </a>
    </div>
    </div>
    </div>
    {!! Form::close() !!}
  </div>
</div>
</div>

@endsection
@section('script')
{{ HTML::script('assets_back/js/plugins/select2/select2.full.min.js') }}
{{ HTML::script('assets_back/js/inputmask/jquery.inputmask.bundle.js') }}
<script>
$(document).ready(function () {
    $('.select2').select2({
                theme: 'bootstrap',
                width: '100%'
                });


    $('.Numeric').inputmask("numeric", {
    radixPoint: ".",
    groupSeparator: ",",
    digits: 2,
    autoGroup: true,
    rightAlign: false,
    removeMaskOnSubmit: true,
    oncleared: function () { self.Value(''); }
});

calc();

$(".Hq").on("change", function(){

    var  dataid  = $(this).closest('tr').attr('data-id'),
                    qty  = $('#qty'+dataid+'').val(),
                    harga  = $('#harga'+dataid+'').val();

            
    $('#rupiah'+dataid+'').val((qty * harga).toFixed(0));
                calc();
});

$("#kal").on("click", function(){

calc();

});

function calc(){

    var sum1 = 0;

    $('.Qty').each(function() {
        sum1 += Number($(this).val());
    });

    $('#total_kg').val(sum1.toFixed(2));


    var sum2 = 0;

    $('.Rupiah').each(function() {
        sum2 += Number($(this).val());
    });

    $('#total_rp').val(sum2.toFixed(0));

    var hpp_pakan = (sum2 / sum1).toFixed(0);
    $('#hpp_pakan').val(hpp_pakan);
}

    $("tr td button.row-remove").on("click", function() {
          $(this).closest("tr").remove(); 
    });
            

// DYNAMIC TABLE
$("#add_row").on("click", function() {

        // Dynamic Rows Code
        
        // Get max row id and set new id
        var newid = {{$i}};
        $.each($("#tab_logic tr"), function() {
            if (parseInt($(this).data("id")) > newid) {
                newid = parseInt($(this).data("id"));
            }
        });
        newid++;
        
        var tr = $("<tr></tr>", {
            id: "addr"+newid,
            "data-id": newid
        });
        
        // loop through each td and create new elements with name of newid
        $.each($("#tab_logic tbody tr:nth(0) td"), function() {
            var cur_td = $(this);
            
            var children = cur_td.children();
            
            // add new td and element if it has a nane
            if ($(this).data("name") != undefined) {
                var td = $("<td></td>", {
                    "data-name": $(cur_td).data("name")
                });
                
                var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
              //  c.attr("name", $(cur_td).data("name") + newid);
                c.attr("id", $(cur_td).data("name") + newid);
                c.attr("data-id", newid);
                c.appendTo($(td));
                td.appendTo($(tr));
           
            } else {
                var td = $("<td></td>", {
                    'text': $('#tab_logic tr').length
                }).appendTo($(tr));


            }

           
        });
        
        // add the new row
        $(tr).appendTo($('#tab_logic'));

        calc();
        
        $(tr).find("td button.row-remove").on("click", function() {
             $(this).closest("tr").remove();
           
        });

        $(tr).find("td select.Item").on('change', function(e){

            if ($(this).find(':selected').val() != '') {

                // GET NOREK
                var val     = $(this).find(':selected').val(),
                    item_d  = $(this).find(':selected').data(),
                    dataid  = $(this).data("id"),
                    url     = '{{url("/getharga?id=")}}'+val+'';

                $.ajax({
                    url : url,
                    type: "GET",
                    dataType: 'html',
                    success: function(datas){
                        $('#harga'+dataid+'').val(datas);
                        return false;
                    }
                });
            }

            });

            $(tr).find("td input.Hq").on("change", function(){

            var  dataid  = $(this).data("id"),
                    qty  = $('#qty'+dataid+'').val(),
                    harga  = $('#harga'+dataid+'').val();

            
            $('#rupiah'+dataid+'').val((qty * harga).toFixed(0));
                calc();
            });

            $("#kal").on("click", function(){

            calc();

            });

            

          $(function () {
          $('body').on('DOMNodeInserted', 'select', function () {
             $(this).select2();
           });
    
           $('.select2').select2({
                theme: 'bootstrap',
                width: '100%'
                });
             });
    
        
});



    // Sortable Code
    var fixHelperModified = function(e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();
    
        $helper.children().each(function(index) {
            $(this).width($originals.eq(index).width())
        });
        
        return $helper;
    };
  
    $(".table-sortable tbody").sortable({
        helper: fixHelperModified      
    }).disableSelection();

    $(".table-sortable thead").disableSelection();



  // $("#add_row").trigger("click");
// END DYNAMIC TABLE

            });
            
   $("#created_at").datepicker({
              startDate : '-0m',
              format :  'yyyy-mm-dd',
              keyboardNavigation : false,
              forceParce: false,
              todayBtn: 'linked',
              todayHighlight :  true,
              daysOfWeekDisabled : [0],
            });

        </script>
@endsection