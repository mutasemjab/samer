

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo e(__('messages.Appointments')); ?></h1>
        <a href="<?php echo e(route('appointments.create')); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> <?php echo e(__('messages.Add_New_Appointment')); ?>

        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('messages.All_Appointments')); ?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="appointmentsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><?php echo e(__('messages.ID')); ?></th>
                            <th><?php echo e(__('messages.Patient')); ?></th>
                            <th><?php echo e(__('messages.Date_Time')); ?></th>
                            <th><?php echo e(__('messages.Status')); ?></th>
                            <th><?php echo e(__('messages.Actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($appointment->id); ?></td>
                                <td><?php echo e($appointment->patient->name); ?></td>
                                <td><?php echo e($appointment->appointment_datetime->format('M d, Y - h:i A')); ?></td>
                                <td>
                                    <?php if($appointment->status == 'pending'): ?>
                                        <span class="badge badge-primary"><?php echo e(__('messages.Pending')); ?></span>
                                    <?php elseif($appointment->status == 'completed'): ?>
                                        <span class="badge badge-success"><?php echo e(__('messages.Completed')); ?></span>
                                    <?php elseif($appointment->status == 'cancelled'): ?>
                                        <span class="badge badge-danger"><?php echo e(__('messages.Cancelled')); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('appointments.show', $appointment)); ?>" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?php echo e(route('appointments.edit', $appointment)); ?>" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="<?php echo e(route('appointments.destroy', $appointment)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('<?php echo e(__('messages.Confirm_Delete_Appointment')); ?>')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center"><?php echo e(__('messages.No_Appointments_Found')); ?></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                <?php echo e($appointments->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    $(document).ready(function() {
        $('#appointmentsTable').DataTable({
            "paging": false,
            "ordering": true,
            "info": false
        });
    });
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\samer\resources\views/admin/appointments/index.blade.php ENDPATH**/ ?>