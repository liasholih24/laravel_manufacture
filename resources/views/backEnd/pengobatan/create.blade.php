@extends('backLayout.app')
@section('title')
Create new Pengobatan
@stop
@section('style')
  {{ HTML::style('assets_back/css/plugins/select2/select2.min.css')}}
  {{ HTML::style('assets_back/css/plugins/daterangepicker/daterangepicker.css')}}
  {{ HTML::style('assets_back/css/plugins/datapicker/datepicker3.css')}}
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
   <ol class="breadcrumb col-sm-4 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
        <li class="">
            <a href="{{ url('pengobatan') }}"> Pengobatan</a>
        </li>
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
                    {!! Form::text('tgl_checkin', $datenow, ['id'=>'tgl_checkin','class' => 'form-control','data-date-format'=>'yyyy-mm-dd','placeholder' => $datenow,'required'=>'required']) !!}
                      {!! $errors->first('tgl_checkin', '<p class="help-block">:message</p>') !!}
                </div>  
            </div>
            <div class="form-group {{ $errors->has('kandang') ? 'has-error' : ''}}">
                {!! Form::label('kandang', 'Kandang*', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-5">
                    {{ Form::select('kandang', $kandangs, null, ['class' => 'form-control select2 Kandang','placeholder' => 'Pilih Kandang','required'=>'required']) }}
                    {!! $errors->first('kandang', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('populasi') ? 'has-error' : ''}}">
                {!! Form::label('populasi', 'Populasi*', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-5">
                        {!! Form::text('populasi', null, ['class' => 'form-control Numeric','placeholder' =>'Jml. Populasi','required'=>'required']) !!}
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
                   <th class="text-center" style="width:230px;">
                   Tanggal
                   </th>
                   <th class="text-center" style="width:100px;">
                   Umur
                   </th> 
                   <th class="text-center" style="width:250px;">
                   Obat/Vitamin/Vaksin
                   </th> 
                   <th class="text-center" style="width:100px;">
                   Satuan
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
               <td data-name="daterange">
                  <input type="text" name="tgl_pengobatan[]" class="form-control" value="{{$daterange}}" />
               </td>
               <td data-name="umur">
                    {!! Form::text('umur[]', null, ['class' => 'form-control',]) !!}
               </td>
               <td data-name="obat">
               <select  name="obat[]" class="form-control Obat select2" data-placeholder="Pilih Obat/Vitamin"  style="width:300px;">
                    @foreach($obats as $obat)
                        <option value="{{$obat->id}}">{{$obat->name}}</option>
                    @endforeach
               </select>
               </td>
               <td data-name="satuan">
               <select  name="satuan[]" class="form-control Satuan select2" data-placeholder="Pilih Satuan"  style="width:200px;">
                    @foreach($satuans as $satuan)
                        <option value="{{$satuan->id}}">{{$satuan->name}}</option>
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
{{ HTML::script('assets_back/js/plugins/momentjs/moment.min.js') }}
{{ HTML::script('assets_back/js/plugins/daterangepicker/daterangepicker.min.js') }}
{{ HTML::script('assets_back/js/plugins/datapicker/bootstrap-datepicker.js') }}
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

        $(function () {
            $('body').on('DOMNodeInserted', 'select', function () {
                 $(this).select2();
            });
    
           $('.select2').select2({
                theme: 'bootstrap',
                width: '100%'
            });
            $('input[name="tgl_pengobatan[]"]').daterangepicker({
                opens: 'left'
                }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
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
     //$("#add_row").trigger("click");

    });
            
   $("#tgl_checkin").datepicker({
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
