
<?php $__env->startSection('style'); ?>

  <?php echo e(HTML::style('assets_back/css/plugins/chosen/chosen.css')); ?>

  <?php echo e(HTML::style('assets_back/css/plugins/c3/c3.min.css')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row wrapper wrapper-content">
	 <div class="ibox col-sm-12" >

        <div class="col-lg-6">
            <div class="col-sm-12">
                <div class="ibox">
                    <div class="ibox-title  row" style="background-color: rgba(0, 192, 243, 0.45) !important; color: #fff">
                        <div class="col-sm-2">
                            <i class="fa fa-shield fa-2x"></i>
                        </div>
                        <div class="col-sm-10 pull-right">
                            <h2 class="font-bold no-margins" id="investTtl">
                                Assets Value
                            </h2>
                        </div>
                    </div>
                    <div class="ibox-content row"  style="min-height: 135px !important">
                        <div class="row col-sm-12">
                             <h1 class="m-xs text-center font-bold" id="investInfo" style="color: rgba(240, 90, 34, 0.65) !important">Rp.<?php echo e(number_format($asset[0]->investasi,2,',','.')); ?></h1>
                        </div>
                        <div class="row col-sm-12 " style="padding-top: 10px">
                             <h4 id="investData" style="text-align: center">On <?php echo e($assetnull[0]->ttl); ?> from <?php echo e($asset[0]->ttl); ?> Assets</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="col-sm-12">
                <div class="ibox">
                    <div class="ibox-title  row" style="background-color: rgba(0, 103, 164, 0.7) !important; color: #fff">
                        <div class="col-sm-2">
                            <i class="fa fa-money fa-2x"></i>
                        </div>
                        <div class="col-sm-10 pull-right">
                            <h2 class="font-bold no-margins" id="reveneuTtl">
                                Revenue
                            </h2>
                        </div>
                    </div>
                    <div class="ibox-content row" style="min-height: 135px !important">
                        <div class="row col-sm-12">
                             <h1 class="m-xs text-center font-bold" id="revenueInfo" style="color: rgba(240, 90, 34, 0.65) !important">
                                <?php if($rev > 0){  ;?>
                                    Rp.<?php echo number_format($rev,2,',','.') ;?>
                                <?php }else{ ;?>
                                    <strong>No</strong>
                                <?php };?>
                             </h1>
                        </div>
                        <div class="row col-sm-12"  style="padding-top: 10px">
                             <h4 id="revenueData" style="text-align: center">From <?php echo $customer ;?> SID</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="ibox col-sm-12" style="margin-top: -30px">
		<div class="col-lg-3">
            <div class="col-sm-12">
                <div class="ibox">
                    <div class="ibox-title  row" style="background-color: rgba(255, 203, 4, 0.67); color: #fff">
                        <div class="col-sm-2">
                            <i class="fa fa-barcode fa-2x"></i>
                        </div>
                        <div class="col-sm-10 pull-right">
                            <h2 class="font-bold no-margins" id="assetsTtl" style="font-size: 20px">
                                Assets
                            </h2>
                        </div>
                    </div>
                    <div class="ibox-content row"  style="min-height: 155px !important; max-height: 155px">
                       <div class="col-sm-12 text-center">
                             <h2 class="m-xs text-center font-bold" id="assetsTot" style="font-size: 18px"><?php echo e($asset[0]->ttl); ?></h2>
                        </div>
                        <div class="col-sm-12" style="padding-top: 10px">
                             <h4 id="assetsInfo"  style="text-align: center">From <?php echo e($sbu->pop_ttl-$popCustomer); ?> Site and <?php echo e($popCustomer); ?> Customer Site in <?php echo e($sbus->name); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="col-sm-12">
                <div class="ibox">
                    <div class="ibox-title  row " style="background-color: rgba(26, 179, 148, 0.61); color: #fff">
                        <div class="col-sm-2">
                            <i class="fa fa-dashboard fa-2x"></i>
                        </div>
                        <div class="col-sm-10 pull-right">
                            <h2 class="font-bold no-margins" style="font-size: 20px">
                                Port Utilizations
                            </h2>
                        </div>
                    </div>
                    <div class="ibox-content row"  style="min-height: 155px !important">
                       <div class="col-sm-12 text-center">
                             <h1 class="m-xs text-center font-bold"  style="font-size: 18px" id="percentPort"><?php if($allPort != 0){ $percent = ($usedPort/$allPort)*100; echo number_format($percent,2,',','.') ;}else{ echo '0' ;};?>%</h1>
                        </div>
                        <div class="col-sm-12" style="padding-top: 10px">
                             <h3  style="text-align: center;"  id="percentInfo"><?php echo e($usedPort); ?> port used from total <?php echo e($allPort); ?> port.</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="col-sm-12">
                <div class="ibox">
                    <div class="ibox-title  row" style="background-color: rgba(240, 90, 34, 0.65) !important; color: #fff">
                        <div class="col-sm-2">
                            <i class="fa fa-trophy fa-2x"></i>
                        </div>
                        <div class="col-sm-10 pull-right">
                            <h2 class="font-bold no-margins" id="orderTtl" style="font-size: 20px">
                                Work Order
                            </h2>
                        </div>
                    </div>
                    <div class="ibox-content row" style="min-height: 155px !important">
                        <div class="row text-center col-sm-12">
                             <h2 class="m-xs font-bold" style="font-size: 18px" id="orderInfo">
                                <?php if(is_numeric($workorder[0]->pop_fin)){ ;?>
                                    <?php if($workorder[0]->pop_fin != 0): ?>
                                      <?php echo e(round(($workorder[0]->pop_fin / $sbu->pop_ttl)*100)); ?>%
                                    <?php elseif( ( ($workorder[0]->pop_fin / $sbu->pop_ttl) > 20) && ( ($workorder[0]->pop_fin / $sbu->pop_ttl) < 50)): ?>
                                        <strong><?php echo e(round(($workorder[0]->pop_fin / $sbu->pop_ttl)*100)); ?>%</strong> Completed
                                    <?php else: ?>
                                        <strong>0%</strong> Completed
                                  <?php endif; ?>
                                <?php }else{ ?>
                                    <strong>0%</strong> Completed
                                <?php ;} ;?>
                             </h2>
                        </div>
                        <div class="row col-sm-12" style="padding-top: 10px">
                             <h4 id="orderData" style="text-align: center">From <?php echo e($workorder[0]->wo_ttl); ?> work order</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="col-sm-12">
                <div class="ibox">
                    <div class="ibox-title  row " style="background-color: rgba(248, 172, 89, 0.67); color: #fff">
                        <div class="col-sm-2">
                            <i class="fa fa-users fa-2x"></i>
                        </div>
                        <div class="col-sm-10 pull-right">
                            <h2 class="font-bold no-margins" style="font-size: 20px">
                                Active Users
                            </h2>
                        </div>
                    </div>
                    <div class="ibox-content row"  style="min-height: 155px !important">
                       <div class="col-sm-12 text-center">
                             <h1 class="m-xs text-center font-bold"  style="font-size: 18px" id="portTotal"><?php echo e($activeUser); ?></h1>
                        </div>
                        <div class="col-sm-12" style="padding-top: 10px">
                             <h3  style="text-align: center;"  id="portInfo">Active Users</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="col-sm-12"  style="margin-top: -30px">
        <div class="ibox">
            <div class="ibox-title">
                  <h5>Maps</h5>
                  <button onclick="window.location.reload(true)" class="pull-right btn-outline btn btn-sm btn-success" style="margin-top: -5px !important"><i class="fa fa-icon fa-refresh"></i></button>
                    <!--
                    <button class="search pull-right btn-outline btn btn-sm btn-primary" style="margin-top: -5px !important; margin-right: 10px"><i class="fa fa-icon fa-search" style="margin-right: 10px"></i>Search</button>
                    -->
                    <div class="col-lg-3 pull-right" style="margin-top: -5px !important; margin-right: -10px">
                        <select data-placeholder="Choose a Site..." class="chosen-select pull-right" style="max-width:200px; margin-top: -20px !important" tabindex="2" id="pop_id">
                          <option  value="">Select Site</option>
                        <?php $__currentLoopData = $pops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ps): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($ps->id); ?>" data-title="<?php echo e($ps->name); ?>" data-sbu="<?php echo e($ps->sbu_id); ?>" data-lat="<?php echo e($ps->lat); ?>" data-address="<?php echo e($ps->address); ?>" data-long="<?php echo e($ps->lon); ?>"> <?php echo e($ps->name); ?> (<?php echo e($ps->code); ?>)</option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

            </div>
            <div class="ibox-content col-sm-12" id="mapsData">
             	<div class="google-map col-sm-12" id="map" style="min-height: 55vh"></div>
             	<div class="google-map col-sm-6" id="maps" style="min-height: 55vh"></div>
          		<div class="col-sm-6" id="searchData">
          			<div class="col-sm-12 row" id="searchResult">
          			</div>
          		</div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="row" style="margin-top: 15px">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Assets Value and Revenue</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                        <div class="row col-lg-9">
                           <div id="lineChart"></div>
                        </div>
                        <div class="row col-lg-3">
                            <ul class="stat-list" style="margin-top: 50px">
                                <li>
                                    <h2 class="no-margins"><?php echo e($sbu->pop_ttl); ?></h2>
                                    <small>Site Total</small>
                                    <!--
                                    <div class="stat-percent">90% <i class="fa fa-level-up text-navy"></i></div>
                                    <div class="progress progress-mini">
                                        <div style="width: 90%;" class="progress-bar"></div>
                                    </div>
                                    -->
                                </li>
                                <li>
                                    <h2 class="no-margins "><?php echo e($asset[0]->ttl); ?></h2>
                                    <small>Assets Total</small>
                                    <!--
                                    <div class="stat-percent">20% <i class="fa fa-level-down text-navy"></i></div>
                                    <div class="progress progress-mini">
                                        <div style="width: 20%;" class="progress-bar"></div>
                                    </div>
                                    -->
                                </li>
                                <li>
                                    <h2 class="no-margins "><?php if($rev > 0){  ;?>
                                    Rp.<?php echo number_format($rev,2,',','.') ;?>
                                        <?php }else{ ;?>
                                            <strong>No</strong>
                                        <?php };?></h2>
                                    <small>Revenue Total</small>
                                    <!--
                                    <div class="stat-percent">50% <i class="fa fa-bolt text-navy"></i></div>
                                    <div class="progress progress-mini">
                                        <div style="width: 50%;" class="progress-bar"></div>
                                    </div>
                                    -->
                                </li>
                                 <li>
                                    <h2 class="no-margins ">Rp.<?php echo e(number_format($asset[0]->investasi,2,',','.')); ?></h2>
                                    <small>Assets Value Total</small>
                                    <!--
                                    <div class="stat-percent">50% <i class="fa fa-bolt text-navy"></i></div>
                                    <div class="progress progress-mini">
                                        <div style="width: 50%;" class="progress-bar"></div>
                                    </div>
                                    -->
                                </li>
                                </ul>
                            </div>
                        </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<?php echo e(HTML::script('assets_back/js/plugins/chosen/chosen.jquery.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/c3/c3.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/d3/d3.min.js')); ?>


<script type="text/javascript">
    $(document).ready(function(){
        var categories = [ <?php echo $sbulist ;?> ];
        var chart = c3.generate({
            bindto: '#lineChart',
            data:{
                columns: [
                    ['assets_value', <?php echo($invsbu)?>],
                    ['revenue', <?php echo($revsbu)?>]
                ],
                colors:{
                    assets_value: 'rgba(26, 179, 148, 0.61)',
                    revenue: 'rgba(240, 90, 34, 0.65)'
                },
                type: 'bar',
                types: {
                    revenue: 'area'
                },
                groups: [
                    ['assets_value', 'revenue']
                ]
            },
            axis: {
                y : {
                    show: true,
                    tick: {
                        format: d3.format("Rp.")
                    }
                }
            },
            tooltip: {
                format: {
                    title: function (d) {return '' + categories[d]; },
                    value: d3.format(',') // apply this format to both y and y2
                }
            }
        });
    });
</script>
<script type="text/javascript" id="mapsDashboard">
    $('#searchData').hide();
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
    var infoWindow;
    var activeInfoWindow,
        base_url = window.location.origin+'/dashboard/mapdetail';
    function initMap() {
        var SBU = {lat: <?php echo e($sbus->lat); ?> , lng: <?php echo e($sbus->lon); ?>};
        var bounds = new google.maps.LatLngBounds();
        var mapOptions = {
            mapTypeId: 'roadmap'
        };
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 5,
          center: SBU
        });
        var markers = [
          <?php $__currentLoopData = $pops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            ['<?php echo e($d->name); ?>', <?php echo e($d->lat); ?>,<?php echo e($d->lon); ?>, '<?php echo e($d->desc); ?>' , 'pop',<?php echo e($d->id); ?>],
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ];
        var markers, i;
        for (i = 0; i < markers.length; i++) {
            var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
            bounds.extend(position);
            marker = new google.maps.Marker({
                position: position,
                map: map,
                lat: markers[i][1],
                long: markers[i][2],
                title: markers[i][0],
                desc: markers[i][3],
                id: markers[i][5]
            });
            google.maps.event.addListener(marker, 'click', (function(marker, i, infoWindow) {
                return function() {
                    var infoWindow = new google.maps.InfoWindow();
                    infoWindow.close(map);
                    //console.log('Klick! Marker=' + this.title);
                    var contentString = '<div id="siteNotice"  style="max-width: 300px  !important">'+
                    '</div>'+
                    '<h1 id="firstHeading" class="firstHeading">'+this.title+'</h1>'+
                    '<div id="bodyContent">'+
                    '<div class="col-sm-12"  style="max-width: 300px !important"><p>'+this.desc+'</p></div>'+
                    '</div>'+'<div class="col-sm-12"><p>Latitude : '+this.lat+' | Longitude : '+this.long+'</p></div></div>'+
                    '</div>'+
                    '</div>';
                    activeInfoWindow&&activeInfoWindow.close();
                    activeInfoWindow = infoWindow;
                    infoWindow.setContent(contentString);
                    infoWindow.open(map, this);
                    map.panTo(this.getPosition());
                    detail('pop', this.id);
                    map.setZoom(14);
                  }
            })(markers, i, infoWindow));
        }
    }
</script>
<script type="text/javascript" id="detailMaps">
    $('#searchData').hide();
    $('#maps').hide();
    $(document).ready(function(){
    	$('.chosen-select').change(function() {
			if ($(this).find(':selected').val() != '') {
				var rid = '', dlat = '',dlon = '',dsub = '',dtitle = '',daddress = '',
					rid = $(this).find(':selected').val(),
					dlat = $(this).find(':selected').data('lat'),
					dlon = $(this).find(':selected').data('long'),
					dsub = $(this).find(':selected').data('sub'),
					dtitle = $(this).find(':selected').data('title'),
					address = $(this).find(':selected').data('address');
				searchResult(rid, dlat, dlon, dsub, dtitle, address);
				//console.log(rid+','+dlat+','+dlon+','+dtitle+','+address);
			}else{
				$('#pop_id').value('');
			}
		});
		function searchResult(ids, lt, ln, sub, ttl, addr){
			var ids = ids,
				lt = lt,
				ln = ln,
				sub = sub,
				ttl = ttl,
				addr = addr,
				url =  base_url + '?data=pop&data_id=' + ids,
	            csrf = $('meta[name="csrf-token"]').attr('content');
			//$('.search').click(function() {
	            $.ajax({
	              url : url,
	              type: "GET",
	              dataType: 'html',
	              data: {_token: csrf},
	              success: function(html){
						$('#searchData').show();
						$('#searchResult').empty();

                    	detail('pop', ids);

                    	$('#map').hide();
                        $('#maps').show();
                        $('#searchResult').append('<h1>Site '+ ttl +'</h1><h3>Located at '+ addr +'</h3><p>Latitude : '+ lt +'</p><p>Longitude : '+ ln +'</p>').show('slow');
                    	var infoWindow,
                    		activeInfoWindow;
                    	init();
                    	function init() {
                    		var poi = '', maps = '',marker ='',
                    			poi = {lat: parseFloat(lt) , lng: parseFloat(ln)},
                                marker = '';

					        var maps = new google.maps.Map(document.getElementById('maps'), {
					          zoom: 17,
					          center: poi
					        });

                            var contentString = '<div id="content">'+
                                '<div id="siteNotice">'+
                                '</div>'+
                                '<h1 id="firstHeading" class="firstHeading">'+ttl+'</h1>'+
                                '<div id="bodyContent">'+
                                '<p><b>Located at</b>: '+addr+'</p>'+
                                '<p>Latitude : '+lt+'</p>'+
                                '<p>Longitude : '+ln+'</p>'+
                                '</div>'+
                                '</div>';

                            var infowindow = new google.maps.InfoWindow({
                              content: contentString
                            });

					        var marker = new google.maps.Marker({
					          position: poi,
					          map: maps,
					          title: 'Site '+ttl+','+parseFloat(lt)+','+parseFloat(ln)
					        });
                            marker.addListener('click', function() {
                              infowindow.open(maps, marker);
                            });
                    	}
					}
				});
			//});
		};
	});
	function detail(sbu, data_id){

        var url =  base_url + '?data='+sbu+'&data_id=' + data_id,
            csrf = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
	      url : url,
	      type: "GET",
	      dataType: 'html',
	      data: {_token: csrf},
	      success: function(html){
	        var sData =  $.parseJSON(html),
	          assetsData = sData[0];
	        $('#assetsTtl').empty();
	        $('#investTtl').empty();
	        $('#revenueTtl').empty();
	        $('#orderTtl').empty();
            $('.popData').hide();
	        $('#revenueInfo').empty();
	        $('#revenueData').empty();
	        $('#investInfo').empty();
	        $('#investData').empty();
	        $('#orderInfo').empty();
	        $('#orderData').empty();
	        $('#assetsTot').empty();
	        $('#assetsInfo').empty();
            $('#percentPort').empty();
            $('#percentInfo').empty();
	       var usedPort = assetsData['usedPort'],
                allPort = assetsData['allPort'];
            console.log(usedPort+','+allPort);
            if(usedPort == null){
                if(allPort == null){
                    $('#percentPort').append('<strong>No Data</strong>').show('slow');
                    $('#percentInfo').append('<strong>No Data</strong>').show('slow');
                }else{
                    $('#percentPort').append('0%').show('slow');
                    $('#percentInfo').append('0 port used from '+allPort+' port available').show('slow');
                }
            }else{
                if(allPort == null){
                    $('#percentPort').append('<strong>No Data</strong>').show('slow');
                    $('#percentInfo').append('<strong>No Data</strong>').show('slow');
                }else{
                    var percent = (usedPort/allPort)*100;
                    $('#percentPort').append( parseFloat(percent).toFixed(2)+'%').show('slow');
                    $('#percentInfo').append(usedPort+' port used from '+allPort+' port ').show('slow');
                }
            }
	        if ( assetsData["asset_ttl"] == 0 ){
	             $('#assetsTot').append('<strong>No Data</strong>').show('slow');
	             $('#assetsTtl').append('Assets').show('slow');
	              $('#assetsInfo').append('<strong>'+ assetsData["name"] +'</strong>').show('slow');
	        } else {
	            $('#assetsTot').append(''+ assetsData["asset_ttl"] +'').show('slow');
	            $('#assetsTtl').append('Assets').show('slow');
	            $('#assetsInfo').append('Total Assets in <strong>'+ assetsData["name"] +'</strong>').show('slow');
	        }
	        if ( assetsData["revenue"] == null ){
	           $('#revenueInfo').append('<strong>No Data</strong>').show('slow');
	           $('#revenueTtl').append('Revenue').show('slow');
	           $('#revenueData').append('<strong>No SID Data</strong> in '+ assetsData["name"]).show('slow');
	        } else {
	          var moneys = assetsData["revenue"],
	              fixs = moneys.toLocaleString(),
                  rev = fixs.replace(/,/g, '.'),
	              revenue = moneys.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ',00';
	              $('#revenueInfo').append('Rp.' + revenue).show('slow');
	           	  $('#revenueTtl').append('Revenue').show('slow');
	              $('#revenueData').append('From <strong>'+ assetsData["cust_ttl"] + '</strong> SID in '+ assetsData["name"]).show('slow');
	        }

	        if ( assetsData["investasi"] == null ){
	           $('#investInfo').append('<strong>No Data</strong>').show('slow');
	           $('#investTtl').append('Investation').show('slow');
	           $('#investData').append(assetsData["name"]).show('slow');
	        } else {
	          var money = assetsData["investasi"],
	              fix = money.toLocaleString(),
                  invest = money.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ',00';
	          $('#investInfo').append('Rp.' + invest).show('slow');
	           $('#investTtl').append('Investation').show('slow');
	          $('#investData').append('On <strong>'+ assetsData["assetnull"] + '</strong> from <strong>'+ assetsData["asset_ttl"] +' </strong>assets').show('slow');
	        }
	        if ( assetsData["wo_ttl"] == null ){
	           $('#orderInfo').append('<strong>No Data</strong>').show('slow');
	           $('#orderTtl').append('Work Order').show('slow');
	           $('#orderData').append('in '+ assetsData["name"]).show('slow');
	        } else {
	          var percent = assetsData['pop_fin'] / assetsData["pop_ttl"];
	          if(percent > 0){
	            $('#orderInfo').append(percent*100 +'%').show('slow');
	            $('#orderTtl').append('Work Order').show('slow');
	          }else{
                $('#orderTtl').append('Work Order').show('slow');
	            $('#orderInfo').append('<strong>0% Completed</strong>').show('slow');
	          }

	          $('#orderData').append('From <strong>'+ assetsData["wo_ttl"] + '</strong> work order ').show('slow');
	        }
	        //alert(assetsData["asset_ttl"]);
	      },
	      error: function(jqXHR){ console.log(jqXHR.responseText); }
	    });
	}
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYxcj9zQErZ6KkleQahg_vuY2cRg5yfEU&callback=initMap">
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.appdashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>