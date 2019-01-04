<?php $__env->startSection('title'); ?>
Report	 Result
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
  <?php echo e(HTML::style('assets_back/css/plugins/dataTables/dataTables.bootstrap.css')); ?>

  <?php echo e(HTML::style('assets_back/css/plugins/chosen/chosen.css')); ?>

  <?php echo e(HTML::style('assets_back/css/plugins/datapicker/datepicker3.css')); ?>

  <?php echo e(HTML::style('assets_back/css/plugins/dataTables/dataTables.tableTools.min.css')); ?>

  <?php echo e(HTML::style('assets_back/css/plugins/c3/c3.min.css')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="wrapper wrapper-content">
    <div class="row detail_content3">
	    <div class=" col-lg-12">
			<div class="ibox float-e-margins">
			    <div class="ibox-title" style="height: 54px">
			       <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
			          <li href="<?php echo e(url()->previous()); ?>">Asset Report</li>
			          <li class="active" onClick="window.location.reload()">Report Result</li>
			        </ol>
			        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-sm btn-outline btn-warning pull-right">
			          <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
			        </a>
			        <button class="btn btn-sm btn-primary pull-right" id="searchButton" onClick="showSearch()" style="margin-right: 10px">
			          <i class="fa fa-search-plus" style="margin-right: 10px"></i> Search
			        </button>
			    </div>
			    <?php if($data != 'no'){;?>
		    		<div class="row" style="margin-top: 20px;" id="advBox">
		    			<div class="col-lg-4">
				            <div class="col-sm-12">
				                <div class="ibox">
				                    <div class="ibox-title  row" style="background-color: rgba(0, 192, 243, 0.45) !important; color: #fff">
				                        <div class="col-sm-2">
				                            <i class="fa fa-shield fa-2x"></i>
				                        </div>
				                        <div class="col-sm-10 pull-right">
				                            <h2 class="font-bold no-margins" id="investTtl">
				                                Asset Value

				                            </h2>
				                        </div>
				                    </div>
				                    <div class="ibox-content row"  style="min-height: 135px !important">
				                        <div class="row col-sm-12">
				                             <h1 class="m-xs text-center font-bold" id="investInfo" style="color: rgba(240, 90, 34, 0.65) !important">Rp.<?php echo e(number_format($inv,2,',','.')); ?></h1>
				                        </div>
				                        <div class="row col-sm-12 " style="padding-top: 10px">
				                             <h4 id="investData" style="text-align: center">From <?php echo e(count($data)); ?> Assets</h4>
				                        </div>
				                    </div>
				                </div>
				            </div>
				        </div>
				        <div class="col-lg-4">
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
				                                <?php if($revData > 0){  ;?>
				                                    Rp.<?php echo number_format($revData,2,',','.') ;?>
				                                <?php }else{ ;?>
				                                    <strong>No</strong>
				                                <?php };?>
				                             </h1>
				                        </div>
				                        <div class="row col-sm-12"  style="padding-top: 10px">
				                             <h4 id="revenueData" style="text-align: center">From <?php echo count($sids) ;?> SID</h4>
				                        </div>
				                    </div>
				                </div>
				            </div>
				        </div>
				        <div class="col-lg-4">
				            <div class="col-sm-12">
				                <div class="ibox">
				                    <div class="ibox-title  row " style="background-color: rgba(26, 179, 148, 0.61); color: #fff">
				                        <div class="col-sm-2">
				                            <i class="fa fa-dashboard fa-2x"></i>
				                        </div>
				                        <div class="col-sm-10 pull-right">
				                            <h2 class="font-bold no-margins" >
				                                Port Usage
				                            </h2>
				                        </div>
				                    </div>
				                    <div class="ibox-content row"  style="min-height: 135px !important">
				                       <div class="col-sm-12 text-center">
				                             <h1 class="m-xs text-center font-bold"  style="font-size: 18px" id="percentPort"><?php if($allPort > 0){ $percent = ($usedPort/$allPort)*100; echo number_format($percent,2,',','.') ;}else{ echo '0';};?>%</h1>
				                        </div>
				                        <div class="col-sm-12" style="padding-top: 10px">
				                             <h3  style="text-align: center;"  id="percentInfo">

				                             	<?php if($allPort> 0){ echo $usedPort.' port used, '.$brokenPort.'  port broken from total '.$allPort.' port' ;}else{ echo 'No data Available' ;};?>
				                             </h3>
				                        </div>
				                    </div>
				                </div>
				            </div>
				        </div>
		    		</div>
		    		<div class="ibox" id="graphBox">
		    			<div class="ibox-title">
	                        <h5>Asset Value and Revenue</h5>
	                    </div>
	                    <div class="ibox-content" >
	                        <div class="row">
		                        <div class="row col-lg-12">
		                           <div id="lineChart"></div>
		                        </div>
				    		</div>
				    	</div>
				    </div>
		    	<?php };?>
			    <div class="ibox-content" style="min-height: 65vh;" id="resultBox">
			    	<div class="table-responsive">
						<table class="table table-responsive table-striped table-bordered table-hover dataTables-example dataTable" id="searchResult">
							<thead>
							    <tr>
							        <th>No.</th>
							        <th>QR Code</th>
							        <th>Name</th>
							        <th>Asset Value</th>
							        <th>SBU</th>
							        <th>Site</th>
							        <th>Brand</th>
							        <th>Model</th>
							        <th>Asset Category</th>
							        <th>Last Update</th>
							        <th>Updated By</th>
							        <th>Status</th>
							    </tr>
							</thead>
							<tbody>
								<?php if($data != 'no'){ ;?>
								<?php $i = 1; foreach($data as $d){ ;?>
									<tr>
								        <td><?php echo $i ;?></td>
								        <td><?php if($d->qr_code){ echo $d->qr_code ;}else{ echo '<p style="color: red">QR Not Set</p>' ;} ;?></td>
								        <td><?php echo $d->name ;?></td>
								        <td><?php if($d->investasi){ echo number_format($d->investasi,2,',','.') ;}else{ echo '0' ;} ;?></td>
								        <td><?php echo $d->sbu ;?></td>
								        <td><?php echo $d->pop ;?></td>
								        <td><?php echo $d->brand ;?></td>
								        <td><?php echo $d->model ;?></td>
								        <td><?php echo $d->cat ;?></td>
								        <td><?php echo $d->updated_at ;?></td>
								        <td><?php echo $d->usr ;?></td>
								        <td><?php if($d->status == 3){ echo 'Active';}else{ echo 'Inactive' ;} ;?></td>
									</tr>
									<?php $i++ ;} ;?>
								<?php }else{ ;?>
									<tr>
										<td colspan="11" style="text-align: center">No data</td>
									</tr>
								<?php };?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="ibox-content" id="searchBox" style="background-color: white; min-height: 65vh">
			        <div class="row col-xs-12 col-sm-12">
			          <div class="form-horizontal" >
			            <input type="hidden" name="" id="dataPops" value="0">
			            <div class="form-group">
			              <label class="col-sm-1 col-xs-4 control-label" style="text-align: left !important; "><?php if($sbu == 0){ echo "SBU" ;}else{ echo "Site" ;} ;?></label>
			              <div class="col-sm-<?php if($sbu == 0){ echo '3';}else{ echo '11' ;};?> col-xs-8"  >
			                <div class="input-group col-sm-12 col-xs-12" >
			                  <select class="chosen-select form-control m-b <?php if($sbu > 0){ echo 'popData';}else{ echo 'sbuData';}?>" id="sbu_id" <?php if($sbu > 0){ echo 'multiple="true"';}?> data-placeholder="Select <?php if($sbu == 0){ echo "SBU" ;}else{ echo "Site" ;} ;?>...">
			                      <option value="0">All <?php if($sbu == 0){ echo "SBU" ;}else{ echo "Site" ;} ;?></option>
			                    <?php $__currentLoopData = $sbuList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			                      <option value="<?php echo e($d->id); ?>"><?php echo e($d->name); ?> <?php if($sbu > 0){ ;?>( <?php echo e($d->code); ?> )<?php };?></option>
			                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			                  </select>
			                </div>
			              </div>
			              <?php if($sbu == 0){ ;?>
			                <label class="col-sm-1 col-xs-4 control-label" style="text-align: left !important; ">Filter By</label>
			                <div class="col-sm-3 col-xs-8"  >
			                  <div class="input-group col-sm-12 col-xs-12" >
			                    <select class="chosen-select form-control m-b" id="type" data-placeholder="Select filter type...">
                      				<option value="1">Select filter type</option>
				                    <option value="1">Brand</option>
				                    <option value="2">Model</option>
				                    <option value="3">Categories</option>
				                    <option value="4">Customer</option>
				                    <option value="5">Installation Year</option>
			                    </select>
			                  </div>
			                </div>
			                <label class="col-sm-1 col-xs-4 control-label" style="text-align: left !important;" id="valueTitle" data-placeholder="Select...">Value</label>
			                <div class="col-sm-3 col-xs-8"  >
			                  <div class="input-group col-sm-12 col-xs-12" >
			                    <select class="chosen-select form-control m-b chosen-update filterData" id="filter">
			                    </select>
			                  </div>
			                </div>
			              <?php };?>
			            </div>
			            <?php if($sbu > 0){ ;?>
			              <div class="form-group">
			                <label class="col-sm-1 col-xs-4 control-label" style="text-align: left !important; ">Filter By</label>
			                  <div class="col-sm-3 col-xs-8"  >
			                    <div class="input-group col-sm-12 col-xs-12" >
			                      <select class="chosen-select form-control m-b" id="type" data-placeholder="Select filter type...">
                      					<option value="1">Select filter type</option>
			                        	<option value="1">Brand</option>
			                        	<option value="2">Model</option>
			                        	<option value="3">Asset Categories</option>
			                        	<option value="4">Customer</option>
			                        	<option value="5">Installation Year</option>
			                      </select>
			                    </div>
			                  </div>
			                  <label class="col-sm-1 col-xs-4 control-label" style="text-align: left !important;" id="valueTitle" data-placeholder="Select...">Value</label>
			                  <div class="col-sm-3 col-xs-8"  >
			                    <div class="input-group col-sm-12 col-xs-12" >
			                      <select class="chosen-select form-control m-b chosen-update filterData" id="filter">
			                      </select>
			                    </div>
			                  </div>
			                  <label class="control-label col-sm-1 col-xs-4" style="text-align: left !important;">Month</label>
			                  <div class="col-sm-3 col-xs-8" >
			                    <div class="input-group month input-group col-sm-12 col-xs-12" >
			                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			                      <input id="month" date-format="mm/yyyy" type="text" class="form-control" value="<?php echo date('m/Y');?>">
			                    </div>
			                  </div>
			              </div>
			            <?php }elseif($sbu == 0){ ;?>
			              <div class="form-group">
			                <label class="col-sm-1 col-xs-4 control-label" style="text-align: left !important; ">Site</label>
			                <div class="col-sm-7 col-xs-8"  >
			                  <div class="input-group col-sm-12 col-xs-12" >
			                    <select class="chosen-select chosen-update form-control m-b popData" id="pop_id" data-placeholder="Select Site..." multiple="">
			                    </select>
			                  </div>
			                </div>
			                <label class="control-label col-sm-1 col-xs-4" style="text-align: left !important;">Month</label>
			                <div class="col-sm-3 col-xs-8" >
			                  <div class="input-group month input-group col-sm-12 col-xs-12" >
			                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			                    <input id="month" date-format="mm/yyyy" type="text" class="form-control" value="<?php echo date('m/Y');?>">
			                  </div>
			                </div>
			              </div>
			            <?php };?>
			            <div class="form-group pull-right" >
			                <button onClick="filter()" class=" btn btn-primary btn-md pull-right" style="margin-right: 15px"><i class="fa fa-search-plus" style="margin-right: 10px"></i>  Filter</button>
			                <button onClick="window.location.reload()" class="btn-md btn btn-success pull-right" style="margin-right: 10px"><i class="fa fa-refresh" style="margin-right: 10px"></i>  Refresh</button>
			            </div>
			          </div>

			        </div>
			    </div>
			    <div class="ibox-content" id="noResultBox">
		        <div class="row jumbotron" style="background-color: #fff; min-height: 65vh">
		            <h2>No data found with your<strong> search parameters</strong>. Please check your search parameter again. Thank you... </h2>
		            <button onClick="showSearch()" class="btn-lg btn btn-primary"><i class="fa fa-search-plus" style="margin-right: 10px"></i>  Search</button>
		        </div>
			</div>
		</div>
      </div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php echo e(HTML::script('assets_back/js/plugins/dataTables/datatables.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/dataTables/dataTables.tableTools.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/datapicker/bootstrap-datepicker.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/chosen/chosen.jquery.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/c3/c3.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/d3/d3.min.js')); ?>

<script type="text/javascript">



    $(document).ready(function(){
      	var config = {
	        '.chosen-select'           : {},
	        '.chosen-select-deselect'  : {allow_single_deselect:true},
	        '.chosen-select-no-single' : {disable_search_threshold:10},
	        '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
	        '.chosen-select-width'     : {width:"95%"},
	        '.chosen-select-case_sensitive_search' : false
	        }
      	for (var selector in config) {
          	$(selector).chosen(config[selector]);
      	}

      	<?php if($data != 'no'){ ;?>
			var categories = [ <?php echo $popList ;?> ];
	        var chart = c3.generate({
	            bindto: '#lineChart',
	            data:{
	                columns: [
	                    ['asset_value', <?php echo($invList)?>],
	                    ['revenue', <?php echo($revList)?>]
	                ],
	                colors:{
	                    asset_value: 'rgba(26, 179, 148, 0.61)',
	                    revenue: 'rgba(240, 90, 34, 0.65)'
	                },
	                type: 'bar',
	                types: {
	                    revenue: 'area'
	                },
	                groups: [
	                    ['asset_value', 'revenue']
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
		<?php };?>
		$('#searchBox').hide();
		$('#noResultBox').hide();
		    var monthDate = new Date();
		    var yearDate = new Date();
		    $('#month').datepicker({
		        autoclose: true,
		        endDate: '+0m',
		        minViewMode: 1,
		        format: 'mm/yyyy'
		    }).on('changeDate', function(selected){
		        monthDate = new Date(selected.date.valueOf());
		        monthDate.setDate(monthDate.getDate(new Date(selected.date.valueOf())));
		        var month = $('#month').val();
		    });
	    <?php if($sbu == 0){ ;?>
	        $('#sbu_id.chosen-select').change(function() {
	          if ($(this).find(':selected').val() != '') {
	            $('.popData').empty();
	            $('.dataPops').val('');
	            var id  = '',
	                id = $(this).find(':selected').val(),
	                url =  window.location.origin+'/reportasset/pop' + '?data_id=' + id,
	                csrf = $('meta[name="csrf-token"]').attr('content');
	            $.ajax({
	              url : url,
	              type: "GET",
	              dataType: 'html',
	              data: {_token: csrf},
	              success: function(datas){

	                var datas = JSON.parse(datas),
	                    optionsHTML = [];
	                for (i = 0; i < datas.length; ++i) {
	                  if(i == 0){
	                      optionsHTML.push("<option value=\"0\">All Site</option>");
	                  }
	                  optionsHTML.push("<option value=\"" + datas[i].id + "\">" + datas[i].name + " ( " + datas[i].code  + "  )</option>");
	                }
	                var optionData = optionsHTML.join('\n');
	                $('.popData').attr( 'multiple', 'true' );
	                $('.popData').html(optionData);
	                $(".popData.chosen-update").trigger("chosen:updated");
	                return false;
	                //console.log(datas);
	              }
	            });
	          }
	        });
	    <?php };?>

      	$('.popData.chosen-select').change(function() {
          var values = $(".popData.chosen-select").chosen().val();
          	$('#dataPops').val('');
          	$('#dataPops').val(values);
          	if(values == null){
            	$('#dataPops').val('0');
          	}
      	});

      	$('#type.chosen-select').change(function() {
          if ($(this).find(':selected').val() != '') {
            $('.filterData').empty();
            var id    = '',
                id    = $(this).find(':selected').val(),
                url   =  window.location.origin+'/reportasset/filterType' + '?data_id=' + id,
                csrf  = $('meta[name="csrf-token"]').attr('content');
            if (id == 1){
              $('#valueTitle').html("Brand");
            } else if(id == 2){
              $('#valueTitle').html("Model");
            } else if(id == 3){
              $('#valueTitle').html("Asset Categories");
            } else if(id == 4){
              $('#valueTitle').html("Customer");
            } else {
              $('#valueTitle').html("Year");
            }
            if(id < 5){
              $.ajax({
                url : url,
                type: "GET",
                dataType: 'html',
                data: {_token: csrf},
                success: function(datas){

                  var datas = JSON.parse(datas),
                      optionsHTML = [];
                  if(id == 3){
                    for (i = 0; i < datas.length; ++i) {
                      optionsHTML.push("<option value=\"" + datas[i].id + "\">" + datas[i].name + "( "+ datas[i].code +" )</option>");
                    }
                  } else if(id == 2){
                    for (i = 0; i < datas.length; ++i) {
                      optionsHTML.push("<option value=\"" + datas[i].id + "\">" + datas[i].name + "( "+ datas[i].material +" )</option>");
                    }
                  }else{
                    for (i = 0; i < datas.length; ++i) {
                      optionsHTML.push("<option value=\"" + datas[i].id + "\">" + datas[i].name + "</option>");
                    }
                  }

                  var optionData = optionsHTML.join('\n');
                  $('.filterData').html(optionData);
                  $(".filterData.chosen-update").trigger("chosen:updated");
                  //console.log(datas);
                }
              });
            }else{
              var optionsHTML = [];
              for (i = <?php echo date('Y')?>; i >= 2007 ; i--) {
                var year = <?php echo date('Y')?>;
                if(i == year){
                  optionsHTML.push("<option value=\"no\">All Year</option>");
                }
                optionsHTML.push("<option value=\"" + i + "\">" + i + "</option>");
              }
              var optionData = optionsHTML.join('\n');
              $('.filterData').html(optionData);
              $(".filterData.chosen-update").trigger("chosen:updated");
            }

          }else{
              $('#valueTitle').html("Value");}
        });
    });
    function filter(){
        var pop     = '',
            sbu     = '',
            type    = '',
            month   = '',
            filter  = '',
            pop     = $('#dataPops').val(),
            sbu     = $(".sbuData.chosen-select").chosen().val(),
            filter  = $("#filter.chosen-select").chosen().val(),
            type  = $("#type.chosen-select").chosen().val(),
            month   = $('#month').val();

            <?php if($sbu > 0){ ;?>
              sbu = <?php echo $sbu ;?>;
            <?php };?>
            var param   = sbu+';'+pop+';'+type+';'+filter+';'+month;
            url   =  window.location.origin+'/reportasset/searchReport' + '?key=' + param,
            csrf  = $('meta[name="csrf-token"]').attr('content');
            console.log(param);
             $.ajax({
                url : url,
                type: "GET",
                dataType: 'html',
                data: {_token: csrf},
                success: function(datas){
                  if(datas != 'no'){
                    if(pop == ''){
                      pop = 0;
                    }else if(sbu == ''){
                      sbu = 0;
                    }

		            <?php if($sbu > 0){ ;?>
		              sbu = <?php echo $sbu ;?>;
		            <?php };?>
                    var param =  sbu+';'+pop+';'+type+';'+filter+';'+month;
                    var nurl =  window.location.origin+'/reportasset/searchResult' + '?key=' + param;
                    window.location.assign(nurl);
                  }else{
                    //alert(datas);
                    $('#searchBox').hide();
                    $('#noResultBox').show();
                    return false;
                  }
                }
            });
      }
	function showSearch(){
	      $('#resultBox').hide();
	      $('#noResultBox').hide();
	      $('#advBox').hide();
	      $('#graphBox').hide();
	      $('#searchBox').show();
	}
	    $(document).ready(function(){

	      var base_url = window.location.origin?window.location.origin+'/':window.location.protocol+'/'+window.location.host+'/';
	      $('#searchResult').dataTable({
	        responsive: true,
	        "dom": 'T<"clear">lfrtip',
	        "lengthMenu": [[10, 25, 50, 100, 250, 500], [10, 25, 50, 100, 250, 500, "All"]],
	        "tableTools": {
	          "sSwfPath": base_url+"assets_back/js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
	        },
	      destroy: true,
	    });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>