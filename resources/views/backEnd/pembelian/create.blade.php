@extends('backLayout.app')
@section('title')
Pembelian
@stop
@section('desc')
Tambah Baru
@stop
@section('style')
  {{ HTML::style('assets_back/css/plugins/chosen/chosen.css')}}
  {{ HTML::style('assets_back/css/plugins/dataTables/datatables.min.css') }}
  {{ HTML::style('assets_back/css/plugins/select2/select2.min.css')}}
  {{ HTML::style('assets_back/css/plugins/datapicker/datepicker3.css')}}
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
            <a href="{{ url('pembelian') }}"> Pembelian</a>
        </li>
        
        <li class="">
                <a href="#">
                    Tambah Baru
                </a>
        </li>
    </ol>
            <a href="{{ url('pembelian') }}">
            <button class="btn btn-sm btn-outline btn-primary pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
<div class="row ibox-content" style="min-height: 65vh; ">
	<div class="col-xs-12 col-sm-12">
    {!! Form::open(['url' => 'pembelian', 'class' => 'form-horizontal']) !!}
    {!! Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']) !!}
    {!! Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']) !!}
    <div class="form-group {{ $errors->has('norek') ? 'has-error' : ''}}">
                {!! Form::label('gudang', 'Gudang*', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-8">
                <select name="gudang" class="col-sm-12 form-control Gudang chosen-select" style="width:350px;" tabindex="2" id="gudang">
                             
                                  @foreach($gudangs as $gudang)
                                    <option value="{{$gudang->id}}">{{$gudang->code}} - {{$gudang->name}}</option>
                                  @endforeach
                                </select>
                    
                    {!! $errors->first('gudang', '<p class="help-block">:message</p>') !!}
                </div>                       
            </div> 
            <div class="hr-line-dashed"></div>  
            <div class="form-group">
          {!! Form::label('created_at', 'Tgl. Transaksi', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4 {{ $errors->has('created_at') ? 'has-error' : ''}}">
              {!! Form::text('created_at', $datenow, ['id' => 'created_at','class' => 'form-control','data-date-format'=>'yyyy-mm-dd','placeholder' => $datenow]) !!}
              {!! $errors->first('created_at', '<p class="help-block">:message</p>') !!}
          </div>
        </div>   
         <div class="hr-line-dashed"></div> 
        <div class="form-group ">
                {!! Form::label('keterangan', 'Keterangan', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-8 col-xs-12 {{ $errors->has('notes') ? 'has-error' : ''}}">
                  {!! Form::textarea('keterangan', null, ['class' => 'form-control','id'=>'keterangan', 'rows' => '2', 'placeholder' => 'Keterangan [Max: 500 Katakter]']) !!}
                  {!! $errors->first('keterangan', '<p class="help-block">:message</p>') !!}
                </div>               
            </div>  
           
            <div class="hr-line-dashed"></div> 
            <div class="form-group">
          {!! Form::label('code', 'Kode Transaksi', ['class' => 'col-sm-2 control-label']) !!}
          <div class="col-sm-4 {{ $errors->has('code') ? 'has-error' : ''}}">
          {!! Form::text('code', null, ['class' => 'form-control readonly','id'=>'code','readonly'=>'readonly']) !!}
           {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
          </div>
        </div>
 <div class="hr-line-dashed"></div> 
    <div class="row clearfix">
                <div class="col-md-12 table-responsive">
                  <table class="table table-bordered table-hover table-sortable" id="tab_logic">
        <thead>
          <tr >
            <th class="text-center">
            </th>
            <th class="text-center" style="width:250px;">
              Barang
            </th>
            <th class="text-center" style="width:200px;">
              Satuan
            </th>
            <th class="text-center" style="width:100px;">
              Jumlah
            </th>
            <th class="text-center">
              Harga/kg
            </th>
            <th class="text-center">
              Nilai(kg)
            </th>
            <th class="text-center">
              Nilai(Rp.)
            </th>
        
            
          </tr>
        </thead>
        <tbody>
            <tr id='addr0' data-id="0" class="hidden">
               <td data-name="del">
                <button nam"del0" class='btn btn-default btn-xs glyphicon glyphicon-remove row-remove'></button>
            </td>
            <td data-name="sampah">
              <select  name="sampah[]" class="form-control Sampah  chosen-select" data-placeholder="Pilih Barang" id="sampah" style="width:250px;">
                    <option value=""></option>
                     @foreach($sampahs as $sampah)
                        <option value="{{$sampah->id}}">{{$sampah->code}} - {{$sampah->name}}</option>
                     @endforeach  
                </select>

            </td>
            <td data-name="satuan">
                <select  name="satuan[]" class="form-control Satuan chosen-select" data-placeholder="Pilih Satuan" id="satuan" style="width:200px;">
                    <option value=""></option>
                     @foreach($satuans as $satuan)
                        <option value="{{$satuan->code}}">{{$satuan->name}}</option>
                     @endforeach  
                </select>

            </td>
            <td data-name="jumlah">
                {!! Form::number('jumlah[]', null, ['class' => 'form-control Jumlah','step'=>'any']) !!}
                 </td>
            <td data-name="harga_beli">
                {!! Form::number('harga_beli[]', null, ['class' => 'form-control HJ HJ2']) !!}

            </td>
            <td data-name="nilai_kg">
                {!! Form::number('nilai_kg[]', null, ['class' => 'form-control Nkg','readonly'=>'readonly']) !!}
            </td>
            <td data-name="nilai_rp">
                {!! Form::number('nilai_rp[]', null, ['class' => 'form-control Nrp','readonly'=>'readonly']) !!}
            </td>
           
           
          </tr>
        </tbody>
        <tfoot>
           <tr>
            <td colspan="5" style="text-align: right;"><b>Jumlah</b></td>
            <td colspan="1">
                {!! Form::number('total_kg', null, ['class' => 'form-control','readonly'=>'readonly','id'=>'total_kg']) !!}
            </td>
            <td colspan="1">
                {!! Form::number('total_rp', null, ['class' => 'form-control','readonly'=>'readonly','id'=>'total_rp']) !!}
            </td>
          </tr>
        </tfoot>
        </table>
        </div>
        </div>
         <a id="add_row" class="btn btn-success btn-xs pull-right btn-outline " ><i class="fa fa-plus"></i> Tambah</a> 
                <a id="kal" class="btn btn-warning btn-xs pull-right  btn-outline "  style="margin-right: 5px;"><i class="fa fa-refresh"></i> Kalkukasi</a>
                <br/>
       
        <div class="hr-line-dashed"></div> 
    <div class="form-group">
    <a href="{{ url('pembelian') }}" class="detail2 btn btn-md btn-outline btn-default pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
    <button type="submit" class="create_mdl btn btn-outline btn-success pull-right" style="margin-right: 20px; ">
                        <i class="fa fa-save"></i>  Create
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
{{ HTML::script('assets_back/js/plugins/chosen/chosen.jquery.js') }}
{{ HTML::script('assets_back/js/plugins/dataTables/datatables.min.js') }}
{{ HTML::script('assets_back/js/plugins/select2/select2.full.min.js') }}
{{ HTML::script('assets_back/js/plugins/datapicker/bootstrap-datepicker.js') }}
<script>
            $(document).ready(function () {

                var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"95%"}
                }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }

// DYNAMIC TABLE
  $("#add_row").on("click", function() {

        // Dynamic Rows Code
        
        // Get max row id and set new id
        var newid = 0;
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
        
        $(tr).find("td button.row-remove").on("click", function() {
             $(this).closest("tr").remove();
           
        });


     $(tr).find("td select.Sampah").on('change', function(e){

     if ($(this).find(':selected').val() != '') {
  
            // GET NOREK
         var val     = $(this).find(':selected').val(),
             item_d  = $(this).find(':selected').data(),
             dataid  = $(this).data("id"),
             url     = '{{url("/getharga?sampah=")}}'+val+'';

           $.ajax({
               url : url,
               type: "GET",
               dataType: 'html',
               success: function(datas){
                   $('#harga_beli'+dataid+'').val(datas);
                   return false;
               }
           });
     }

   });


          $(tr).find("td input.Jumlah").on('keyup', function(e){

            // GET NOREK
         var dataid  = $(this).data("id"),
             val     = $('#jumlah'+dataid+'').val(),
             satuan = $('#satuan'+dataid+'').val();
            
             url     = '{{url("/getsatuan?satuan=")}}'+satuan;

            

           $.ajax({
               url : url,
               type: "GET",
               dataType: 'html',
               success: function(datas){

                var nilai_kg = $('#jumlah'+dataid+'').val() * datas;

                  $('#nilai_kg'+dataid+'').val(nilai_kg);

                var nilai_rp = $('#harga_beli'+dataid+'').val() * nilai_kg;

                   $('#nilai_rp'+dataid+'').val(nilai_rp);

                   return false;
               }
           });    
             
   });

      $('#keterangan').on('change', function(e){

  
      var url     = '{{url("/refpb")}}';

           $.ajax({
               url : url,
               type: "GET",
               dataType: 'html',
               success: function(datas){
                  $('#code').val(datas);
                   return false;
               }
           });


   });
       
          $(tr).find("td input.HJ2").on("change", function(){

          calc();

          });

          $(function () {
          $('body').on('DOMNodeInserted', 'select', function () {
          $(this).select2();
           });
    
          $('.Sampah').select2();
          // $('.Satuan').select2();
           $('.Satuan').select2().val('kg').trigger('change.select2');

 
});
    
        
});

$("#kal").on("click", function(){

          calc();

          });

function calc(){


    var sum1 = 0;

    $('.Nkg').each(function() {
        sum1 += Number($(this).val());
    });
   
     $('#total_kg').val(sum1);


       var sum2 = 0;

    $('.Nrp').each(function() {
        sum2 += Number($(this).val());
    });
   
     $('#total_rp').val(sum2);
     
}
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



    $("#add_row").trigger("click");
// END DYNAMIC TABLE

            });
$("#created_at").datepicker({
              format :  'yyyy-mm-dd',
              keyboardNavigation : false,
              forceParce: false,
              todayBtn: 'linked',
              todayHighlight :  true,
              daysOfWeekDisabled : [0],
            });

        </script>
@endsection
