@extends('backLayout.app')
@section('title')
Laporan
@stop
@section('desc')
Laporan Penjualan
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
            <div class="" style="margin: 30px 0">

                    <div class="form-group ">
                       <label class="font-noraml">Filter Perusahaan</label>
                       <div class="input-group col-sm-12 col-xs-12 ">
                        <select name="perusahaan" class="form-control chosen-select chosen-update" data-placeholder="Pilih Perusahaan" id="perusahaan">
                             <option value="">Pilih Perusahan</option>
                             @foreach($filters as $filter)
                             <option value="{{$filter->id}}">
                               {{$filter->name}}
                             </option>
                             @endforeach
                         </select>
                        </div>
                    </div>

                   <div class="form-group" id="data_4">
                                <label class="font-normal">Filter Tanggal</label>
                                <div class="input-daterange input-group" id="datepicker">
                                    <input type="text" class="input-sm form-control" name="start" id="from">
                                    <span class="input-group-addon">to</span>
                                    <input type="text" class="input-sm form-control" name="end" id="to">
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
              Laporan Penjualan
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

<table class="table table-striped table-bordered table-hover" id="tblpenjualan">
<thead>
    <tr>
        <th>ID</th>
        <th>Kode</th>
        <th>Perusahaan</th>
        <th>Jml (Kg)</th>
        <th>Jumlah (Rp)</th>
        <th>Keterangan</th>
        <th>Tgl. Penjualan</th>
    </tr>
</thead>
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


      var table = $('#tblpenjualan').DataTable({
       processing: true,
       serverSide: true,
       ajax: '{{url("/penjualanapi")}}',
       columns: [
           {data: 'id', name: 'id'},
           {data: 'code', name: 'code'},
           {data: 'getperusahaan.name', name: 'perusahaan'},
           {data: 'total_kg', name: 'total_kg'},
           {data: 'total_rp', name: 'total_rp'},
           {data: 'keterangan', name: 'keterangan'},
           {data: 'created_at', name: 'created_at'}

       ],
      // lengthMenu: [[10, 25, 50, 100, 250, 500], [10, 25, 50,100,250,500, "All"]],
       responsive: {
           details: {
               type: 'column'
           }
       },
       columnDefs: [ {
           className: 'control',
           orderable: false,
           targets:   0
       } ],
       // order: [ 8, 'desc' ],

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
       ]

   });

   $('#filter').on('click', function(e){
     var perusahaan = $('#perusahaan').val();
     var from = $('#from').val();
     var to = $('#to').val();
     table.ajax.url("{{url("/penjualanapi")}}?perusahaan="+perusahaan+"&fromDate="+from+"&toDate="+to);
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
