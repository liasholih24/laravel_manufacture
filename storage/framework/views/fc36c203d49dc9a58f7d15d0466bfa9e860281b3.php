<?php $__env->startSection('title'); ?>
Report
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Asset Report
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
  <?php echo e(HTML::style('assets_back/css/plugins/chosen/chosen.css')); ?>

  <?php echo e(HTML::style('assets_back/css/plugins/c3/c3.min.css')); ?>

  <?php echo e(HTML::style('assets_back/css/plugins/datapicker/datepicker3.css')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="wrapper wrapper-content">
  <div class="row detail_content3">
    <div class="col-lg-12 detail_content2" style="background-color: white">
      <div class="row ibox-title">
        <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
          <li class="active" onClick="window.location.reload()">Asset Report</li>
        </ol>
        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-sm btn-outline btn-warning pull-right">
          <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
        </a>
      </div>
      <div class="row ibox-content" style="min-height: 65vh; ">
        <div class="row col-xs-12 col-sm-12">
          <div class="form-horizontal" id="searchBox">
            <input type="hidden" name="" id="dataPops" value="0">
            <div class="form-group">
              <label class="col-sm-1 col-xs-4 control-label" style="text-align: left !important; "><?php if($sbu == 0){ echo "SBU" ;}else{ echo "POP" ;} ;?></label>
              <div class="col-sm-<?php if($sbu == 0){ echo '3';}else{ echo '11' ;};?> col-xs-8"  >
                <div class="input-group col-sm-12 col-xs-12" >
                  <select class="chosen-select form-control m-b <?php if($sbu > 0){ echo 'popData';}else{ echo 'sbuData';}?>" id="<?php if($sbu == 0){ echo 'sbu_id' ;}else{ echo 'pop_id' ;} ;?>" <?php if($sbu > 0){ echo 'multiple="true"';}?> data-placeholder="Select <?php if($sbu == 0){ echo "SBU" ;}else{ echo "POP" ;} ;?>...">
                      <option value="0">All <?php if($sbu == 0){ echo "SBU" ;}else{ echo "POP" ;} ;?></option>
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
          <div class="col-sm-12" id="resultBox">

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

<?php echo e(HTML::script('assets_back/js/plugins/datapicker/bootstrap-datepicker.js')); ?>

<script type="text/javascript">
    $('#resultBox').hide();
    $('#searchButton').hide();
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
                      optionsHTML.push("<option value=\"0\">All POP</option>");
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
            month   = $('#month').val(),
            param   = sbu+';'+pop+';'+type+';'+filter+';'+month;
            url   =  window.location.origin+'/reportasset/searchReport' + '?key=' + param,
            csrf  = $('meta[name="csrf-token"]').attr('content');

            <?php if($sbu > 0){ ;?>
              sbu = <?php echo $sbu ;?>;
            <?php };?>
            console.log(pop);
             $.ajax({
                url : url,
                type: "GET",
                dataType: 'html',
                data: {_token: csrf},
                success: function(datas){
                  if(datas == 'yes'){
                    var param =  sbu+';'+pop+';'+type+';'+filter+';'+month;
                    var nurl =  window.location.origin+'/reportasset/searchResult' + '?key=' + param;
                    //window.open(nurl, "_blank");
                    window.location.assign(nurl);
                  }else{
                    //alert(datas);
                    $('#resultBox').html('<div class="col-sm-12 col-xs-12 jumbotron" style="background-color: #fff"><h2>No data found with your<strong> search parameters</strong>. Please check your search parameter again. Thank you... </h2><button onClick="showSearch()" class="btn-lg btn btn-primary"><i class="fa fa-search-plus" style="margin-right: 10px"></i>  Search</button></div>')
                    $('#resultBox').show();
                    $('#searchBox').hide();
                    $('#searchButton').hide();
                    return false;
                  }
                }
            });
      }
      function showSearch(){
          $('#resultBox').hide();
          $('#searchButton').slideUp('slow');
          $('#resultBox').empty();
          $('#searchBox').show();
      }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>