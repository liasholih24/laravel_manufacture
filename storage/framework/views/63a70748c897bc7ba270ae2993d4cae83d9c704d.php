<?php $__env->startSection('title'); ?>
Edit Sid
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <h1>Edit Sid</h1>
    <hr/>

    <?php echo Form::model($sid, [
        'method' => 'PATCH',
        'url' => ['sid', $sid->id],
        'class' => 'form-horizontal'
    ]); ?>


                <div class="form-group <?php echo e($errors->has('code') ? 'has-error' : ''); ?>">
                <?php echo Form::label('code', 'Code: ', ['class' => 'col-sm-3 control-label']); ?>

                <div class="col-sm-6">
                    <?php echo Form::text('code', null, ['class' => 'form-control']); ?>

                    <?php echo $errors->first('code', '<p class="help-block">:message</p>'); ?>

                </div>
            </div>
            <div class="form-group <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
                <?php echo Form::label('name', 'Name: ', ['class' => 'col-sm-3 control-label']); ?>

                <div class="col-sm-6">
                    <?php echo Form::text('name', null, ['class' => 'form-control']); ?>

                    <?php echo $errors->first('name', '<p class="help-block">:message</p>'); ?>

                </div>
            </div>
            <div class="form-group <?php echo e($errors->has('phone') ? 'has-error' : ''); ?>">
                <?php echo Form::label('phone', 'Phone: ', ['class' => 'col-sm-3 control-label']); ?>

                <div class="col-sm-6">
                    <?php echo Form::number('phone', null, ['class' => 'form-control']); ?>

                    <?php echo $errors->first('phone', '<p class="help-block">:message</p>'); ?>

                </div>
            </div>
            <div class="form-group <?php echo e($errors->has('pic') ? 'has-error' : ''); ?>">
                <?php echo Form::label('pic', 'Pic: ', ['class' => 'col-sm-3 control-label']); ?>

                <div class="col-sm-6">
                    <?php echo Form::text('pic', null, ['class' => 'form-control']); ?>

                    <?php echo $errors->first('pic', '<p class="help-block">:message</p>'); ?>

                </div>
            </div>
            <div class="form-group <?php echo e($errors->has('pic_phone') ? 'has-error' : ''); ?>">
                <?php echo Form::label('pic_phone', 'Pic Phone: ', ['class' => 'col-sm-3 control-label']); ?>

                <div class="col-sm-6">
                    <?php echo Form::number('pic_phone', null, ['class' => 'form-control']); ?>

                    <?php echo $errors->first('pic_phone', '<p class="help-block">:message</p>'); ?>

                </div>
            </div>
            <div class="form-group <?php echo e($errors->has('status') ? 'has-error' : ''); ?>">
                <?php echo Form::label('status', 'Status: ', ['class' => 'col-sm-3 control-label']); ?>

                <div class="col-sm-6">
                    <?php echo Form::number('status', null, ['class' => 'form-control']); ?>

                    <?php echo $errors->first('status', '<p class="help-block">:message</p>'); ?>

                </div>
            </div>
            <div class="form-group <?php echo e($errors->has('address') ? 'has-error' : ''); ?>">
                <?php echo Form::label('address', 'Address: ', ['class' => 'col-sm-3 control-label']); ?>

                <div class="col-sm-6">
                    <?php echo Form::text('address', null, ['class' => 'form-control']); ?>

                    <?php echo $errors->first('address', '<p class="help-block">:message</p>'); ?>

                </div>
            </div>
            <div class="form-group <?php echo e($errors->has('desc') ? 'has-error' : ''); ?>">
                <?php echo Form::label('desc', 'Desc: ', ['class' => 'col-sm-3 control-label']); ?>

                <div class="col-sm-6">
                    <?php echo Form::text('desc', null, ['class' => 'form-control']); ?>

                    <?php echo $errors->first('desc', '<p class="help-block">:message</p>'); ?>

                </div>
            </div>
            <div class="form-group <?php echo e($errors->has('sid') ? 'has-error' : ''); ?>">
                <?php echo Form::label('sid', 'Sid: ', ['class' => 'col-sm-3 control-label']); ?>

                <div class="col-sm-6">
                    <?php echo Form::text('sid', null, ['class' => 'form-control']); ?>

                    <?php echo $errors->first('sid', '<p class="help-block">:message</p>'); ?>

                </div>
            </div>
            <div class="form-group <?php echo e($errors->has('revenue') ? 'has-error' : ''); ?>">
                <?php echo Form::label('revenue', 'Revenue: ', ['class' => 'col-sm-3 control-label']); ?>

                <div class="col-sm-6">
                    <?php echo Form::text('revenue', null, ['class' => 'form-control']); ?>

                    <?php echo $errors->first('revenue', '<p class="help-block">:message</p>'); ?>

                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            <?php echo Form::submit('Update', ['class' => 'btn btn-primary form-control']); ?>

        </div>
    </div>
    <?php echo Form::close(); ?>


    <?php if($errors->any()): ?>
        <ul class="alert alert-danger">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backLayout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>