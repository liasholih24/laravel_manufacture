@extends('backLayout.appdashboard')
@section('style')
   
  {{ HTML::style('assets_back/css/plugins/chosen/chosen.css')}}
  {{ HTML::style('assets_back/css/plugins/c3/c3.min.css')}}
@endsection
@section('content') 

<div class="wrapper wrapper-content">
<div class="row">   
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                            	<span class="label label-success pull-right">Hari ini</span>
                                <h5>Hasil Produksi</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{empty($deposit) ? "No Data": "Rp".number_format($deposit,0)}}</h1>
                                <div class="stat-percent font-bold text-success">{{empty($sampah)?"0": $sampah}} kg 
                                </div>
                                 <small> dari {{empty($nasabah)?"0": $nasabah }} kandang</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                            	<span class="label label-primary pull-right">Hari ini</span>
                                <h5>Populasi Akhir</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{empty($penjualan_rp)?"0": number_format($penjualan_rp,0)}}</h1>
                                <div class="stat-percent font-bold text-navy">{{empty($penjualan_kg)?"0": $penjualan_kg}} kg </div>
                                <small>dari {{ empty($perusahaan)?"0": $perusahaan }} kandang</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right">Hari ini</span>
                                <h5>Pemakaian Pakan</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{empty($deposit) ? "No Data": "Rp".number_format($jPembelian,0)}}</h1>
                                <div class="stat-percent font-bold text-success">{{empty($jKg)?"0": $sampah}} kg 
                                </div>
                                 <small> dari 0 kandang</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-warning pull-right">Update per {{ Carbon\Carbon::parse($created_at)->diffForHumans() }}</span>
                                <h5>HPP</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{empty($nasabah_ttl)?"No Data": $nasabah_ttl }}</h1>
                                <small>per kg</small>
                            </div>
                        </div>
            </div>
</div>
<div class="row">
                    <div class="col-lg-9">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Hasil Produksi & Pemakaian Pakan</h5>
                                <div class="pull-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-white">Update per {{date('d M Y')}}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                <div class="col-lg-9">
                                    <div class="flot-chart">
                                        <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <ul class="stat-list">
                                        <li>
                                            <h2 class="no-margins">{{empty($deposit_rpm)?"No Data" : "Rp.".number_format($deposit_rpm,0)}}</h2>
                                            <small>Pemakaian Pakan (Rp.) {{date('M Y')}}</small>
                                            <div class="stat-percent">{{empty($deposit_rpm0)? 0 : number_format($deposit_rpm / $deposit_rpm0 * 100,2)}}% <i class="fa <?php if($deposit_rpm >= $deposit_rpm0) {echo"fa-level-up";} else { echo "fa-level-down";} ?> text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: {{empty($deposit_rpm)? 0 : number_format($deposit_rpm0 / $deposit_rpm * 100,2)}}%;" class="progress-bar"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <h2 class="no-margins">{{empty($deposit_kgm)?"No Data" : number_format($deposit_kgm,0)."kg"}}</h2>
                                            <small>Pemakaian Pakan (kg) {{date('M Y')}}</small>
                                            <div class="stat-percent">{{empty($deposit_kgm0)? 0 : number_format(($deposit_kgm / $deposit_kgm0) * 100 ,2)}}% <i class="fa <?php if($deposit_kgm >= $deposit_kgm0) {echo"fa-level-up";} else { echo "fa-level-down";} ?> text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: {{empty($deposit_kgm0)? 0 : number_format(($deposit_kgm / $deposit_kgm0) * 100 ,2)}}%;" class="progress-bar"></div>
                                            </div>
                                        </li>
                                         <li>
                                            <h2 class="no-margins">{{empty($penjualan_rpm)?"No Data" : "Rp.".number_format($penjualan_rpm,0)}}</h2>
                                            <small>Hasil Produksi (Rp.) {{date('M Y')}} </small>
                                            <div class="stat-percent">{{empty($penjualan_rpm0)? 0 : number_format(($penjualan_rpm / $penjualan_rpm0) * 100 ,2)}}%
                                             <i class="fa <?php if($penjualan_rpm >= $penjualan_rpm0) {echo"fa-level-up";} else { echo "fa-level-down";} ?> text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: {{empty($penjualan_rpm0)? 0 : number_format(($penjualan_rpm / $penjualan_rpm0) * 100 ,2)}}%;" class="progress-bar"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <h2 class="no-margins">{{empty($penjualan_kgm)?"No Data" :  number_format($penjualan_kgm,0)."kg"}}</h2>
                                            <small>Hasil Produksi (kg) {{date('M Y')}}</small>
                                            <div class="stat-percent">{{empty($penjualan_kgm0)? 0 : number_format(($penjualan_kgm / $penjualan_kgm0) * 100 ,2)}}% <i class="fa <?php if($penjualan_kgm >= $penjualan_kgm0) {echo"fa-level-up";} else { echo "fa-level-down";} ?> text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: {{empty($penjualan_kgm0)? 0 : number_format(($penjualan_kgm / $penjualan_kgm0) * 100 ,2)}}%;" class="progress-bar"></div>
                                            </div>
                                        </li>
                                        </ul>
                                    </div>
                                </div>
                                    <div class="m-t-md">
                            <small class="pull-right">
                                <i class="fa fa-clock-o"> </i>
                               <strong>Rekap Perbandingan</strong> dengan bulan lalu.
                            </small>
                            <small>
                                Rekapitulasi Pendapatan dan Penjualan tahun {{date('Y')}}
                            </small>
                        </div>
                                </div>


                            </div>

                        </div>
<div class="col-lg-3">
                        <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Persediaan Pakan</h5>
                          
                        </div>
                        <div class="ibox-content ibox-heading">
                        <h3>Total Persediaan
                            <div class="stat-percent text-navy">{{number_format($qty,1)}} Kg</div>
                        </h3>
                        <span class="bar_dashboard">5,3,9,6,5,9,7,3,5,2,4,7,3,2,7,9,6,4,5,7,3,2,1,0,9,5,6,8,3,2,1</span>
                        </div>
                        @foreach($sampah_ttl as $item)
                        <div class="ibox-content">
                        <h3>{{$item->type}}
                            <div class="stat-percent text-navy">{{number_format($item->qty,1)}} kg</div>
                        </h3>
                        <span class="pie">{{$qty}},{{$item->qty}}</span> 
                        {{empty($item->qty)? 0 : number_format($item->qty / $qty * 100,0)}}% dari persediaan
                        </div>
                       @endforeach
                       
                    </div>
                </div>
                    
               

                    </div>
                     <div class="ibox-content">
                    <div class="row">

                        <div class="col-sm-6">
                            
                            <strong>
                                Rekapitulasi Deposit Pakan
                            </strong><small>Tahun {{date('Y')}}</small>
                             <div id="pie"></div>
                           

                        </div>
                        <div class="col-sm-6">
                            
                            <strong>
                                Rekapitulasi Hasil Produksi
                            </strong><small>Tahun {{date('Y')}}</small>
                            <div id="pie2"></div>
                            


                        </div>
                       

                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-sm-8">
                            
                            <strong>
                                Rekapitulasi Populasi Akhir 
                            </strong><small>Tahun {{date('Y')}}</small>
                            <div id="pie3"></div>
                            


                        </div>
                        <div class="col-lg-4">
                           <h4>Rekap Persediaan Barang (kg)</h4>
                    <div>
                        <ul class="list-group">
                            @foreach($sampah_ttl2 as $item)
                            <li class="list-group-item">
                                <span class="badge {{$item->badge}}">{{$item->jml}}</span>
                                {{$item->sampah}}
                            </li>
                            @endforeach
                           
                        </ul>
                    </div>
 
                       
                         </div>


                  

                </div>

@endsection
@section('script')
{{ HTML::script('assets_back/js/plugins/chosen/chosen.jquery.js') }}
{{ HTML::script('assets_back/js/plugins/c3/c3.min.js') }}
{{ HTML::script('assets_back/js/plugins/d3/d3.min.js') }}
{{ HTML::script('assets_back/js/plugins/easypiechart/jquery.easypiechart.js') }}
 {{ HTML::script('assets_back/js/plugins/flot/jquery.flot.js') }}
    {{ HTML::script('assets_back/js/plugins/flot/jquery.flot.time.js') }}

<script>
        $(document).ready(function() {
            $('.chart').easyPieChart({
                barColor: '#f8ac59',
//                scaleColor: false,
                scaleLength: 5,
                lineWidth: 4,
                size: 80
            });

            $('.chart2').easyPieChart({
                barColor: '#1c84c6',
//                scaleColor: false,
                scaleLength: 5,
                lineWidth: 4,
                size: 80
            });

            var data2 = [
            <?php foreach($deposits as $dep){?>
                [gd({{$dep->y}}, {{$dep->m}}, {{$dep->d}}), {{$dep->deposit_rp}}],
            <?php }?>
            ];

            var data3 = [
                <?php foreach($penjualans as $pen){?>
                [gd({{$pen->y}}, {{$pen->m}}, {{$pen->d}}), {{$pen->penjualan_rp}}],
            <?php }?>
            ];


            var dataset = [
                {
                    label: "Deposit",
                    data: data3,
                    color: "#1ab394",
                    bars: {
                        show: true,
                        align: "center",
                        barWidth: 24 * 60 * 60 * 600,
                        lineWidth:0
                    }

                }, {
                    label: "Penjualan",
                    data: data2,
                    yaxis: 2,
                    color: "#1C84C6",
                    lines: {
                        lineWidth:1,
                            show: true,
                            fill: true,
                        fillColor: {
                            colors: [{
                                opacity: 0.2
                            }, {
                                opacity: 0.4
                            }]
                        }
                    },
                    splines: {
                        show: false,
                        tension: 0.6,
                        lineWidth: 1,
                        fill: 0.1
                    },
                }
            ];


            var options = {
                xaxis: {
                    mode: "time",
                    tickSize: [3, "day"],
                    tickLength: 0,
                    axisLabel: "Date",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Arial',
                    axisLabelPadding: 10,
                    color: "#d5d5d5"
                },
                yaxes: [{
                    position: "left",
                    max: 1070,
                    color: "#d5d5d5",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Arial',
                    axisLabelPadding: 3
                }, {
                    position: "right",
                    clolor: "#d5d5d5",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: ' Arial',
                    axisLabelPadding: 67
                }
                ],
                legend: {
                    noColumns: 1,
                    labelBoxBorderColor: "#000000",
                    position: "nw"
                },
                grid: {
                    hoverable: false,
                    borderWidth: 0
                }
            };

            function gd(year, month, day) {
                return new Date(year, month - 1, day).getTime();
            }

            var previousPoint = null, previousLabel = null;

            $.plot($("#flot-dashboard-chart"), dataset, options);

            var mapData = {
                "US": 298,
                "SA": 200,
                "DE": 220,
                "FR": 540,
                "CN": 120,
                "AU": 760,
                "BR": 550,
                "IN": 200,
                "GB": 120,
            };

            //rekap sampah 1
            c3.generate({
                bindto: '#pie',
                data:{
                    columns: [
                    <?php foreach ($rekap_sampahs as $rekap_sampah) {?>
                      
                        ['{{$rekap_sampah->sampah}}', '{{$rekap_sampah->jml}}'],
                       
                       <?php }?>
                    ],
                    colors:{
                        Kertas: '#1ab394',
                        Plastik: '#23c6c8',
                        EMBERAN: '#1C84C6',
                        KACA: '#ccc',
                        LOGAM: '#999',
                    },
                    type : 'bar'
                }
            });
            //rekap sampah 2
            c3.generate({
                bindto: '#pie2',
                data:{
                    columns: [
                    <?php foreach ($rekap_sampahs2 as $rekap_sampah2) {?>
                      
                        ['{{$rekap_sampah2->sampah}}', '{{$rekap_sampah2->jml}}'],
                       
                       <?php }?>
                    ],
                    colors:{
                        Kertas: '#1ab394',
                        Plastik: '#23c6c8',
                        EMBERAN: '#1C84C6',
                        KACA: '#ccc',
                        LOGAM: '#999',
                    },
                    type : 'bar'
                }
            });

             c3.generate({
                bindto: '#pie3',
                data:{
                    columns: [
                    <?php foreach ($sedekahs as $sedekah) {?>
                      
                        ['{{$sedekah->sampah}}', '{{$sedekah->jml}}'],
                       
                       <?php }?>
                    ],
                    colors:{
                        Kertas: '#1ab394',
                        Plastik: '#23c6c8',
                        EMBERAN: '#1C84C6',
                        KACA: '#ccc',
                        LOGAM: '#999',
                    },
                    type : 'bar'
                }
            });



       
        });
    </script>
@endsection
