<?php $__env->startSection('title'); ?>
الرئيسية
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<style>


.dashboard {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    padding: 20px;
    background-color: #e9f7f6;
    border-radius: 10px;
}

.card {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: center;
}

.card h2 {
    font-size: 18px;
    color: #555;
    margin-bottom: 10px;
}

.card p {
    font-size: 24px;
    font-weight: bold;
    color: #333;
}

</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheaderlink'); ?>
<a href="<?php echo e(route('admin.dashboard')); ?>"> الرئيسية </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentheaderactive'); ?>
عرض
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
<div class="dashboard">
    <div class="card">
        <h2><?php echo e(__('messages.Patients')); ?></h2>
        <p><?php echo e($patientsCount); ?></p>
    </div>
    <div class="card">
        <h2><?php echo e(__('messages.Appointments')); ?></h2>
        <p><?php echo e($appointmentsCount); ?></p>
    </div>
    <div class="card">
        <h2><?php echo e(__('messages.Today_Appointments')); ?></h2>
        <p><?php echo e($appointmentsToday); ?></p>
    </div>
    <div class="card">
        <h2><?php echo e(__('messages.Appointments This Month')); ?></h2>
        <p><?php echo e($appointmentsThisMonth); ?></p>
    </div>
</div>


<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\samer\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>