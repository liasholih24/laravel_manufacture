<?php $__env->startSection('style'); ?>
   
  <?php echo e(HTML::style('assets_back/css/plugins/chosen/chosen.css')); ?>

  <?php echo e(HTML::style('assets_back/css/plugins/c3/c3.min.css')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?> 

<div class="wrapper wrapper-content">
<div class="row">   
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                            	<span class="label label-success pull-right">Hari ini</span>
                                <h5>Pembelian</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo e(empty($deposit) ? "No Data": "Rp".number_format($deposit,0)); ?></h1>
                                <div class="stat-percent font-bold text-success"><?php echo e(empty($sampah)?"0": $sampah); ?> kg 
                                </div>
                                 <small> dari <?php echo e(empty($nasabah)?"0": $nasabah); ?> nasabah</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                            	<span class="label label-primary pull-right">Hari ini</span>
                                <h5>Penjualan</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">Rp. <?php echo e(empty($penjualan_rp)?"0": number_format($penjualan_rp,0)); ?></h1>
                                <div class="stat-percent font-bold text-navy"><?php echo e(empty($penjualan_kg)?"0": $penjualan_kg); ?> kg </div>
                                <small>kepada <?php echo e(empty($perusahaan)?"0": $perusahaan); ?> perusahaan</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right">Hari ini</span>
                                <h5>Item Kadaluarsa</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo e(empty($deposit) ? "No Data": "Rp".number_format($jPembelian,0)); ?></h1>
                                <div class="stat-percent font-bold text-success"><?php echo e(empty($jKg)?"0": $sampah); ?> kg 
                                </div>
                                 <small> dari 0 lokasi</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-warning pull-right">Update per <?php echo e(Carbon\Carbon::parse($created_at)->diffForHumans()); ?></span>
                                <h5>Pelanggan</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo e(empty($nasabah_ttl)?"No Data": $nasabah_ttl); ?></h1>
                                <small>dari <?php echo e(empty($unit_ttl)?"": $unit_ttl); ?> unit</small>
                            </div>
                        </div>
            </div>
</div>
<div class="row">
                    <div class="col-lg-9">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Pendapatan & Penjualan</h5>
                                <div class="pull-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-white">Update per <?php echo e(date('d M Y')); ?></button>
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
                                            <h2 class="no-margins"><?php echo e(empty($deposit_rpm)?"No Data" : "Rp.".number_format($deposit_rpm,0)); ?></h2>
                                            <small>Deposit (Rp.) <?php echo e(date('M Y')); ?></small>
                                            <div class="stat-percent"><?php echo e(empty($deposit_rpm0)? 0 : number_format($deposit_rpm / $deposit_rpm0 * 100,2)); ?>% <i class="fa <?php if($deposit_rpm >= $deposit_rpm0) {echo"fa-level-up";} else { echo "fa-level-down";} ?> text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: <?php echo e(empty($deposit_rpm)? 0 : number_format($deposit_rpm0 / $deposit_rpm * 100,2)); ?>%;" class="progress-bar"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <h2 class="no-margins"><?php echo e(empty($deposit_kgm)?"No Data" : number_format($deposit_kgm,0)."kg"); ?></h2>
                                            <small>Deposit (kg) <?php echo e(date('M Y')); ?></small>
                                            <div class="stat-percent"><?php echo e(empty($deposit_kgm0)? 0 : number_format(($deposit_kgm / $deposit_kgm0) * 100 ,2)); ?>% <i class="fa <?php if($deposit_kgm >= $deposit_kgm0) {echo"fa-level-up";} else { echo "fa-level-down";} ?> text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: <?php echo e(empty($deposit_kgm0)? 0 : number_format(($deposit_kgm / $deposit_kgm0) * 100 ,2)); ?>%;" class="progress-bar"></div>
                                            </div>
                                        </li>
                                         <li>
                                            <h2 class="no-margins"><?php echo e(empty($penjualan_rpm)?"No Data" : "Rp.".number_format($penjualan_rpm,0)); ?></h2>
                                            <small>Penjualan (Rp.) <?php echo e(date('M Y')); ?> </small>
                                            <div class="stat-percent"><?php echo e(empty($penjualan_rpm0)? 0 : number_format(($penjualan_rpm / $penjualan_rpm0) * 100 ,2)); ?>%
                                             <i class="fa <?php if($penjualan_rpm >= $penjualan_rpm0) {echo"fa-level-up";} else { echo "fa-level-down";} ?> text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: <?php echo e(empty($penjualan_rpm0)? 0 : number_format(($penjualan_rpm / $penjualan_rpm0) * 100 ,2)); ?>%;" class="progress-bar"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <h2 class="no-margins"><?php echo e(empty($penjualan_kgm)?"No Data" :  number_format($penjualan_kgm,0)."kg"); ?></h2>
                                            <small>Penjualan (kg) <?php echo e(date('M Y')); ?></small>
                                            <div class="stat-percent"><?php echo e(empty($penjualan_kgm0)? 0 : number_format(($penjualan_kgm / $penjualan_kgm0) * 100 ,2)); ?>% <i class="fa <?php if($penjualan_kgm >= $penjualan_kgm0) {echo"fa-level-up";} else { echo "fa-level-down";} ?> text-navy"></i></div>
                                            <div class="progress progress-mini">
                                                <div style="width: <?php echo e(empty($penjualan_kgm0)? 0 : number_format(($penjualan_kgm / $penjualan_kgm0) * 100 ,2)); ?>%;" class="progress-bar"></div>
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
                                Rekapitulasi Pendapatan dan Penjualan tahun <?php echo e(date('Y')); ?>

                            </small>
                        </div>
                                </div>


                            </div>

                        </div>
<div class="col-lg-3">
                        <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Persediaan</h5>
                          
                        </div>
                        <div class="ibox-content ibox-heading">
                        <h3>Total Persediaan
                            <div class="stat-percent text-navy"><?php echo e(number_format($qty,1)); ?> Kg</div>
                        </h3>
                        <span class="bar_dashboard">5,3,9,6,5,9,7,3,5,2,4,7,3,2,7,9,6,4,5,7,3,2,1,0,9,5,6,8,3,2,1</span>
                        </div>
                        <?php $__currentLoopData = $sampah_ttl; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="ibox-content">
                        <h3><?php echo e($item->type); ?>

                            <div class="stat-percent text-navy"><?php echo e(number_format($item->qty,1)); ?> kg</div>
                        </h3>
                        <span class="pie"><?php echo e($qty); ?>,<?php echo e($item->qty); ?></span> 
                        <?php echo e(empty($item->qty)? 0 : number_format($item->qty / $qty * 100,0)); ?>% dari persediaan
                        </div>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       
                    </div>
                </div>
                    
               

                    </div>
                     <div class="ibox-content">
                    <div class="row">

                        <div class="col-sm-6">
                            
                            <strong>
                                Rekapitulasi Deposit Sampah
                            </strong><small>Tahun <?php echo e(date('Y')); ?></small>
                             <div id="pie"></div>
                           

                        </div>
                        <div class="col-sm-6">
                            
                            <strong>
                                Rekapitulasi Penjualan Sampah
                            </strong><small>Tahun <?php echo e(date('Y')); ?></small>
                            <div id="pie2"></div>
                            


                        </div>
                       

                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-sm-8">
                            
                            <strong>
                                Rekapitulasi Sedekah Sampah 
                            </strong><small>Tahun <?php echo e(date('Y')); ?></small>
                            <div id="pie3"></div>
                            


                        </div>
                        <div class="col-lg-4">
                           <h4>Rekap Persediaan Sampah (kg)</h4>
                    <div>
                        <ul class="list-group">
                            <?php $__currentLoopData = $sampah_ttl2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item">
                                <span class="badge <?php echo e($item->badge); ?>"><?php echo e($item->jml); ?></span>
                                <?php echo e($item->sampah); ?>

                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           
                        </ul>
                    </div>
 
                       
                         </div>


                  

                </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<?php echo e(HTML::script('assets_back/js/plugins/chosen/chosen.jquery.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/c3/c3.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/d3/d3.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/easypiechart/jquery.easypiechart.js')); ?>

 <?php echo e(HTML::script('assets_back/js/plugins/flot/jquery.flot.js')); ?>

    <?php echo e(HTML::script('assets_back/js/plugins/flot/jquery.flot.time.js')); ?>


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
                [gd(<?php echo e($dep->y); ?>, <?php echo e($dep->m); ?>, <?php echo e($dep->d); ?>), <?php echo e($dep->deposit_rp); ?>],
            <?php }?>
            ];

            var data3 = [
                <?php foreach($penjualans as $pen){?>
                [gd(<?php echo e($pen->y); ?>, <?php echo e($pen->m); ?>, <?php echo e($pen->d); ?>), <?php echo e($pen->penjualan_rp); ?>],
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
                      
                        ['<?php echo e($rekap_sampah->sampah); ?>', '<?php echo e($rekap_sampah->jml); ?>'],
                       
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
                      
                        ['<?php echo e($rekap_sampah2->sampah); ?>', '<?php echo e($rekap_sampah2->jml); ?>'],
                       
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
                      
                        ['<?php echo e($sedekah->sampah); ?>', '<?php echo e($sedekah->jml); ?>'],
                       
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.appdashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>