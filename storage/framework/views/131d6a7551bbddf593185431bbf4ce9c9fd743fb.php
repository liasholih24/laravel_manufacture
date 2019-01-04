<?php $__env->startSection('title'); ?>
Laporan
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Laporan Pembelian
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
            <div class="" style="margin: 30px 0">

                  <div class="form-group ">
                       <label class="font-noraml">Gudang</label>
                       <div class="input-group col-sm-12 col-xs-12 ">
                        <select name="gudang" class="form-control chosen-select Gudang chosen-update" data-placeholder="Pilih Gudang" id="gudang">
                             <option value="">Pilih Gudang</option>
                             <?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <option value="<?php echo e($filter->id); ?>" <?php if ($filter->id == $id) echo ' selected="selected"'; ?>>
                               <?php echo e($filter->name); ?>

                             </option>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
              Laporan Pembelian
          </li>
        </ol>
          <a href="<?php echo e(url('laporan/pembelian')); ?>" class="btn btn-sm btn-outline btn-primary pull-right">
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

<table class="table table-striped table-bordered table-hover" id="tblpembelian">
<thead>
    <tr>
        <th>ID</th>
        <th>Kode</th>
        <th>Nama Pembeli</th>
        <th>Jml (Kg)</th>
        <th>Jumlah (Rp)</th>
        <th>Keterangan</th>
        <th>Tgl. pembelian</th>
    </tr>
</thead>
<tfoot>
     <tr>
        <th></th>
        <th></th>
        <th>Total</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
</tfoot>
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


      var table = $('#tblpembelian').DataTable({
       processing: true,
       serverSide: true,
       ajax: '<?php echo e(url("/pembelianapi")); ?>',
       columns: [
           {data: 'id', name: 'id'},
           {data: 'code', name: 'code'},
           {data: 'name', name: 'name'},
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
            kg = api
                .column(4)
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            Kg = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 4 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                Kg.toLocaleString()
            );

             // Total over all pages
            rp = api
                .column(3)
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            Rp = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                Rp.toLocaleString()
            );

       
        }

   });

   $('#filter').on('click', function(e){
     var perusahaan = $('#perusahaan').val();
     var gudang = $('#gudang').val();
     var from = $('#from').val();
     var to = $('#to').val();
     table.ajax.url("<?php echo e(url("/pembelianapi")); ?>?fromDate="+from+"&toDate="+to+"&gudang="+gudang);
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