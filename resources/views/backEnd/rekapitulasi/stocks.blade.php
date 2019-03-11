@extends('backLayout.app')
@section('title')
Rekapitulasi 
@stop
@section('desc')
Rekapitulasi Persediaan
@stop
@section('style')
{{ HTML::style('assets_back/css/plugins/select2/select2.min.css') }}
{{ HTML::style('assets_back/css/plugins/dataTables/datatables.min.css') }}
{{ HTML::style('assets_back/css/plugins/chosen/chosen.css')}}
{{ HTML::style('assets_back/css/plugins/datapicker/datepicker3.css')}}
@endsection
@section('content')
<div class="wrapper wrapper-content">
    <div class="row detail_content3">
    <div class="col-lg-3 detail_content">
<div class="ibox float-e-margins">
    <div class="ibox-title row" style="height: 54px">
        <h5>Pencarian</h5>
    </div>
    <div class="ibox-content row" style="min-height: 65vh;">
        <div class="file-manager">
            <div class="dd" id="nestable2">
                <ol class="dd-list">
                    <li class="dd-item ">
                        <div class="dd-handle dd-nodrag" style="margin-left: auto; margin-right: auto">
                            <a href="{{ url('rekapitulasi/stocks')}}">
                            <span class="label label-info"></span> <strong>Lihat Semua</strong>
                            </a>
                            <p class="pull-right"></p>
                        </div>
                    </li>
                </ol>
            </div>
            <div class="" style="margin: 30px 0">

                    <div class="form-group ">
                       <label class="font-noraml">Gudang</label>
                       <div class="input-group col-sm-12 col-xs-12 ">
                        <select name="gudang" class="form-control chosen-select Gudang chosen-update" data-placeholder="Pilih Gudang" id="gudang">
                             <option value="">Pilih Gudang</option>
                             @foreach($filters as $filter)
                             <option value="{{$filter->id}}" <?php if ($filter->id == $id) echo ' selected="selected"'; ?>>
                               {{$filter->name}}
                             </option>
                             @endforeach
                         </select>
                        </div>
                    </div>

             <div class="form-group">
                    <div class="col-sm-12">
                  <button class="btn btn-success pull-right Filter" id="filter">
                         Filter
                      </button>
                      
                  </div>
                </div>
                 
                 
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
</div>
    <div class="col-lg-9 detail_content2" style="background-color: white">
                        <style>
                        .ibox { margin: 1px 2px 0px 0px !important }
                        .ibox.float-e-margins{ margin: 0px 2px !important}
                        </style>
    <div class="ibox-title row">
        <ol class="breadcrumb col-sm-7 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
          <li class="active">
              <strong>Rekapitulasi Persediaan</strong> <small>dikelompokkan berdasarkan item</small>
          </li>
        </ol>
          <a href="{{ url('stocks')}}" class="btn btn-sm btn-outline btn-primary pull-right">
              <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
          </a>
       
    </div>
  <div class="col-xs-12 col-sm-12 ibox-content row" style="min-height:65vh;">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
        <div class="alert alert-{{ $msg }} alert-dismissable">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          {{ Session::get('alert-' . $msg) }}.
        </div>
        @endif
      @endforeach
    <div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="tblstocks">
<thead>
    <tr>
        <th>Gudang</th>
        <th>Item</th>
        <th>Jenis</th>
        <th>Stok</th>
    </tr>
</thead>
<tfoot>
            <tr>
               <th></th>
               <th></th>
               <th>Total</th>
               <th></th>
            </tr>
</tfoot>
<tbody>
</tbody>
</tfoot>
</table>



    </div>
  </div>
</div>
</div>
</div>

@endsection

@section('script')
{{ HTML::script('assets_back/js/plugins/dataTables/datatables.min.js') }}
{{ HTML::script('assets_back/js/plugins/select2/select2.full.min.js') }}
{{ HTML::script('assets_back/js/plugins/chosen/chosen.jquery.js') }}
{{ HTML::script('assets_back/js/plugins/datapicker/bootstrap-datepicker.js') }}

<!-- Page-Level Scripts -->
<script>
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

       $('.input-daterange input').each(function() {
        $(this).datepicker({format:'yyyy-mm-dd'});
        });

     var table = $('#tblstocks').DataTable({
       processing: true,
       serverSide: true,
       ajax: '{{url("/rekstocksapi")}}',
       columns: [
           {data: 'gudang', name: 'gudang'},
           {data: 'item', name: 'item'},
           {data: 'jenis', name: 'jenis'},
           {data: 'qty', name: 'qty'}
           
       ],
      lengthMenu: [[20, 25, 25, 30], [20, 25, 25, 30, "All"]],
       responsive: {
           details: {
               type: 'column'
           }
       },
       order: [ 0, 'desc' ],
       
       dom: '<"html5buttons"B>lTfgitp',
     
       buttons: [
           { extend: 'copy'},
           {extend: 'csv'},
           {extend: 'excel', title: 'ExampleFile'},
           {extend: 'pdf', title: 'ExampleFile'},

           {extend: 'print',
            customize: function (win){
                   $(win.document.body).addClass('white-bg');
                   $(win.document.body).css('font-size', '10px');

                   $(win.document.body).find('table')
                           .addClass('compact')
                           .css('font-size', 'inherit');
           }
           }
       ],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

              // Total over all pages
            qty_in = api
                .column(3)
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            QtyIn = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                ''+QtyIn +''
            );
 
        }

   });



      $('#filter').on('click', function(e){
        var gudang    = $('#gudang').val(),
            from = $('#from').val(),
            to = $('#to').val();

     table.ajax.url("{{url("/rekstocksapi")}}?gudang="+gudang+"&fromDate="+from+"&toDate="+to);
     table.ajax.reload();
   });

    });
    
    $('#data_4 .input-group.date').datepicker({
                minViewMode: 1,
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                todayHighlight: true,
                format :  'yyyy-mm-dd'
            });
   


</script>
@endsection
