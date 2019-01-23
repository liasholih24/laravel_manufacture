@extends('backLayout.app')
@section('title')
Create new Pengobatan
@stop
@section('style')
  {{ HTML::style('assets_back/css/plugins/select2/select2.min.css')}}
  @endsection
@section('content')
<div class="wrapper wrapper-content">
					<div class="row detail_content3">
	<div class="col-lg-12 detail_content2" style="background-color: white"><style>
						.ibox { margin: 1px 2px 0px 0px !important }
						.ibox.float-e-margins{ margin: 0px 2px !important}
						</style>
      <div class="row ibox-title">
   <ol class="breadcrumb col-sm-4 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
        <li class="">
            <a href="{{ url('pengobatan') }}"> Pengobatan
        </li>
        /
        <li class="">
                <a href="#">
                    Add New
                </a>
        </li>
    </ol>
            <a href="{{ url('pengobatan') }}">
            <button class="btn btn-sm btn-outline btn-warning pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
<div class="row ibox-content" style="min-height: 65vh; ">
	<div class="col-xs-12 col-sm-22">
    {!! Form::open(['url' => 'pengobatan', 'class' => 'form-horizontal']) !!}
    {!! Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']) !!}

            <div class="form-group {{ $errors->has('tgl_checkin') ? 'has-error' : ''}}">
                {!! Form::label('tgl_checkin', 'Tgl Checkin', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::date('tgl_checkin', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('tgl_checkin', '<p class="help-block">:message</p>') !!}
                </div>
                
            </div>
            <div class="form-group {{ $errors->has('populasi') ? 'has-error' : ''}}">
                {!! Form::label('populasi', 'Populasi', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-5">
                        {!! Form::text('populasi', null, ['class' => 'form-control','placeholder' =>'Jml. Populasi']) !!}
                        {!! $errors->first('populasi', '<p class="help-block">:message</p>') !!}
                    </div>
            </div>
            <div class="hr-line-dashed"></div>       

<div class="row clearfix">
    <div class="col-md-12 table-responsive">
       <table class="table table-bordered table-hover table-sortable" id="tab_logic">
           <thead>
               <tr>
                   <th class="text-center" style="width:10px;"></th>
                   <th class="text-center" style="width:70px;">
                   Tanggal
                   </th>
                   <th class="text-center" style="width:100px;">
                   Umur
                   </th> 
                   <th class="text-center" style="width:100px;">
                   Obat/Vitamin
                   </th> 
                   <th class="text-center" style="width:100px;">
                   Vaksin
                   </th> 
                   <th class="text-center" style="width:100px;">
                   Dosis
                   </th> 
                   <th class="text-center" style="width:100px;">
                   Aplikasi
                   </th> 
                   
               </tr>
           </thead>
           <tbody>
               <tr id='addr0' data-id="0" class="hidden">
               <td data-name="del">
                   <button name="del0" class='btn btn-default btn-xs glyphicon glyphicon-remove row-remove'></button>
               </td>
               <td data-name="obat">
                    {!! Form::date('tgl_pengobatan[]', null, ['class' => 'form-control']) !!}
               </td>
               <td data-name="umur">
                    {!! Form::text('umur[]', null, ['class' => 'form-control',]) !!}
               </td>
               <td data-name="obat">
               <select  name="obat[]" class="form-control Obat chosen-select" data-placeholder="Pilih Obat/Vitamin"  style="width:150px;">
                    @foreach($obats as $obat)
                        <option value="{{$obat->id}}">{{$obat->name}}</option>
                    @endforeach
               </select>
               </td>
               <td data-name="vaksin">
               <select  name="vaksin[]" class="form-control chosen-select" data-placeholder="Pilih Vaksin"  style="width:150px;">
                    @foreach($obats as $obat)
                        <option value="{{$obat->id}}">{{$obat->name}}</option>
                    @endforeach
               </select>
               </td>
               <td data-name="dosis">
                    {!! Form::text('dosis[]', null, ['class' => 'form-control',]) !!}
               </td>
               <td data-name="aplikasi">
                    {!! Form::text('aplikasi[]', null, ['class' => 'form-control',]) !!}
               </td>
               
            
           </tr>
           </tbody>
       </table>
    </div>
</div>
<a id="add_row" class="btn btn-success btn-xs pull-right btn-outline " ><i class="fa fa-plus"></i> Add Row</a>
   
<br/>

<div class="hr-line-dashed"></div>
         


    <div class="form-group">
<a href="{{ url('pengobatan') }}" class="detail2 btn btn-md btn-outline btn-danger pull-right">  <i class="fa fa-times-circle" ></i> Cancel</a>
      <button type="submit" class="create_mdl btn btn-outline btn-primary pull-right" style="margin-right: 20px; ">
                        <i class="fa fa-plus-circle"></i>  Create
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


    $('.Numeric').inputmask("numeric", {
    radixPoint: ".",
    groupSeparator: ",",
    digits: 2,
    autoGroup: true,
    rightAlign: false,
    removeMaskOnSubmit: true,
    oncleared: function () { self.Value(''); }
});
            

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

            function calc(){


                    var sum1 = 0;

                    $('.Qty').each(function() {
                        sum1 += Number($(this).val());
                    });

                    $('#total_kg').val(sum1);


                    var sum2 = 0;

                    $('.Rupiah').each(function() {
                        sum2 += Number($(this).val());
                    });

                    $('#total_rp').val(sum2);

                    var hpp_pakan = (sum2 / sum1).toFixed(0);
                    $('#hpp_pakan').val(hpp_pakan);


        
 
            }

            $(tr).find("td input.Qty").on("change", function(){

       

            var  dataid  = $(this).data("id"),
                    qty  = $('#qty'+dataid+'').val(),
                    harga  = $('#harga'+dataid+'').val();

            
                $('#rupiah'+dataid+'').val(qty * harga);


                calc();

            });

            $("#kal").on("click", function(){

             calc();

            });
 

  

          $(function () {
          $('body').on('DOMNodeInserted', 'select', function () {
          $(this).select2();
           });
    
           $('.Item').select2();
           $('.Satuan').select2();

 
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



    $("#add_row").trigger("click");
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
