@extends('backLayout.app')
@section('title')
Pakan
@stop
@section('desc')
Edit Komposisi Pakan
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
        <th class="text-center" style="width:200px;">
          Satuan
        </th>
        <th class="text-center" style="width:100px;">
          Jumlah
        </th> 

      </tr>
    </thead>
    <tbody>
  
    @foreach($details as $detail)
        <tr id='addr0' data-id="0" >
        <td data-name="del">
            <button name="del0" class='btn btn-default btn-xs glyphicon glyphicon-remove row-remove'></button>
        </td>
        <td data-name="item">
          <select  name="item[]" class="form-control Item chosen-select" data-placeholder="Pilih Item"  style="width:300px;">
                @foreach($items as $item)
                    <option value="{{$item->id}}" <?php if($detail->item == $item->id) echo"selected";?>>{{$item->name}}</option>
                @endforeach
          </select>
        </td>
        <td data-name="satuan">
            <select  name="satuan[]" class="form-control Satuan chosen-select" data-placeholder="Pilih Satuan" id="satuan" style="width:200px;">
                @foreach($satuans as $satuan)
                    <option value="{{$item->id}}" <?php if($detail->satuan == $satuan->id) echo"selected";?>>{{$satuan->name}}</option>
                @endforeach
            </select>
        </td>
        <td data-name="qty">
            {!! Form::number('qty[]', $detail->qty , ['class' => 'form-control Qty','step'=>'any']) !!}
        </td>
      </tr>
    @endforeach
    </tbody>
    <tfoot>
     
    </tfoot>
    </table>
    </div>
    </div>
     <a id="add_row" class="btn btn-success btn-xs pull-right btn-outline " ><i class="fa fa-plus"></i></a>
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
<script>
$(document).ready(function () {

            

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

