


<?php $__env->startSection('css'); ?>
<style>
    /* Remove any default margins/padding that might be interfering */
    html, body {
        margin: 0;
        padding: 0;
    }
    
    /* Main container for the invoice */
    .print-container {
        width: 21cm;
        min-height: 29.7cm;
        margin: 0 auto;
        background: white;
        padding: 1cm;
        font-family: Arial, sans-serif;
        box-sizing: border-box;
    }
    
    /* Screen-only styles */
    @media screen {
        .print-container {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
        }
        
        .no-print {
            display: block;
        }
    }
    
    /* Print-specific styles */
    @media print {
        /* Essential print setup for A4 */
        @page {
            size: A4 portrait;
            margin: 0;
        }
        
        html, body {
            width: 210mm;
            height: 297mm;
            background: white;
        }
        
        .print-container {
            margin: 0;
            padding: 10mm;
            width: 100%;
            height: 100%;
        }
        
        /* Hide elements not meant for printing */
        .no-print, .copyright-footer {
            display: none !important;
        }
        
        /* Hide navigation and other UI elements */
        nav, footer, .sidebar, .topbar, .action-buttons, 
        .breadcrumb, .card-header, .container-fluid > .d-sm-flex {
            display: none !important;
        }
        
        /* Ensure background colors print properly */
        * {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }
    
    /* Table formatting */
    .invoice-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }
    
    .invoice-table th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
        border-top: 1px solid #dee2e6;
        padding: 8px;
        text-align: left;
    }
    
    .invoice-table td {
        padding: 8px;
        border-bottom: 1px solid #dee2e6;
    }
    
    /* Utility classes */
    .text-center {
        text-align: center;
    }
    
    .text-right {
        text-align: right;
    }
    
    .mt-4 {
        margin-top: 1.5rem;
    }
    
    .mb-4 {
        margin-bottom: 1.5rem;
    }
    
    .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
    }
    
    .col-6 {
        flex: 0 0 50%;
        max-width: 50%;
        padding-right: 15px;
        padding-left: 15px;
    }
    
    .col-12 {
        flex: 0 0 100%;
        max-width: 100%;
        padding-right: 15px;
        padding-left: 15px;
    }
    
    /* Specific invoice styles */
    .clinic-title {
        font-size: 24px;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 0;
    }
    
    .clinic-subtitle {
        color: #7f8c8d;
        margin-top: 5px;
        margin-bottom: 5px;
    }
    
    .info-label {
        font-weight: bold;
        display: inline-block;
        min-width: 100px;
    }
    
    .info-section {
        margin-bottom: 20px;
    }
    
    .invoice-info-item {
        margin-bottom: 8px;
    }
    
    .totals-table {
        width: 300px;
        margin-left: auto;
        margin-top: 20px;
    }
    
    .totals-table td {
        padding: 5px;
    }
    
    .totals-table .total-row {
        font-weight: bold;
        border-top: 2px solid #dee2e6;
    }
    
    .signature-area {
        margin-top: 50px;
        display: flex;
        justify-content: space-between;
    }
    
    .signature-box {
        width: 45%;
        border-top: 1px solid #dee2e6;
        padding-top: 10px;
        text-align: center;
    }
    
    .invoice-footer {
        margin-top: 50px;
        text-align: center;
        border-top: 1px solid #eee;
        padding-top: 20px;
    }
    
    .small-text {
        font-size: 80%;
        color: #6c757d;
    }
    
    .payment-badge {
        display: inline-block;
        padding: 3px 8px;
        background-color: #e3f2fd;
        color: #1565c0;
        border-radius: 4px;
        font-weight: bold;
    }
    
    .alert-info {
        background-color: #d1ecf1;
        border: 1px solid #bee5eb;
        color: #0c5460;
        padding: 10px;
        border-radius: 4px;
        margin-bottom: 20px;
    }
    
    .section-title {
        border-bottom: 1px solid #eee;
        padding-bottom: 5px;
        margin-bottom: 15px;
        font-weight: bold;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <!-- Action buttons (visible only on screen) -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 no-print">
        <h1 class="h3 mb-0 text-gray-800">Invoice Details</h1>
        <div class="action-buttons">
            <a href="<?php echo e(route('invoices.edit', $invoice->id)); ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
            <button onclick="window.print()" class="btn btn-info btn-sm">
                <i class="fas fa-print"></i> Print
            </button>
            <a href="<?php echo e(route('invoices.index')); ?>" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <!-- Printable invoice container -->
    <div class="print-container">
        <!-- Clinic Information -->
        <div class="text-center mb-4">
            <h2 class="clinic-title">Dr.Samer Al-shami</h2>
            <p class="clinic-subtitle">Dental Clinic</p>
            <p>
                Marka<br>
                Phone: 0795970357
            </p>
        </div>
        
        <!-- Invoice and Patient Information -->
        <div class="row">
            <!-- Patient Info -->
            <div class="col-6">
                <div class="info-section">
                    <h5 class="section-title">Patient Information</h5>
                    <div class="invoice-info-item">
                        <span class="info-label">Name:</span>
                        <span><?php echo e($invoice->patient->name); ?></span>
                    </div>
                    <div class="invoice-info-item">
                        <span class="info-label">Phone:</span>
                        <span><?php echo e($invoice->patient->phone); ?></span>
                    </div>
                
                    <?php if($invoice->patient->address): ?>
                    <div class="invoice-info-item">
                        <span class="info-label">Address:</span>
                        <span><?php echo e($invoice->patient->address); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Invoice Info -->
            <div class="col-6">
                <div class="info-section">
                    <div class="invoice-info-item">
                        <span class="info-label">Invoice No:</span>
                        <span><?php echo e($invoice->number); ?></span>
                    </div>
                    <div class="invoice-info-item">
                        <span class="info-label">Date:</span>
                        <span><?php echo e($invoice->invoice_date->format('M d, Y')); ?></span>
                    </div>
                    <div class="invoice-info-item">
                        <span class="info-label">Status:</span>
                        <span class="payment-badge"><?php echo e(ucfirst($invoice->status)); ?></span>
                    </div>
                    <div class="invoice-info-item">
                        <span class="info-label">Payment:</span>
                        <span><?php echo e(ucfirst($invoice->payment_method)); ?></span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Appointment Information (if available) -->
        <?php if($invoice->appointment): ?>
        <div class="alert-info">
            <strong>Appointment:</strong> 
            <?php echo e($invoice->appointment->appointment_datetime->format('M d, Y - h:i A')); ?>

            <?php if($invoice->appointment->doctor): ?>
                | <strong>Doctor:</strong> <?php echo e($invoice->appointment->doctor->name); ?>

            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <!-- Services Table -->
        <table class="invoice-table">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="45%">Service</th>
                    <th width="15%" class="text-right">Price</th>
                    <th width="15%" class="text-center">Quantity</th>
                    <th width="20%" class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $invoice->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($index + 1); ?></td>
                    <td>
                        <strong><?php echo e($item->service->name); ?></strong>
                        <?php if($item->service->description): ?>
                            <br><small class="small-text"><?php echo e($item->service->description); ?></small>
                        <?php endif; ?>
                    </td>
                    <td class="text-right">JD<?php echo e(number_format($item->price, 2)); ?></td>
                    <td class="text-center"><?php echo e($item->quantity); ?></td>
                    <td class="text-right">JD<?php echo e(number_format($item->price * $item->quantity, 2)); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        
        <!-- Totals Section -->
        <table class="totals-table">
            <tr>
                <td width="60%">Subtotal:</td>
                <td width="40%" class="text-right">JD<?php echo e(number_format($invoice->total_amount, 2)); ?></td>
            </tr>
            <?php if($invoice->discount > 0): ?>
            <tr>
                <td>Discount:</td>
                <td class="text-right">JD<?php echo e(number_format($invoice->discount, 2)); ?></td>
            </tr>
            <?php endif; ?>
            <tr class="total-row">
                <td>Total:</td>
                <td class="text-right">JD<?php echo e(number_format($invoice->total_amount - $invoice->discount , 2)); ?></td>
            </tr>
        </table>
        
        <!-- Notes -->
        <?php if($invoice->notes): ?>
        <div class="mt-4">
            <strong>Notes:</strong><br>
            <?php echo e($invoice->notes); ?>

        </div>
        <?php endif; ?>
    
        
        <!-- Footer -->
        <div class="invoice-footer">
            <p>Thank You For Your Business</p>
            <p class="small-text">This Invoice Was Generated Automatically</p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\samer\resources\views/admin/invoices/show.blade.php ENDPATH**/ ?>