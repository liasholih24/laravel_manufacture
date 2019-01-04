<?php $__env->startSection('title'); ?>
Tabungan
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <h1>Tabungan</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Norek</th><th>Code</th><th>Debit</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo e($tabungan->id); ?></td> <td> <?php echo e($tabungan->norek); ?> </td><td> <?php echo e($tabungan->code); ?> </td><td> <?php echo e($tabungan->debit); ?> </td>
                </tr>
            </tbody>    
        </table>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>