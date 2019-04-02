@extends('backLayout.app')
@section('title')
Laporan 
@stop
@section('desc')
Laporan Recording
@stop
@section('style')
{{ HTML::style('assets_back/css/plugins/select2/select2.min.css') }}
{{ HTML::style('assets_back/css/plugins/dataTables/datatables.min.css') }}
{{ HTML::style('assets_back/css/plugins/chosen/chosen.css')}}
{{ HTML::style('assets_back/css/plugins/datapicker/datepicker3.css')}}
@endsection
@section('content')
<div class="wrapper wrapper-content">
<div class="row " >
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title row">
                            <h5>Filter Laporan</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                             
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                  
                        <div class="row ibox-content" >
                            <div class="">
                                <div class="form-group" >
                                    <div class="col-sm-4">
                                        <label class="control-label">Farm</label>
                                        {{ Form::select('strain', $farms, null, ['class' => 'form-control Farm','id'=>'farm','placeholder' => 'Pilih Farm']) }}
                                    </div>
                              
                                </div>
                                <div class="form-group" id="data_4" style="">
                                <label class="control-label">Range Waktu</label>
                                    <div class="input-daterange input-group" id="datepicker">
                                    <input type="text" class="input-sm-2 Range form-control" name="start" id="from">
                                    <span class="input-group-addon">to</span>
                                    <input type="text" class="input-sm-2 Range form-control" name="end" id="to">
                                </div>
                              
                            </div>
                         </div>
                          
                        </div>
                    </div>
                
                </div>

            

                </div>
    <div class="row detail_content3">
  
    <div class="col-lg-12 detail_content2" style="background-color: white">
                        <style>
                        .ibox { margin: 1px 2px 0px 0px !important }
                        .ibox.float-e-margins{ margin: 0px 2px !important}
                        </style>
    <div class="ibox-title row">
        <ol class="breadcrumb col-sm-7 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
          <li class="active">
              Laporan Recording
          </li>
        </ol>

        
          <a href="{{ url('recording')}}" class="btn btn-sm btn-outline btn-primary pull-right">
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
  
<table class="table table-striped table-bordered table-hover" id="tblrecording">


<thead>
<tr>
        <th rowspan="2"  style="vertical-align:bottom">Tanggal</th>
        <th rowspan="2" style="vertical-align:bottom">Kandang</th>
        <th rowspan="2" style="vertical-align:bottom">Umur</th>
        <th colspan="7" style="text-align:center">Populasi</th>
        <th colspan="11" style="text-align:center">Produksi</th>
        <th colspan="3" style="text-align:center">Pakan</th>
        <th rowspan="2" style="vertical-align:bottom">FCR</th>
       
    </tr>
    <tr>
      

        <th>Awal</th>
        <th>S.O</th>
        <th>Pindah</th>
        <th>Afkir</th>
        <th>Mati</th>
        <th>Mati(%)</th>
        <th>Akhir</th>

        <th>Utuh</th>
        <th>Utuh(%)</th>
        <th>Putih</th>
        <th>Putih(%)</th>
        <th>Retak</th>
        <th>Retak(%)</th>
        <th>HD(%)</th>
        <th>&Sigma; Butir</th>
        <th>&Sigma; Kg</th>
        <th>Gr/Butir</th>
        <th>Kg/1000</th>

        <th>Gr/Ekor</th>
        <th>&Sigma; Kg</th>
        <th>Jenis</th>

    </tr>
</thead>

<tbody>
</tbody>
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
{{ HTML::script('assets_back/js/plugins/datapicker/bootstrap-datepicker.js') }}
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function(){

       $('.input-daterange input').each(function() {
        $(this).datepicker({format:'yyyy-mm-dd'});
        });


        var spreadsheetOptions = {
        rows: { selected: true },
        orthogonal: 'export'
        };

     var table = $('#tblrecording').DataTable({

      // "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "paging":   false,
        "ordering": false,
       processing: true,
       serverSide: true,
       ajax: '{{url("/recordingapi")}}',
       columns: [
           {data: 'prod_tgl', name: 'prod_tgl'},
           {data: 'kandang', name: 'kandang'},
           {data: 'umur', name: 'umur'},
           {data: 'ppl_awal', name: 'ppl_awal'},
           {data: 'ppl_so', name: 'ppl_so'},
           {data: 'ppl_pindah', name: 'ppl_pindah'},
           {data: 'ppl_afkir', name: 'ppl_afkir'},
           {data: 'ppl_mati', name: 'ppl_mati'},

           { data: 'persen_mati', name: 'persen_mati',
            "render": function ( data, type, row ) {
            				var persen_mati;
                            persen_mati = parseFloat(data.replace(',','').replace('$','')); 
            				if (persen_mati > 0.38){
                       return '<b style="color:red;">' + data + '</b><span style="visibility:hidden">|0</span>';
                    }else{
                       return data;
                    }
                    
                },
             },

           //{data: 'persen_mati', name: 'persen_mati'},
           {data: 'ppl_akhir', name: 'ppl_akhir'},

           {data: 'p_utuh_butir', name: 'p_utuh_butir'},
           {data: 'persen_utuh', name: 'persen_utuh'},
           {data: 'p_putih_butir', name: 'p_putih_butir'},
          // {data: 'persen_putih', name: 'persen_putih'},
           { data: {status_putih : "status_putih", persen_putih : "persen_putih"},
            "render": function ( data, type, row ) {
            				var status_putih, persen_putih;
                            status_putih = data.status_putih; 
                            persen_putih = data.persen_putih; 
                    
            				if (status_putih == "abnormal"){
                       return '<b style="color:red;">' + persen_putih + '</b><span style="visibility:hidden">|0</span>';
                    }else{
                       return persen_putih;
                    }
                    
                },
             },
           {data: 'p_retak_butir', name: 'p_retak_butir'},
           //{data: 'persen_retak', name: 'persen_retak'},
           { data: {status_retak : "status_retak", persen_retak : "persen_retak"},
            "render": function ( data, type, row ) {
            				var status_retak, persen_retak;
                            status_retak = data.status_retak; 
                            persen_retak = data.persen_retak; 
                    
            				if (status_retak == "abnormal"){
                       return '<b style="color:red;">' + persen_retak + '</b><span style="visibility:hidden">|0</span>';
                    }else{
                       return persen_retak;
                    }
                    
                },
             },
          // {data: 'persen_hd', name: 'persen_hd'},
           { data: {status_hd : "status_hd", persen_hd : "persen_hd"},
            "render": function ( data, type, row ) {
            				var status_hd, persen_hd;
                            status_hd = data.status_hd; 
                            persen_hd = data.persen_hd; 
                    
            				if (status_hd == "abnormal"){
                       return '<b style="color:red;">' + persen_hd + '</b><span style="visibility:hidden">|0</span>';
                    }else{
                       return persen_hd;
                    }
                    
                },
             },
          
           {data: 'ttl_butir', name: 'ttl_butir'},
           {data: 'ttl_kg', name: 'ttl_kg'},
          // {data: 'gr_butir', name: 'gr_butir'},
           { data: {gr_butir : "gr_butir", status_gr_butir : "status_gr_butir"},
            "render": function ( data, type, row ) {
            				var gr_butir, status_gr_butir;
                            gr_butir = data.gr_butir; 
                            status_gr_butir = data.status_gr_butir; 
                    
            				if (status_gr_butir == "abnormal"){
                       return '<b style="color:red;">' + gr_butir + '</b><span style="visibility:hidden">|0</span>';
                    }else{
                       return gr_butir;
                    }
                    
                },
             },
           {data: 'kg_1000', name: 'kg_1000'},
           {data: 'gram_ekor', name: 'gram_ekor'},
           {data: 'pakan_qty', name: 'pakan_qty'},
           {data: 'pakan_jenis', name: 'pakan_jenis'},
           //{data: 'fcr', name: 'fcr'},
           { data: {fcr : "fcr", status_fc : "status_fc"},
            "render": function ( data, type, row) {
            				var fcr, status_fc;
                            fcr = data.fcr; 
                            status_fc = data.status_fc; 
                    
            				if (status_fc == "abnormal"){
                       return '<b style="color:red;">' + fcr + '</b><span style="visibility:hidden">|0</span>';
                       //$(row).find('td:eq(3)').css('color', 'red');
                      // return type === 'export' ? '="<b style="color:red;">"' : '"<b style="color:red;">"' ;
                    }else{
                       return fcr;
                  
                    }
                    
                },
                
                
             }
       ], 
      dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {
                extend: 'excel',
                title: 'Laporan Recording',
                customize: function( xlsx ) {
            var sheet = xlsx.xl.worksheets['sheet1.xml'];



            //notif MATI (%)
            $('row c[r^="I"]', sheet).each( function () {

            var fields = $(this).text().split('|');
            $('is t', this).text(fields[0]);
            if ( fields[1] == "0") {
                        $(this).attr( 's', '35' );      
                }

            });


            //notif PUTIH (%)
            $('row c[r^="N"]', sheet).each( function () {

            var fields = $(this).text().split('|');
            $('is t', this).text(fields[0]);
            if ( fields[1] == "0") {
                        $(this).attr( 's', '35' );      
                }

            });


            //notif RETAK (%)
            $('row c[r^="P"]', sheet).each( function () {

            var fields = $(this).text().split('|');
            $('is t', this).text(fields[0]);
            if ( fields[1] == "0") {
                        $(this).attr( 's', '35' );      
                }

            });


            //notif HD
            $('row c[r^="Q"]', sheet).each( function () {

            var fields = $(this).text().split('|');
            $('is t', this).text(fields[0]);
            if ( fields[1] == "0") {
                        $(this).attr( 's', '35' );      
                }

            });

            //notif gram_butir
            $('row c[r^="T"]', sheet).each( function () {

            var fields = $(this).text().split('|');
            $('is t', this).text(fields[0]);
            if ( fields[1] == "0") {
                        $(this).attr( 's', '35' );      
                }

            });
            //notif fcr
            $('row c[r^="Y"]', sheet).each( function () {

                var fields = $(this).text().split('|');
                $('is t', this).text(fields[0]);
                if ( fields[1] == "0") {
                            $(this).attr( 's', '35' );      
                    }
           
            });



            }
            } 
        ]
   });



      $('.Range').on('change', function(e){
         var    farm = $('#farm').val(),
                from = $('#from').val(),
                to = $('#to').val();

       
        table.ajax.url("{{url("/recordingapi")}}?farm="+farm+"&fromDate="+from+"&toDate="+to);
        table.ajax.reload();
       });

       $('.Farm').on('change', function(e){
         var farm = $('#farm').val(),
             from = $('#from').val(),
             to = $('#to').val();

        table.ajax.url("{{url("/recordingapi")}}?farm="+farm+"&fromDate="+from+"&toDate="+to);
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
