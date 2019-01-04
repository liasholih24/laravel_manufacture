<?php
    header('Content-type: text/plain');
?>
<?php $__env->startSection('style'); ?>
 <?php echo e(HTML::style('assets_back/css/plugins/dataTables/datatables.min.css')); ?>

<?php $__env->stopSection(); ?>
                <div class="wrapper wrapper-content p-xl">
                    <div class="ibox-content p-xl">
                            <div class="row">
                                <div class="col-sm-6">
                                    <address>
                                        <strong>PD. Kebersihan Kota Bandung</strong><br>
                                        Jl. Babakan Sari No. 64 Kebaktian<br>
                                        Bandung<br>
                                    </address>
                                </div>

                                <div class="col-sm-6 text-right">
                                    <h4 class="text-navy"><?php echo e($sedekah->code); ?> </h4>
                                    <address>
                                        <h4><strong><?php echo e($sedekah->perusahaan); ?></strong></h4>
                                       <?php echo e($sedekah->keterangan); ?>

                                    </address>
                                    <p>
                                       
                                        <span><strong>Tgl:</strong> <?php echo e($sedekah->created_at); ?></span>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="table-responsive m-t">
                                <table class="table invoice-table">
                                    <thead>
                                    <tr>
                                        <th>Sampah</th>
                                        <th>Jumlah </th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                      <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <tr>
                                         <td><?php echo e($detail->sampah); ?></td>
                                         <td><?php echo e($detail->jumlah); ?></td>
                                         <td><?php echo e($detail->satuan); ?></td>
                                         <td><?php echo e(number_format($detail->harga_beli,0)); ?></td>
                                         <td><?php echo e(number_format($detail->nilai_rp,0)); ?></td>

                                       </tr>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div><!-- /table-responsive -->

                            <table class="table invoice-total">
                                <tbody>
                                <tr>
                                    <td><strong>Total (Rp.):</strong></td>
                                    <td><?php echo e(number_format($sedekah->total_rp,0)); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Total (kg) :</strong></td>
                                    <td><?php echo e(number_format($sedekah->total_kg)); ?></td>
                                </tr>
                                
                                </tbody>
                            </table>
                           
                            <br/>
                            
                            <div class="well m-t"><strong>Keterangan</strong>
                                Slip ini dikeluarkan oleh sistem dan merupakan bukti yang sah dalam transaksi.
                            </div>
                        </div>

                  </div>

<?php $__env->startSection('script'); ?>

<?php echo e(HTML::script('assets_back/js/plugins/dataTables/datatables.min.js')); ?>


<!-- Page-Level Scripts -->
<script>
    window.print();
     $(document).ready(function(){

    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backLayout.appprint', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>