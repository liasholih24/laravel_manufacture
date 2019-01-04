<?php
    header('Content-type: text/plain');
?>
<?php $__env->startSection('style'); ?>
<style type="text/css">
  .ibox-content {
   border-color: #fff !important;
}
.tbl > tbody > tr > td, .tbl > tfoot > tr > td {
    border-top: 1px solid #fff !important;
    font-family: "Times New Roman", Times, serif;
    font-size: 12px;
    margin-left: 2cm;
    margin-right: 2cm;
    margin-top: 20cm;
    
}
.tbl > thead > tr > th {
    border-bottom: 1px solid #fff !important;
}



</style>
<style type="text/css" media="print">
@page
{
        size: A4 portrait;
        font-family: "Times New Roman", Times, serif;
        font-size: 0.5em;
        margin-left: 3mm;
        margin-right: 15mm;
        margin-top: 18mm;
        margin-bottom: 2mm;
}
.noprint{
  display: none !important;
}
table {
  table-layout: fixed;
  width: 20vh;
}
thead th:nth-child(1) {
  width: 3.5vh;
}
thead th:nth-child(2) {
  width: 11vh;
}
thead th:nth-child(3) {
  width: 12vh;

}
thead th:nth-child(4) {
  width: 12vh;
}
thead th:nth-child(5) {
  width: 13vh;
}
thead th:nth-child(6) {
  width: 11vh;
}
</style>
<?php $__env->stopSection(); ?>
                <div class="wrapper wrapper-content ">
                    <div class="">
                            <div class="">
                                <table class="tbl" width="100%">
                                  <thead>
                                    <th width="5%"></th>
                                    <th width="20%"></th>
                                    <th width="20%"></th>
                                    <th width="20%"></th>
                                    <th width="20%"></th>
                                    <th width="10%"></th>
                                  </thead>
                                  <tbody>
                                 <?php $i= $p;$addRow=true?>
                                   <?php $__currentLoopData = $riwayats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $riwayat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <?php $i++?>

                              <?php if($riwayat->print_code && $addRow): ?>
                                 <?php 
                                 $addRow=false;
                                  ?>
                              <tr>
                                <td class="no">&nbsp;</td>
                                <td class="tgl"></td>
                                <td class="debit"></td>
                                <td class="kredit"></td>
                                <td class="rp"></td>
                                <td class="kg"></td>
                              </tr>   
                             <?php endif; ?>

                              <tr>
                                <td class="no"><?php echo e(!empty($riwayat->print_code)?"&nbsp;":$i); ?></td>
                                <td class="tgl"><?php echo e(!empty($riwayat->print_code)?" ": $riwayat->created_at->format('d/m/Y')); ?></td>
                                <td class="debit"><?php echo e(!empty($riwayat->print_code)?" ": number_format($riwayat->debit, 0)); ?></td>
                                <td class="kredit"><?php echo e(!empty($riwayat->print_code)?" ": number_format($riwayat->kredit, 0)); ?></td>
                                <td class="rp"><?php echo e(!empty($riwayat->print_code)?" ": number_format($riwayat->saldo, 0)); ?></td>
                                <td class="kg"><?php echo e(!empty($riwayat->print_code)?"  ": $riwayat->saldo_sampah); ?></td>
                              </tr>
                                
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>

                               <div class="noprint"><?php echo e($riwayats->links()); ?></div>
                            </div><!-- /table-responsive -->

                      
                      
                        </div>
    </div>

<?php $__env->startSection('script'); ?>
<!-- Page-Level Scripts -->
<script>

     window.print();
     window.reload();
     $(document).ready(function(){

    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.appprint', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>