<?php $__env->startSection('title'); ?>
Sid
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <h1>Sid <a href="<?php echo e(url('sid/create')); ?>" class="btn btn-primary pull-right btn-sm">Add New Sid</a></h1>
    <div class="table table-responsive">
        <table class="table table-bordered table-striped table-hover" id="tblsid">
            <thead>
                <tr>
                    <th>ID</th><th>Code</th><th>Name</th><th>Phone</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $sid; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item->id); ?></td>
                    <td><a href="<?php echo e(url('sid', $item->id)); ?>"><?php echo e($item->code); ?></a></td><td><?php echo e($item->name); ?></td><td><?php echo e($item->phone); ?></td>
                    <td>
                        <a href="<?php echo e(url('sid/' . $item->id . '/edit')); ?>" class="btn btn-primary btn-xs">Update</a> 
                        <?php echo Form::open([
                            'method'=>'DELETE',
                            'url' => ['sid', $item->id],
                            'style' => 'display:inline'
                        ]); ?>

                            <?php echo Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']); ?>

                        <?php echo Form::close(); ?>

                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#tblsid').DataTable({
            columnDefs: [{
                targets: [0],
                visible: false,
                searchable: false
                },
            ],
            order: [[0, "asc"]],
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>