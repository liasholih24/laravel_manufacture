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
                                <h1 class="no-margins">{{ number_format($ttl_butir)}}</h1>
                                <div class="stat-percent font-bold text-success">{{ number_format($ttl_kg)}} kg 
                                </div>
                                <small> dari {{ number_format($pakan_kandang)}} kandang</small>
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
                                <h1 class="no-margins">{{ number_format($jml_akhir)}}</h1>
                                <div class="stat-percent font-bold text-navy"></div>
                                <small> dari {{ number_format($pakan_kandang)}} kandang</small>
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
                                <h1 class="no-margins">{{ number_format($pakan)}}</h1>
                                <div class="stat-percent font-bold text-success">kg 
                                </div>
                                 <small> dari {{ number_format($pakan_kandang)}} kandang</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-warning pull-right">Update per today</span> 
                                <h5>HPP</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ number_format($hpp) }}</h1>
                                <small>HPP bulan lalu : {{ number_format($hpp0) }}</small>
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
                                            <h2 class="no-margins">0</h2>
                                            <small>Pemakaian Pakan (Rp.) {{date('M Y')}}</small>
                                            <div class="stat-percent">0% <i class="fa fa-level-up text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: 0%;" class="progress-bar"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <h2 class="no-margins">0</h2>
                                            <small>Pemakaian Pakan (kg) {{date('M Y')}}</small>
                                            <div class="stat-percent">0% <i class="fa fa-level-up text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: 0%;" class="progress-bar"></div>
                                            </div>
                                        </li>
                                         <li>
                                            <h2 class="no-margins">0</h2>
                                            <small>Hasil Produksi (Rp.) {{date('M Y')}} </small>
                                            <div class="stat-percent">0%
                                             <i class="fa fa-level-up text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: 0%;" class="progress-bar"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <h2 class="no-margins">0</h2>
                                            <small>Hasil Produksi (kg) {{date('M Y')}}</small>
                                            <div class="stat-percent">0% <i class="fa fa-level-up text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: 0%;" class="progress-bar"></div>
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
                            <div class="stat-percent text-navy">{{number_format(7697)}} Kg</div>
                        </h3>
                        <span class="bar_dashboard">5,3,9,6,5,9,7,3,5,2,4,7,3,2,7,9,6,4,5,7,3,2,1,0,9,5,6,8,3,2,1</span>
                        </div>
                 
                       
                    </div>
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

      

      



       
        });
    </script>
@endsection
