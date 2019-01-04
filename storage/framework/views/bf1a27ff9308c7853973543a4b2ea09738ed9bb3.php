<?php $__env->startSection('title'); ?>
Asset List
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Manage Asset List
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php echo e(HTML::style('assets_back/css/plugins/select2/select2.min.css')); ?>

<?php echo e(HTML::style('assets_back/css/plugins/dataTables/datatables.min.css')); ?>

<?php echo e(HTML::style('assets_back/css/plugins/chosen/chosen.css')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="wrapper wrapper-content">
    <div class="row detail_content3">
    <div class="col-lg-3 detail_content">
<div class="ibox float-e-margins">
    <div class="ibox-title row" style="height: 54px">
        <h5>Asset List</h5>
    </div>
    <div class="ibox-content row" style="min-height: 65vh;">
		<div class="file-manager">
			<div class="dd" id="nestable2">
				<ol class="dd-list">
					<li class="dd-item ">
						<div class="dd-handle dd-nodrag" style="margin-left: auto; margin-right: auto">
							<a href="<?php echo e(url('asset')); ?>">
							<span class="label label-info"></span> <strong>View All</strong>
							</a>
							<p class="pull-right"></p>
						</div>
					</li>
				</ol>
			</div>
			<div class="" style="margin: 30px 0">

					<div class="form-group ">
	                   <label class="col-sm-2 col-xs-12 control-label" style="margin-right: 20px">SBU</label>
                       <div class="input-group col-sm-9 col-xs-12 ">

                         <select name="sbu_id" class="form-control chosen-select SBUSelect chosen-update" data-placeholder="Select SBU" id="sbu_id" onchange="if (this.value) window.location.href=this.value" width="100%">
                           <?php if($sbu_name != ""): ?>
                           <option value="#" ><?php echo e($sbu_name); ?></option>
                           <?php endif; ?>
                             <option value="<?php echo e(url('asset')); ?>">Select SBU</option>
                             <?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <option value="<?php echo e(url('asset/' . $filter->id . '/filter')); ?>" <?php if ($filter->id == $id) echo ' selected="selected"'; ?>>
                               <?php echo e($filter->name); ?>

                             </option>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         </select>
                        </div>
	                </div>
	                <div class="form-group ">
	                   <label class="col-sm-2 col-xs-12 control-label" style="margin-right: 20px">POP</label>
                       <div class="input-group col-sm-9 col-xs-12 ">
                         <select name="pop_id" class="form-control chosen-select POPSelect chosen-update" data-placeholder="Select POP" onchange="if (this.value) window.location.href=this.value" id="pop_id" width="100%">
                             <option value="<?php echo e(url('asset')); ?>">Select Site</option>
                             <?php $__currentLoopData = $filters2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <option value="<?php echo e(url('asset/' . $filter->parent_id . '/' . $filter->id . '/filter2')); ?>" <?php if ($filter->id == $id) echo ' selected="selected"'; ?>>
                               <?php echo e($filter->name); ?>  ( <?php echo e($filter->code); ?>)
                             </option>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         </select>
                        </div>
	                </div>
					<!--<div class="form-group">
						<div class="col-sm-12  pull-right">
							<button id="all" class="searchButton search btn btn-outline btn-primary pull-right" style="margin-right: -15px"><i class="fa fa-search"></i>  Search</button>
						</div>
					</div>-->
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
              <a class="detail2" href="">
                  Asset List
              </a>
          </li>
        </ol>
          <a href="<?php echo e(url('dashboard')); ?>" class="btn btn-sm btn-outline btn-warning pull-right">
              <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
          </a>
          <?php if(Sentinel::getUser()->hasAccess(['asset.create'])): ?>
          <a href="<?php echo e(url('asset/create')); ?>">
          <button class="detail2 btn btn-sm btn-outline btn-primary pull-right" style="margin-right: 10px">
              <i class="fa fa-plus-circle" style="margin-right: 5px"></i>
                  Add Asset
          </button>
          </a>
          <?php endif; ?>
    </div>
  <div class="col-xs-12 col-sm-12 ibox-content row" style="min-height:65vh;">
    <?php $__currentLoopData = ['danger', 'warning', 'success', 'info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(Session::has('alert-' . $msg)): ?>
        <div class="alert alert-<?php echo e($msg); ?> alert-dismissable">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          <?php echo e(Session::get('alert-' . $msg)); ?>.
        </div>
        <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div class="table-responsive">
<table class="table table-responsive table-striped table-bordered table-hover dataTables-example dataTable" id="asset_table">
<thead>
    <tr>
        <th>No.</th>
        <th>QR Code</th>
        <th>Material</th>
        <th>Brand</th>
        <th>Model</th>
        <th>Category</th>
        <th>Serial No</th>
        <th>SBU</th>
        <th>Site</th>
        <th>Last Update</th>
        <th>Updated By</th>
        <th>Status</th>
        <th>Action</th>
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php echo e(HTML::script('assets_back/js/plugins/dataTables/datatables.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/select2/select2.full.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/chosen/chosen.jquery.js')); ?>


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

      // fungsi pilih sbu
      $('#sbu').on('change', function(e){
      		 console.log(e);
      		 var sbu_id = e.target.value;

      		 $.get('/pop?sbu_id=' + sbu_id, function(data){  // Ganti bagian ini......

      			 $('#pop').empty();
      			  $('#pop').append('<option value="0">Select POP</option>');
      			 $.each(data, function(index, subcatObj){
      				 $('#pop').append('<option value="'+subcatObj.id+'">'+subcatObj.name+'</option>');

      			 });
      		 });
      	 });

        /* Init DataTables */
      //  var oTable = $('#editable').DataTable();

    /*    $('.dataTable').DataTable( {
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
        order: [ 1, 'asc' ]
    } );
*/

    });
    $('#asset_table').DataTable({
       processing: true,
       serverSide: true,
       ajax: '/assetapi?data=<?=$data?>&sbu=<?=$sbu?>&pop=<?=$pop?>',
       columns: [
           {data: 'rownum', name: 'rownum'},
           {data: 'qr_code', name: 'qr_code'},
           {data: 'material_no', name: 'material_no'},
           {data: 'brand', name: 'brand'},
           {data: 'model', name: 'model'},
           {data: 'category', name: 'category'},
           {data: 'serial_no', name: 'serial_no'},
           {data: 'sbu', name: 'sbu'},
           {data: 'pop', name: 'pop'},
           {data: 'updated_at', name: 'updated_at'},
           {data: 'username', name: 'username'},
           {data: 'sts', name: 'sts'},
           {data: 'action', name: 'action', orderable: false, searchable: false}
       ],
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
       order: [ 9, 'desc' ],
       <?php if (Sentinel::getUser()->hasAccess(['asset.download'])) { ?>
       dom: '<"html5buttons"B>lTfgitp',
       <?php } ?>
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

		$(".select2_demo_1").select2();
    function ConfirmDelete()
  {
  var x = confirm("Are you sure you want to delete?");
  if (x)
    return true;
  else
    return false;
  }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>