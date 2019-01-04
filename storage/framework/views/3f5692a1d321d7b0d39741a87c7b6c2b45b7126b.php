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
                                    <h4 class="text-navy"><?php echo e($tabungan->trx_code); ?> </h4>
                                    <address>
                                        <h4><strong><?php echo e($tabungan->norek); ?> - <?php echo e($tabungan->getnasabah->nama_depan); ?></strong></h4>
                                    </address>
                                    <p>
                                        <span><strong>Unit:</strong> <?php echo e($tabungan->getnasabah->group_code); ?> - <?php echo e($tabungan->getnasabah->getgroup->name); ?></span><br/>
                                        <span><strong>Tgl:</strong> <?php echo e($tabungan->created_at); ?></span>
                                    </p>
                                </div>
                            </div>
                            <?php if($tabungan->code == "K"): ?>
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
                                    <td><?php echo e(number_format($tabungan->saldo,0)); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Total (kg) :</strong></td>
                                    <td><?php echo e(number_format($tabungan->saldo_sampah)); ?></td>
                                </tr>
                                
                                </tbody>
                            </table>
                            <?php else: ?>
                            <div class="row ">
                                <div class="col-sm-6">
                                  <h2>Debit : Rp. <?php echo e(number_format($tabungan->debit)); ?></h2>
                                </div>
                            </div>
                            <?php endif; ?>
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