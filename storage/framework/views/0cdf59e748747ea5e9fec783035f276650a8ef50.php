<?php $__env->startSection('title'); ?>
Transaksi
<?php $__env->stopSection(); ?>
<?php $__env->startSection('desc'); ?>
Tabungan Nasabah
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
  <?php echo e(HTML::style('assets_back/css/plugins/iCheck/custom.css')); ?>

  <?php echo e(HTML::style('assets_back/css/plugins/chosen/chosen.css')); ?>

  <?php echo e(HTML::style('assets_back/css/plugins/dataTables/datatables.min.css')); ?>

  <?php echo e(HTML::style('assets_back/css/plugins/select2/select2.min.css')); ?>

  <?php echo e(HTML::style('assets_back/css/plugins/datapicker/datepicker3.css')); ?>

  <style type="text/css">
    .tabs-container .nav-tabs > li.active > a, .tabs-container .nav-tabs > li.active > a:hover, .tabs-container .nav-tabs > li.active > a:focus {
    background-color: #ddd !important; 
    }
    .table-sortable tbody tr {
    cursor: move;
    }
  </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="wrapper wrapper-content">
                    <div class="row detail_content3">
    <div class="col-lg-12 detail_content2" style="background-color: white"><style>
                        .ibox { margin: 1px 2px 0px 0px !important }
                        .ibox.float-e-margins{ margin: 0px 2px !important}
                        </style>
      <div class="row ibox-title">
   <ol class="breadcrumb col-sm-6 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
        <li class="">
            <a href="<?php echo e(url('nasabah')); ?>"> Transaksi</a>
        </li>
        <li class="">
            <a href="<?php echo e(url('nasabah')); ?>"> Tabungan Nasabah</a>
        </li>
        
        <li class="">
                <a href="#">
                    Tambah Transaksi
                </a>
        </li>
    </ol>
            <a href="<?php echo e(url('nasabah')); ?>">
            <button class="btn btn-sm btn-outline btn-primary pull-right">
            <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
            </button>
            </a>
    </div>
<div class="row ibox-content" style="min-height: 65vh; ">
    <div class="col-xs-12 col-sm-12">
   <?php echo Form::open(['url' => 'tabungan', 'class' => 'form-horizontal']); ?>

   <?php echo Form::hidden('created_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

    <?php echo Form::hidden('updated_by', Sentinel::getUser()->id, ['class' => 'form-control']); ?>

    <?php echo Form::hidden('unit_kerja', Sentinel::getUser()->unit_id, ['class' => 'form-control']); ?>

   
               <div class="form-group <?php echo e($errors->has('norek') ? 'has-error' : ''); ?>">
                <?php echo Form::label('norek', 'Nasabah*', ['class' => 'col-sm-2 control-label']); ?>

                <div class="col-sm-8">
                <select name="norek" class="col-sm-12 form-control Norek chosen-select" style="width:350px;" tabindex="2" id="norek" data-fplaceholder="Nasabah">
                                 <option value=""></option>
                                  <?php $__currentLoopData = $nasabahs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nasabah): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($nasabah->norek); ?>"><?php echo e($nasabah->norek); ?> - <?php echo e($nasabah->nama_depan); ?> <?php echo e($nasabah->nama_belakang); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                    
                    <?php echo $errors->first('norek', '<p class="help-block">:message</p>'); ?>

                </div>                       
            </div>       
            <div class="form-group">
                <button id="showNasabah" type="button" class="btn btn-sm btn-success btn-outline pull-right showNasabah"><i class="fa fa-list" ></i> Pratinjau Nasabah</button>
            </div>
            <div class="hr-line-dashed"></div>
            <div id="data-model">
              </div>
              <div class="form-group" id="dataNasabah">
                    <div class="jumbotron">
                        <h2><span id="noreks"></span> - <span id="nama_depan"></span> <span id="nama_belakang"></span></h2> 
                         
             <div class="tabs-container" id="dataTabs">
              <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#dtl" class="dtl" data-status="true">Info Nasabah</a></li>
                <li class=""><a data-toggle="tab" href="#riwayat"  class="attr" d data-status="false">Info Saldo</a></li>
              </ul>
            </div>
            <hr>
             <div class="tab-content">
              <div id="dtl" class="tab-pane active">
                <div class="col-lg-12">
                <div class="form-group">
                    <div class="col-sm-2">
                        Kelompok Anggota
                    </div>
                    <div class="col-sm-4">: <label id="kelompok_anggota"></label></div>
                    <div class="col-sm-2">
                        Jenis Nasabah
                    </div>
                    <div class="col-sm-4">: <label id="jenis_nasabah"></label></div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2">
                        Identitas
                    </div>
                    <div class="col-sm-4">: <label id="identitas"></label></div>
                    <div class="col-sm-2">
                        Unit Kerja
                    </div>
                    <div class="col-sm-4">: <label></label></div>
                </div>
                <div class="form-group" id="dataPerorangan">
                    <div class="col-sm-2">
                        Pekerjaan
                    </div>
                    <div class="col-sm-4">: <label id="pekerjaan"></label></div>
                    <div class="col-sm-2">
                        Organisasi
                    </div>
                    <div class="col-sm-4">: <label id="organisasi"></label></div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2">
                        No. Telepon
                    </div>
                    <div class="col-sm-4">: <label id="no_telp"></label></div>
                    <div id="dataBinaan">
                    <div class="col-sm-2">
                        PIC Binaan
                    </div>
                    <div class="col-sm-4">: <label id="pic"></label></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2">
                        Alamat
                    </div>
                    <div class="col-sm-4">: <label id="alamat"></label></div>
                </div>
                </div>
                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-12 col-xs-12">
                        <h3 class="col-sm-10 col-xs-2 row">Keterangan mengenai <span id="nama_depans"></span> <span id="nama_belakangs"></span></h3>
                      </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 row">
                      <div class="col-sm-10 col-xs-12" id="keterangan">
                      </div>
                    </div>
                </div>
                <div id="riwayat" class="tab-pane">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="col-sm-2">
                                  Saldo(Rp.)
                                  </div>
                                 <div class="col-sm-4">: <label id="saldo"></label></div>
                             
                            
                          
                             </div>
                             <div class="form-group">
                                <div class="col-sm-2">
                                  Saldo(kg)
                                  </div>
                                 <div class="col-sm-4">: <label id="saldo_kg"></label></div>
                             </div>
                             <div class="form-group">
                                 <div class="col-sm-2">
                                  Transaksi Terakhir
                                  </div>
                                 <div class="col-sm-4">: <label id="created_at2"></label></div>
                             </div>
                                            
                        </div>
                </div>
                
                    <div class="form-group">
      <div class="col-sm-6 col-xs-12">
      </div>
      <div class="col-sm-6 col-xs-12">
      <a id="closeNasabah" class="detail2 btn btn-md btn-success pull-right">  <i class="fa fa-times-circle" ></i> Tutup</a>
      </a>
    </div>
  </div>
    </div> 
                    </div>
                 
                </div>
                 <div class="form-group <?php echo e($errors->has('code') ? 'has-error' : ''); ?>">

                  <?php echo Form::label('code', 'Kode*', ['class' => 'col-sm-2 control-label']); ?>

                    <div class="col-sm-3">
                        <select  name="code" class="col-sm-12 form-control Code chosen-select" data-placeholder="Pilih Kode" id="code" style="width:350px;" tabindex="2">
                                  <option value=""></option>
                                  <option value="D">Debit (D)</option>
                                  <option value="K">Kredit (K)</option>
                                  <option value="R">Reversal/Koreksi (R)</option>   
                        </select>
                        <?php echo $errors->first('code', '<p class="help-block">:message</p>'); ?>

                    </div> 
                 </div>
                <div class="hr-line-dashed"></div>
                <div id="showKredit">
                  <div class="form-group <?php echo e($errors->has('norek') ? 'has-error' : ''); ?>">
                <?php echo Form::label('gudang', 'Gudang*', ['class' => 'col-sm-2 control-label']); ?>

                <div class="col-sm-8">
                <select name="gudang" class="col-sm-12 form-control Gudang chosen-select" style="width:350px;" tabindex="2" id="gudang" data-fplaceholder="Gudang">
                                 <option value="<?php echo e($gudang->id); ?>"><?php echo e($gudang->name); ?></option>
                                  <?php $__currentLoopData = $gudangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gudang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($gudang->id); ?>"><?php echo e($gudang->code); ?> - <?php echo e($gudang->name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                    
                    <?php echo $errors->first('gudang', '<p class="help-block">:message</p>'); ?>

                </div>                       
            </div> 
            <div class="hr-line-dashed"></div>
                <div class="row clearfix">
                <div class="col-md-12 table-responsive">
                  <table class="table table-bordered table-hover table-sortable" id="tab_logic">
        <thead>
          <tr >
            <th class="text-center">
            </th>
            <th class="text-center" style="width:250px;">
              Sampah
            </th>
            <th class="text-center" style="width:200px;">
              Satuan
            </th>
            <th class="text-center" style="width:100px;">
              Jumlah
            </th>
            <th class="text-center">
              Harga/kg
            </th>
            <th class="text-center">
              Nilai(kg)
            </th>
            <th class="text-center">
              Nilai(Rp.)
            </th>
            
          </tr>
        </thead>
        <tbody>
            <tr id='addr0' data-id="0" class="hidden">
               <td data-name="del">
                <button nam"del0" class='btn btn-default btn-xs glyphicon glyphicon-remove row-remove'></button>
            </td>
            <td data-name="sampah">
              <select  name="sampah[]" class="form-control Sampah chosen-select" data-placeholder="Pilih Sampah"  style="width:250px;">
                    <option value=""></option>
                     <?php $__currentLoopData = $sampahs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sampah): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($sampah->id); ?>"><?php echo e($sampah->code); ?> - <?php echo e($sampah->name); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                </select>
            </td>
            <td data-name="satuan">
                <select  name="satuan[]" class="form-control Satuan chosen-select" id="satuan" style="width:200px;">
                  <?php $__currentLoopData = $satuans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $satuan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($satuan->code); ?>"><?php echo e($satuan->name); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                </select>
            </td>
            <td data-name="jumlah">
                <?php echo Form::number('jumlah[]', null, ['class' => 'form-control Jumlah Jumlah2','step'=>'any']); ?>

            </td>
            <td data-name="harga_beli">
                <?php echo Form::number('harga_beli[]', null, ['class' => 'form-control']); ?>


            </td>
            <td data-name="nilai_kg">
                <?php echo Form::number('nilai_kg[]', null, ['class' => 'form-control Nkg','readonly'=>'readonly']); ?>

            </td>
            <td data-name="nilai_rp">
                <?php echo Form::number('nilai_rp[]', null, ['class' => 'form-control Nrp','readonly'=>'readonly']); ?>

            </td>
           
          </tr>
        </tbody>
        <tfoot>
           <tr>
            <td colspan="5" style="text-align: right;"><b>Jumlah</b></td>
            <td colspan="1">
                <?php echo Form::number('saldo_sampah', null, ['class' => 'form-control','readonly'=>'readonly','id'=>'saldo_sampah']); ?>

            </td>
            <td colspan="1">
                <?php echo Form::number('kredit', null, ['class' => 'form-control','readonly'=>'readonly','id'=>'kredit','id'=>'kredit']); ?>

            </td>
          </tr>
        </tfoot>
        </table>
        </div>
        </div>
                
                <a id="add_row" class="btn btn-success btn-xs pull-right btn-outline " ><i class="fa fa-plus"></i> Tambah</a> 
                <a id="kal" class="btn btn-warning btn-xs pull-right  btn-outline "  style="margin-right: 5px;"><i class="fa fa-refresh"></i> Kalkukasi</a>
                
                <br/>
                <div class="hr-line-dashed"></div>  
                </div>
             <div id="showDebit">
                <div class="form-group <?php echo e($errors->has('debit') ? 'has-error' : ''); ?>" >
                <?php echo Form::label('debit', 'Debit', ['class' => 'col-sm-2 control-label']); ?>

                <div class="col-sm-6">
                    <?php echo Form::number('debit', null, ['class' => 'form-control']); ?>

                    <?php echo $errors->first('debit', '<p class="help-block">:message</p>'); ?>

                </div>
            </div>
            <div class="hr-line-dashed"></div>
            </div>
      
             <div class="form-group ">
                <?php echo Form::label('keterangan', 'Keterangan', ['class' => 'col-sm-2 control-label']); ?>

                <div class="col-sm-4 col-xs-12 <?php echo e($errors->has('notes') ? 'has-error' : ''); ?>">
                  <?php echo Form::textarea('keterangan', null, ['class' => 'form-control', 'rows' => '2', 'placeholder' => 'Keterangan [Max: 500 Katakter]']); ?>

                  <?php echo $errors->first('keterangan', '<p class="help-block">:message</p>'); ?>

                </div>               
            </div>
          <div class="hr-line-dashed"></div>
          <div class="form-group">
          <?php echo Form::label('created_at', 'Tgl. Transaksi', ['class' => 'col-sm-2 control-label']); ?>

          <div class="col-sm-4 <?php echo e($errors->has('created_at') ? 'has-error' : ''); ?>">
              <?php echo Form::text('created_at', $datenow, ['id' => 'created_at','class' => 'form-control','data-date-format'=>'yyyy-mm-dd','placeholder' => $datenow]); ?>

              <?php echo $errors->first('created_at', '<p class="help-block">:message</p>'); ?>

          </div>
        </div>
      

             <?php echo Form::hidden('trx_code', null, ['class' => 'form-control','id'=>'trx_code']); ?>

  

      <div class="hr-line-dashed"></div>
     <div class="form-group">
      <div class="col-sm-2 col-xs-12">
      </div>
      <div class="col-sm-6 col-xs-12">
      
      <button type="submit" class="create_mdl btn btn-success pull-left" style="margin-right: 10px; ">
                        <i class="fa fa-save"></i> Proses
                      </button>
      <a href="<?php echo e(url('nasabah')); ?>" class="detail2 btn btn-md btn-outline btn-default pull-left">  <i class="fa fa-times-circle" ></i> Batal</a>
      </a>
    </div>
    </div>
    <?php echo Form::close(); ?> 
  </div>
</div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<?php echo e(HTML::script('assets_back/js/plugins/iCheck/icheck.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/chosen/chosen.jquery.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/dataTables/datatables.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/select2/select2.full.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/datapicker/bootstrap-datepicker.js')); ?>

<script>
            $(document).ready(function () {

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

            

// DYNAMIC TABLE
  $("#add_row").on("click", function() {

        // Dynamic Rows Code
        
        // Get max row id and set new id
        var newid = 0;
        $.each($("#tab_logic tr"), function() {
            if (parseInt($(this).data("id")) > newid) {
                newid = parseInt($(this).data("id"));
            }
        });
        newid++;
        
        var tr = $("<tr></tr>", {
            id: "addr"+newid,
            "data-id": newid
        });
        
        // loop through each td and create new elements with name of newid
        $.each($("#tab_logic tbody tr:nth(0) td"), function() {
            var cur_td = $(this);
            
            var children = cur_td.children();
            
            // add new td and element if it has a nane
            if ($(this).data("name") != undefined) {
                var td = $("<td></td>", {
                    "data-name": $(cur_td).data("name")
                });
                
                var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
              //  c.attr("name", $(cur_td).data("name") + newid);
                c.attr("id", $(cur_td).data("name") + newid);
                c.attr("data-id", newid);
                c.appendTo($(td));
                td.appendTo($(tr));
           
            } else {
                var td = $("<td></td>", {
                    'text': $('#tab_logic tr').length
                }).appendTo($(tr));


            }

           
        });
        
        // add the new row
        $(tr).appendTo($('#tab_logic'));
        
        $(tr).find("td button.row-remove").on("click", function() {
             $(this).closest("tr").remove();
           
        });

         $(tr).find("td select.Sampah").on('change', function(e){

     if ($(this).find(':selected').val() != '') {
  
            // GET NOREK
         var val     = $(this).find(':selected').val(),
             item_d  = $(this).find(':selected').data(),
             dataid  = $(this).data("id"),
             url     = '<?php echo e(url("/getharga?sampah=")); ?>'+val+'';

           $.ajax({
               url : url,
               type: "GET",
               dataType: 'html',
               success: function(datas){
                   $('#harga_beli'+dataid+'').val(datas);
                   return false;
               }
           });
     }

   });
          $(tr).find("td input.Jumlah").on('keyup', function(e){

            // GET NOREK
         var dataid  = $(this).data("id"),
             val     = $('#jumlah'+dataid+'').val(),
             satuan = $('#satuan'+dataid+'').val(),
             url     =  '<?php echo e(url("/getsatuan?satuan=")); ?>'+satuan+'';

           $.ajax({
               url : url,
               type: "GET",
               dataType: 'html',
               success: function(datas){

                var nilai_kg = $('#jumlah'+dataid+'').val() * datas;

                  $('#nilai_kg'+dataid+'').val(nilai_kg);

                var nilai_rp = $('#harga_beli'+dataid+'').val() * nilai_kg;

                   $('#nilai_rp'+dataid+'').val(nilai_rp);

                   return false;
               }
           });    
             
   });

          $(tr).find("td input.Jumlah2").on("change", function(){

            calc();

          });



          $(function () {
          $('body').on('DOMNodeInserted', 'select', function () {
          $(this).select2();
           });
    
          $('.Sampah').select2();
          $('.Satuan').select2().val('kg').trigger('change.select2');


 
});
    
        
});

$("#kal").on("click", function(){

          calc();

          });

function calc(){

    var sum1 = 0;

    $('.Nkg').each(function() {
        sum1 += Number($(this).val());
    });
   
     $('#saldo_sampah').val(sum1);


       var sum2 = 0;

    $('.Nrp').each(function() {
        sum2 += Number($(this).val());
    });
   
     $('#kredit').val(sum2);
     
}
    // Sortable Code
    var fixHelperModified = function(e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();
    
        $helper.children().each(function(index) {
            $(this).width($originals.eq(index).width())
        });
        
        return $helper;
    };
  
    $(".table-sortable tbody").sortable({
        helper: fixHelperModified      
    }).disableSelection();

    $(".table-sortable thead").disableSelection();



    $("#add_row").trigger("click");
// END DYNAMIC TABLE


     $('#showNasabah').hide();
     $('#dataNasabah').hide();
     $('#showDebit').hide();
     $('#showKredit').hide();

     

     $('#code').on('change', function(e){

     if ($(this).find(':selected').val() != '') { 

      var val     = $(this).find(':selected').val();

           if(val == "D"){
            $('#trx_code').empty();
             $('#showDebit').slideDown('slow');
              $('#showKredit').slideUp('slow');

                }
             else{ 
             $('#trx_code').empty();
             $('#showKredit').slideDown('slow');
             $('#showDebit').slideUp('slow');
             }

         var norek =  $('#norek').val(),
             item_d  = $(this).find(':selected').data(),
             url     = '<?php echo e(url("/gettrxcode?norek=")); ?>'+norek+'&code='+val+'';

           $.ajax({
               url : url,
               type: "GET",
               dataType: 'html',
               success: function(datas){
                  $('#trx_code').val(datas);
                   return false;
               }
           });

           
     }

   });

     $('#norek').on('change', function(e){

     if ($(this).find(':selected').val() != '') {

           //show nasabah
             $('#showNasabah').slideDown('slow');
             $('#trx_code').empty();
 
     }

   });

     

    $('#showNasabah').on('click', function(e){
      $('#showNasabah').hide();
       $('#dataNasabah').slideDown('slow');
      console.log(e);
      var value = e.target.value;
      var norek =  $('#norek').find(':selected').val();

  
      url     =  '<?php echo e(url("/datanasabah?norek=")); ?>'+norek;

      $.ajax({
          url : url,
          type: "GET",
          dataType: 'html',
          success: function(data, subcatObj){

            var objData = jQuery.parseJSON(data);

          //  alert(objData.name);
               if(objData.jenis_nasabah == "Binaan"){
                $('#dataBinaan').show();
                $('#dataPerorangan').hide();
               }else if(objData.jenis_nasabah == "Perorangan"){
                $('#dataPerorangan').show();
                 $('#dataBinaan').hide();
               }


              $('#dataNasabah').slideDown('slow');
              $('#noreks').append(objData.norek);
              $('#nama_depan').append(objData.nama_depan);
              $('#nama_belakang').append(objData.nama_belakang);
              $('#nama_depans').append(objData.nama_depan);
              $('#nama_belakangs').append(objData.nama_belakang);
              $('#kelompok_anggota').append(objData.kelompok_anggota);
              $('#jenis_nasabah').append(objData.jenis_nasabah);
              $('#identitas').append(objData.identitas);
              $('#unit_kerja').append(objData.unit_kerja);
              $('#pekerjaan').append(objData.pekerjaan);
              $('#organisasi').append(objData.organisasi);
              $('#no_telp').append(objData.no_telp);
              $('#alamat').append(objData.alamat);
              $('#keterangan').append(objData.keterangan);
              $('#pic').append(objData.pic);
              $('#saldo').append(objData.saldo);
              $('#saldo_kg').append(objData.saldo_sampah);
              $('#created_at2').append(objData.created_at);



              return false;
              }
          });




      });
       $('#closeNasabah').on('click', function(e){
        $('#showNasabah').show();
        $('#dataNasabah').slideUp('slow');
        $('#noreks').empty();
              $('#nama_depan').empty();
              $('#nama_belakang').empty();
              $('#nama_depans').empty();
              $('#nama_belakangs').empty();
              $('#kelompok_anggota').empty();
              $('#jenis_nasabah').empty();
              $('#identitas').empty();
              $('#unit_kerja').empty();
              $('#pekerjaan').empty();
              $('#organisasi').empty();
              $('#no_telp').empty();
              $('#alamat').empty();
              $('#keterangan').empty();
              $('#pic').empty();

    });

                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });

        $("#created_at").datepicker({
              format :  'yyyy-mm-dd',
              keyboardNavigation : false,
              forceParce: false,
              todayBtn: 'linked',
              todayHighlight :  true,
              daysOfWeekDisabled : [0],
            });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>