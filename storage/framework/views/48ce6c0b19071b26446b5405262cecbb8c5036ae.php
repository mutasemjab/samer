


<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo e(__('messages.Edit_Invoice')); ?></h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('messages.Invoice_Details')); ?></h6>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('invoices.update', $invoice->id)); ?>" method="POST" id="invoiceForm">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_id"><?php echo e(__('messages.Patient')); ?> <span class="text-danger">*</span></label>
                            <select name="user_id" id="user_id" class="form-control select2 <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="">-- <?php echo e(__('messages.Select_Patient')); ?> --</option>
                                <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($patient->id); ?>" <?php echo e((old('user_id', $invoice->user_id) == $patient->id) ? 'selected' : ''); ?>>
                                        <?php echo e($patient->name); ?> (<?php echo e($patient->phone); ?>)
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="appointment_id"><?php echo e(__('messages.Appointment')); ?></label>
                            <select name="appointment_id" id="appointment_id" class="form-control select2 <?php $__errorArgs = ['appointment_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="">-- <?php echo e(__('messages.Select_Appointment')); ?> --</option>
                                <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($appointment->id); ?>" <?php echo e((old('appointment_id', $invoice->appointment_id) == $appointment->id) ? 'selected' : ''); ?>>
                                        <?php echo e($appointment->appointment_datetime->format('M d, Y - h:i A')); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['appointment_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="invoice_date"><?php echo e(__('messages.Invoice_Date')); ?> <span class="text-danger">*</span></label>
                            <input type="date" name="invoice_date" id="invoice_date" class="form-control" 
                                value="<?php echo e(old('invoice_date', $invoice->invoice_date->format('Y-m-d'))); ?>" required>
                            <?php $__errorArgs = ['invoice_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="discount"><?php echo e(__('messages.Discount')); ?> <span class="text-danger">*</span></label>
                            <input type="number" name="discount" id="discount" min="0" max="100" step="0.01" class="form-control <?php $__errorArgs = ['discount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                value="<?php echo e(old('discount', $invoice->discount)); ?>" required>
                            <?php $__errorArgs = ['discount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="payment_method"><?php echo e(__('messages.Payment_Method')); ?> <span class="text-danger">*</span></label>
                            <select name="payment_method" id="payment_method" class="form-control <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="cash" <?php echo e(old('payment_method', $invoice->payment_method) == 'cash' ? 'selected' : ''); ?>><?php echo e(__('messages.Cash')); ?></option>
                                <option value="credit_card" <?php echo e(old('payment_method', $invoice->payment_method) == 'credit_card' ? 'selected' : ''); ?>><?php echo e(__('messages.Credit_Card')); ?></option>
                                <option value="debit_card" <?php echo e(old('payment_method', $invoice->payment_method) == 'debit_card' ? 'selected' : ''); ?>><?php echo e(__('messages.Debit_Card')); ?></option>
                                <option value="insurance" <?php echo e(old('payment_method', $invoice->payment_method) == 'insurance' ? 'selected' : ''); ?>><?php echo e(__('messages.Insurance')); ?></option>
                                <option value="bank_transfer" <?php echo e(old('payment_method', $invoice->payment_method) == 'bank_transfer' ? 'selected' : ''); ?>><?php echo e(__('messages.Bank_Transfer')); ?></option>
                                <option value="check" <?php echo e(old('payment_method', $invoice->payment_method) == 'check' ? 'selected' : ''); ?>><?php echo e(__('messages.Check')); ?></option>
                                <option value="other" <?php echo e(old('payment_method', $invoice->payment_method) == 'other' ? 'selected' : ''); ?>><?php echo e(__('messages.Other')); ?></option>
                            </select>
                            <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>
                
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo e(__('messages.Services')); ?></h6>
                    </div>
                    <div class="card-body">
                        <div class="services-container">
                            <?php if(old('services')): ?>
                                <?php $__currentLoopData = old('services'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="service-item row mb-3">
                                        <div class="col-md-5">
                                            <select name="services[<?php echo e($index); ?>][service_id]" class="form-control service-select <?php $__errorArgs = ['services.'.$index.'.service_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                                <option value="">-- <?php echo e(__('messages.Select_Service')); ?> --</option>
                                                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($service->id); ?>" data-price="<?php echo e($service->price); ?>" <?php echo e($item['service_id'] == $service->id ? 'selected' : ''); ?>>
                                                        <?php echo e($service->name); ?> - <?php echo e(number_format($service->price, 2)); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['services.'.$index.'.service_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" name="services[<?php echo e($index); ?>][quantity]" class="form-control quantity-input <?php $__errorArgs = ['services.'.$index.'.quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                                placeholder="<?php echo e(__('messages.Quantity')); ?>" min="1" value="<?php echo e($item['quantity']); ?>" required>
                                            <?php $__errorArgs = ['services.'.$index.'.quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input type="text" class="form-control subtotal-display" value="0.00" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-danger remove-service">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php elseif($invoice->services): ?>
                                <?php $__currentLoopData = $invoice->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $invoiceService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="service-item row mb-3">
                                        <div class="col-md-5">
                                            <select name="services[<?php echo e($index); ?>][service_id]" class="form-control service-select" required>
                                                <option value="">-- <?php echo e(__('messages.Select_Service')); ?> --</option>
                                                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($service->id); ?>" data-price="<?php echo e($service->price); ?>" <?php echo e($invoiceService->service_id == $service->id ? 'selected' : ''); ?>>
                                                        <?php echo e($service->name); ?> - JD<?php echo e(number_format($service->price, 2)); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <input type="hidden" name="services[<?php echo e($index); ?>][invoice_service_id]" value="<?php echo e($invoiceService->id); ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" name="services[<?php echo e($index); ?>][quantity]" class="form-control quantity-input" 
                                                placeholder="<?php echo e(__('messages.Quantity')); ?>" min="1" value="<?php echo e($invoiceService->quantity); ?>" required>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">JD</span>
                                                </div>
                                                <input type="text" class="form-control subtotal-display" value="<?php echo e(number_format($invoiceService->service->price * $invoiceService->quantity, 2)); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-danger remove-service">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div class="service-item row mb-3">
                                    <div class="col-md-5">
                                        <select name="services[0][service_id]" class="form-control service-select" required>
                                            <option value="">-- <?php echo e(__('messages.Select_Service')); ?> --</option>
                                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($service->id); ?>" data-price="<?php echo e($service->price); ?>">
                                                    <?php echo e($service->name); ?> - JD<?php echo e(number_format($service->price, 2)); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" name="services[0][quantity]" class="form-control quantity-input" 
                                            placeholder="<?php echo e(__('messages.Quantity')); ?>" min="1" value="1" required>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">JD</span>
                                            </div>
                                            <input type="text" class="form-control subtotal-display" value="0.00" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger remove-service">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <button type="button" class="btn btn-success mt-3" id="addService">
                            <i class="fas fa-plus"></i> <?php echo e(__('messages.Add_Service')); ?>

                        </button>
                        
                        <div class="row mt-4">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th><?php echo e(__('messages.Subtotal')); ?>:</th>
                                            <td class="text-right">JD<span id="subtotal">0.00</span></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo e(__('messages.Discount')); ?>:</th>
                                            <td class="text-right">-JD<span id="discountAmount">0.00</span></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo e(__('messages.Total')); ?>:</th>
                                            <td class="text-right"><strong>JD<span id="total">0.00</span></strong></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="notes"><?php echo e(__('messages.Notes')); ?></label>
                    <textarea name="notes" id="notes" rows="3" class="form-control <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('notes', $invoice->notes)); ?></textarea>
                    <?php $__errorArgs = ['notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="status"><?php echo e(__('messages.Status')); ?></label>
                    <select name="status" id="status" class="form-control <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <option value="paid" <?php echo e(old('status', $invoice->status) == 'paid' ? 'selected' : ''); ?>><?php echo e(__('messages.Paid')); ?></option>
                        <option value="unpaid" <?php echo e(old('status', $invoice->status) == 'unpaid' ? 'selected' : ''); ?>><?php echo e(__('messages.Unpaid')); ?></option>
                        <option value="partial" <?php echo e(old('status', $invoice->status) == 'partial' ? 'selected' : ''); ?>><?php echo e(__('messages.Partial')); ?></option>
                        <option value="cancelled" <?php echo e(old('status', $invoice->status) == 'cancelled' ? 'selected' : ''); ?>><?php echo e(__('messages.Cancelled')); ?></option>
                    </select>
                    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <div class="form-group">
                    <a href="<?php echo e(route('invoices.index')); ?>" class="btn btn-secondary"><?php echo e(__('messages.Cancel')); ?></a>
                    <button type="submit" class="btn btn-primary"><?php echo e(__('messages.Update_Invoice')); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {

        $('.select2').select2({
            placeholder: "Search and select classes...",
            allowClear: true
        });
        
        // Service template
        function getServiceTemplate(index) {
            return `
                <div class="service-item row mb-3">
                    <div class="col-md-5">
                        <select name="services[${index}][service_id]" class="form-control service-select" required>
                            <option value="">-- <?php echo e(__('messages.Select_Service')); ?> --</option>
                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($service->id); ?>" data-price="<?php echo e($service->price); ?>">
                                    <?php echo e($service->name); ?> - JD<?php echo e(number_format($service->price, 2)); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="services[${index}][quantity]" class="form-control quantity-input" 
                            placeholder="<?php echo e(__('messages.Quantity')); ?>" min="1" value="1" required>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">JD</span>
                            </div>
                            <input type="text" class="form-control subtotal-display" value="0.00" readonly>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger remove-service">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            `;
        }
        
        // Add service
        $('#addService').on('click', function() {
            const index = $('.service-item').length;
            $('.services-container').append(getServiceTemplate(index));
            calculateTotals();
        });
        
        // Remove service
        $(document).on('click', '.remove-service', function() {
            if ($('.service-item').length > 1) {
                $(this).closest('.service-item').remove();
                // Renumber the services
                $('.service-item').each(function(index) {
                    $(this).find('select[name^="services"]').attr('name', `services[${index}][service_id]`);
                    $(this).find('input[name^="services"][name$="[quantity]"]').attr('name', `services[${index}][quantity]`);
                    const invoiceServiceId = $(this).find('input[name$="[invoice_service_id]"]');
                    if (invoiceServiceId.length > 0) {
                        invoiceServiceId.attr('name', `services[${index}][invoice_service_id]`);
                    }
                });
                calculateTotals();
            } else {
                alert("<?php echo e(__('messages.At_Least_One_Service_Required')); ?>");
            }
        });
        
        // Calculate subtotal when service or quantity changes
        $(document).on('change', '.service-select, .quantity-input', function() {
            const row = $(this).closest('.service-item');
            const serviceSelect = row.find('.service-select');
            const quantityInput = row.find('.quantity-input');
            const subtotalDisplay = row.find('.subtotal-display');
            
            if (serviceSelect.val() && quantityInput.val()) {
                const price = parseFloat(serviceSelect.find('option:selected').data('price'));
                const quantity = parseInt(quantityInput.val());
                const subtotal = price * quantity;
                subtotalDisplay.val(subtotal.toFixed(2));
            } else {
                subtotalDisplay.val('0.00');
            }
            
            calculateTotals();
        });
        
        // Calculate discount when discount changes
        $('#discount').on('input', function() {
            calculateTotals();
        });
        
        // Calculate totals
        function calculateTotals() {
            let subtotal = 0;
            
            // Sum all service subtotals
            $('.subtotal-display').each(function() {
                subtotal += parseFloat($(this).val() || 0);
            });
            
            // Calculate discount
            const discountPercent = parseFloat($('#discount').val() || 0);
            const discountAmount = discountPercent;
            const total = subtotal - discountAmount;
            
            // Update the display
            $('#subtotal').text(subtotal.toFixed(2));
            $('#discountPercent').text(discountPercent.toFixed(2));
            $('#discountAmount').text(discountAmount.toFixed(2));
            $('#total').text(total.toFixed(2));
        }
        
        // Initial calculation
        calculateTotals();
        
        // Form submission validation
        $('#invoiceForm').on('submit', function(e) {
            if ($('.service-item').length === 0) {
                e.preventDefault();
                alert("<?php echo e(__('messages.At_Least_One_Service_Required')); ?>");
            }
        });

        // On page load, trigger change on all service rows to calculate subtotals
        $('.service-select').trigger('change');
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\samer\resources\views/admin/invoices/edit.blade.php ENDPATH**/ ?>