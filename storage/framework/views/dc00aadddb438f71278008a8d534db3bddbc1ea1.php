


<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo e(__('messages.Invoices')); ?></h1>
        <a href="<?php echo e(route('invoices.create')); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> <?php echo e(__('messages.Add_New_Invoice')); ?>

        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('messages.All_Invoices')); ?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="invoicesTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><?php echo e(__('messages.ID')); ?></th>
                            <th><?php echo e(__('messages.Patient')); ?></th>
                            <th><?php echo e(__('messages.Date')); ?></th>
                            <th><?php echo e(__('messages.Total')); ?></th>
                            <th><?php echo e(__('messages.Discount')); ?></th>
                            <th><?php echo e(__('messages.Payment_Method')); ?></th>
                            <th><?php echo e(__('messages.Actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($invoice->id); ?></td>
                                <td><?php echo e($invoice->patient->name); ?></td>
                                <td><?php echo e($invoice->invoice_date->format('M d, Y')); ?></td>
                                <td>$<?php echo e(number_format($invoice->total_amount, 2)); ?></td>
                                <td><?php echo e($invoice->discount); ?></td>
                                <td>
                                    <?php switch($invoice->payment_method):
                                        case ('cash'): ?>
                                            <span class="badge badge-success"><?php echo e(__('messages.Cash')); ?></span>
                                            <?php break; ?>
                                        <?php case ('credit_card'): ?>
                                            <span class="badge badge-info"><?php echo e(__('messages.Credit_Card')); ?></span>
                                            <?php break; ?>
                                        <?php case ('debit_card'): ?>
                                            <span class="badge badge-primary"><?php echo e(__('messages.Debit_Card')); ?></span>
                                            <?php break; ?>
                                        <?php case ('insurance'): ?>
                                            <span class="badge badge-warning"><?php echo e(__('messages.Insurance')); ?></span>
                                            <?php break; ?>
                                        <?php case ('bank_transfer'): ?>
                                            <span class="badge badge-secondary"><?php echo e(__('messages.Bank_Transfer')); ?></span>
                                            <?php break; ?>
                                        <?php case ('check'): ?>
                                            <span class="badge badge-dark"><?php echo e(__('messages.Check')); ?></span>
                                            <?php break; ?>
                                        <?php default: ?>
                                            <span class="badge badge-light"><?php echo e(__('messages.Other')); ?></span>
                                    <?php endswitch; ?>
                                </td>
                             
                                <td>
                                    <a href="<?php echo e(route('invoices.show', $invoice)); ?>" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?php echo e(route('invoices.edit', $invoice)); ?>" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="<?php echo e(route('invoices.destroy', $invoice)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('<?php echo e(__('messages.Confirm_Delete_Invoice')); ?>')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="text-center"><?php echo e(__('messages.No_Invoices_Found')); ?></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                <?php echo e($invoices->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    $(document).ready(function() {
        $('#invoicesTable').DataTable({
            "paging": false,
            "ordering": true,
            "info": false,
            "language": {
                "search": "<?php echo e(__('messages.Search')); ?>:",
                "emptyTable": "<?php echo e(__('messages.No_Invoices_Found')); ?>",
                "zeroRecords": "<?php echo e(__('messages.No_Matching_Records_Found')); ?>"
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\samer\resources\views/admin/invoices/index.blade.php ENDPATH**/ ?>