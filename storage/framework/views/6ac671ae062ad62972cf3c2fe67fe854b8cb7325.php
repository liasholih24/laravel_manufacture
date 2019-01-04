<?php $__env->startSection('title'); ?>
Users
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>

<?php echo e(HTML::style('assets_back/css/plugins/select2/select2.min.css')); ?>

<?php echo e(HTML::style('assets_back/css/plugins/dataTables/datatables.min.css')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="wrapper wrapper-content">
	<div class="row detail_content3">

	     <div class="col-lg-12 detail_content2" style="background-color: white">
			 <style>
						.ibox { margin: 1px 2px 0px 0px !important }
						.ibox.float-e-margins{ margin: 0px 2px !important}
			 </style>
            <div class="row ibox-title">
   <ol class="breadcrumb col-sm-8 col-xs-12" style="font-size: 14px; padding-top: 6px; ">
        <li class="active">
            User
        </li>
    </ol>
    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-sm btn-outline btn-warning pull-right">
        <i class="fa fa-arrow-circle-o-left" style="margin-right: 5px"></i> Back
    </a>
    <?php if(Sentinel::getUser()->hasAccess(['user.create'])): ?>
    <a href="<?php echo e(url('user/create')); ?>"><button class="btn btn-sm btn-outline btn-info pull-right" style="margin-right: 10px">
        <i class="fa fa-plus-circle" style="margin-right: 5px"></i> Add New User
    </button>
  	</a>
    <?php endif; ?>
		<select class="select2_demo_1 form-control" style="max-width:180px;margin-right: 10px;" onchange="if (this.value) window.location.href=this.value">
			 <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<option value="<?php echo e(url('user')); ?>">Select Roles</option>
				<option value="<?php echo e(url('user/'.$role->id.'/role')); ?>" <?php if ($role->id == $id) echo ' selected="selected"'; ?>><?php echo e($role->name); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		</select>
</div>
<div class="row ibox-content" style="min-height: 65vh; ">
  <?php $__currentLoopData = ['danger', 'warning', 'success', 'info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if(Session::has('alert-' . $msg)): ?>
      <div class="alert alert-<?php echo e($msg); ?> alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    <?php echo e(Session::get('alert-' . $msg)); ?>.
      </div>
      <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<div class="col-xs-12 col-sm-12">
    <div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="editable">
  <thead>
      <tr>

        	<th>No.</th>
          <th>Name</th>
          <th>Username</th>
          <th>Roles</th>
          <th>Last Updated</th>
					<th>Updated By</th>
					<th>Status</th>
          <th>Actions</th>

      </tr>
  </thead>
  <tbody>
			<?php $x = 0 ?>
      <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php $x++?>
          <tr>
            <td><?php echo e($x); ?></td>
              <td><a href="<?php echo e(route('user.show', $user->id)); ?>"><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></a></td>
              <td><?php echo e($user->email); ?></td>
              <td><?php echo empty($user->roles()->first())?"<b>No Roles</b>":$user->roles()->first()->name; ?> </td>
							<td><?php echo e($user->created_at); ?></td>
							<td><?php echo e($user->updatedby->first_name); ?> <?php echo e($user->updatedby->last_name); ?></td>
							<td><?php if( $user->status == 3): ?>
							<a href="#" class="btn btn-xs btn-primary btn-outline active">Active</a>
							<?php elseif($user->status == 2): ?>
							<a href="#" class="btn btn-xs btn-default btn-outline">Inactive</a>
							<?php endif; ?></td>
							<td>

                  <?php if(Sentinel::getUser()->hasAccess(['user.show'])): ?>
                  <a href="<?php echo e(route('user.show', $user->id)); ?>" class="btn btn-primary btn-outline btn-xs">View</a>
                  <?php endif; ?>
                  <?php if(Sentinel::getUser()->hasAccess(['user.edit'])): ?>
                  <a href="<?php echo e(route('user.edit', $user->id)); ?>" class="btn btn-primary btn-outline btn-xs">Edit</a>
                  <?php endif; ?>
								
              </td>
          </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </tbody>

</table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>


<?php echo e(HTML::script('assets_back/js/plugins/dataTables/datatables.min.js')); ?>

<?php echo e(HTML::script('assets_back/js/plugins/select2/select2.full.min.js')); ?>


<!-- Page-Level Scripts -->
<script>
    $(document).ready(function(){


        /* Init DataTables */
        var oTable = $('#editable').DataTable(
					{
  				"columnDefs": [
    		{ "searchable": false, "targets": 7 }
  		]
		}
				);

        /* Apply the jEditable handlers to the table */



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