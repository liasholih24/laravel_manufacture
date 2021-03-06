<?php $__env->startSection('title'); ?>
Rekapitulasi 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Rekapitulasi Persediaan
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
<?php echo e(HTML::style('assets_back/css/plugins/select2/select2.min.css')); ?>

<?php echo e(HTML::style('assets_back/css/plugins/dataTables/datatables.min.css')); ?>

<?php echo e(HTML::style('assets_back/css/plugins/chosen/chosen.css')); ?>

<?php echo e(HTML::style('assets_back/css/plugins/datapicker/datepicker3.css')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
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
                            <a href="<?php echo e(url('rekapitulasi/stocks')); ?>">
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
                             <option value="<?php echo e(url('stocks')); ?>">Pilih Gudang</option>
                             <?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <option value="<?php echo e($filter->id); ?>" <?php if ($filter->id == $id) echo ' selected="selected"'; ?>>
                               <?php echo e($filter->name); ?>

                             </option>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         </select>
                        </div>
                    </div>

                   <div class="form-group" id="data_4">
                                <label class="font-noraml">Waktu</label>
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
              <strong>Rekapitulasi Persediaan</strong> <small>dikelompokkan berdasarkan sampah</small>
          </li>
        </ol>
          <a href="<?php echo e(url('stocks')); ?>" class="btn btn-sm btn-outline btn-primary pull-right">
              <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
          </a>
       
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
<table class="table table-striped table-bordered table-hover" id="tblstocks">
<thead>
    <tr>
        <th>No.</th>
        <th>Sampah</th>
        <th>Jml. Masuk</th>
        <th>Jml. Keluar</th>
        <th>Saldo(Kg)</th>
        <th>Saldo(Rp.)</th>
        <th>Perbaharuan Terakhir</th>
    </tr>
</thead>
<tfoot>
            <tr>
               <th></th>
               <th>Total</th>
               <th></th>
               <th></th>
               <th></th>
               <th></th>
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php echo e(HTML::script('assets_back/js/plugins/dataTables/datatables.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/select2/select2.full.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/chosen/chosen.jquery.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/datapicker/bootstrap-datepicker.js')); ?>


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
       ajax: '<?php echo e(url("/rekstocksapi")); ?>',
       columns: [
           {data: 'id', name: 'id'},
           {data: 'sampah', name: 'sampah'},
           {data: 'qty_in', name: 'qty_in'},
           {data: 'qty_out', name: 'qty_out'},
           {data: 'qty', name: 'qty'},
           {data: 'saldo', name: 'saldo'},
           {data: 'created_at', name: 'created_at'}
           
       ],
      lengthMenu: [[10, 25, 50, 100, 250, 500], [10, 25, 50,100,250,500, "All"]],
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
       order: [ 6, 'desc' ],
       
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
                .column(2)
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            QtyIn = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 2 ).footer() ).html(
                ''+QtyIn +''
            );
 
            // Total over all pages
            qty_out = api
                .column(3)
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            QtyOut = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3).footer() ).html(
                ''+QtyOut +''
            );

           

            // Total over all pages
            qty = api
                .column(4)
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            Qty = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                ''+Qty +''
            );


            // Total over all pages
            qty2 = api
                .column(5)
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            Qty2 = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 5 ).footer() ).html(
                ''+Qty2 +''
            );
        }

   });



      $('#filter').on('click', function(e){
        var gudang    = $('#gudang').val(),
            from = $('#from').val(),
            to = $('#to').val();

     table.ajax.url("<?php echo e(url("/rekstocksapi")); ?>?gudang="+gudang+"&fromDate="+from+"&toDate="+to);
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>