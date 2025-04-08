{{-- resources/views/admin/invoices/edit.blade.php --}}
@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('messages.Edit_Invoice') }}</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('messages.Invoice_Details') }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('invoices.update', $invoice->id) }}" method="POST" id="invoiceForm">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_id">{{ __('messages.Patient') }} <span class="text-danger">*</span></label>
                            <select name="user_id" id="user_id" class="form-control select2 @error('user_id') is-invalid @enderror" required>
                                <option value="">-- {{ __('messages.Select_Patient') }} --</option>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}" {{ (old('user_id', $invoice->user_id) == $patient->id) ? 'selected' : '' }}>
                                        {{ $patient->name }} ({{ $patient->phone }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="appointment_id">{{ __('messages.Appointment') }}</label>
                            <select name="appointment_id" id="appointment_id" class="form-control select2 @error('appointment_id') is-invalid @enderror">
                                <option value="">-- {{ __('messages.Select_Appointment') }} --</option>
                                @foreach($appointments as $appointment)
                                    <option value="{{ $appointment->id }}" {{ (old('appointment_id', $invoice->appointment_id) == $appointment->id) ? 'selected' : '' }}>
                                        {{ $appointment->appointment_datetime->format('M d, Y - h:i A') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('appointment_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="invoice_date">{{ __('messages.Invoice_Date') }} <span class="text-danger">*</span></label>
                            <input type="date" name="invoice_date" id="invoice_date" class="form-control" 
                                value="{{ old('invoice_date', $invoice->invoice_date->format('Y-m-d')) }}" required>
                            @error('invoice_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="discount">{{ __('messages.Discount') }} <span class="text-danger">*</span></label>
                            <input type="number" name="discount" id="discount" min="0" max="100" step="0.01" class="form-control @error('discount') is-invalid @enderror" 
                                value="{{ old('discount', $invoice->discount) }}" required>
                            @error('discount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="payment_method">{{ __('messages.Payment_Method') }} <span class="text-danger">*</span></label>
                            <select name="payment_method" id="payment_method" class="form-control @error('payment_method') is-invalid @enderror" required>
                                <option value="cash" {{ old('payment_method', $invoice->payment_method) == 'cash' ? 'selected' : '' }}>{{ __('messages.Cash') }}</option>
                                <option value="credit_card" {{ old('payment_method', $invoice->payment_method) == 'credit_card' ? 'selected' : '' }}>{{ __('messages.Credit_Card') }}</option>
                                <option value="debit_card" {{ old('payment_method', $invoice->payment_method) == 'debit_card' ? 'selected' : '' }}>{{ __('messages.Debit_Card') }}</option>
                                <option value="insurance" {{ old('payment_method', $invoice->payment_method) == 'insurance' ? 'selected' : '' }}>{{ __('messages.Insurance') }}</option>
                                <option value="bank_transfer" {{ old('payment_method', $invoice->payment_method) == 'bank_transfer' ? 'selected' : '' }}>{{ __('messages.Bank_Transfer') }}</option>
                                <option value="check" {{ old('payment_method', $invoice->payment_method) == 'check' ? 'selected' : '' }}>{{ __('messages.Check') }}</option>
                                <option value="other" {{ old('payment_method', $invoice->payment_method) == 'other' ? 'selected' : '' }}>{{ __('messages.Other') }}</option>
                            </select>
                            @error('payment_method')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('messages.Services') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="services-container">
                            @if(old('services'))
                                @foreach(old('services') as $index => $item)
                                    <div class="service-item row mb-3">
                                        <div class="col-md-5">
                                            <select name="services[{{ $index }}][service_id]" class="form-control service-select @error('services.'.$index.'.service_id') is-invalid @enderror" required>
                                                <option value="">-- {{ __('messages.Select_Service') }} --</option>
                                                @foreach($services as $service)
                                                    <option value="{{ $service->id }}" data-price="{{ $service->price }}" {{ $item['service_id'] == $service->id ? 'selected' : '' }}>
                                                        {{ $service->name }} - {{ number_format($service->price, 2) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('services.'.$index.'.service_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" name="services[{{ $index }}][quantity]" class="form-control quantity-input @error('services.'.$index.'.quantity') is-invalid @enderror" 
                                                placeholder="{{ __('messages.Quantity') }}" min="1" value="{{ $item['quantity'] }}" required>
                                            @error('services.'.$index.'.quantity')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
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
                                @endforeach
                            @elseif($invoice->services)
                                @foreach($invoice->services as $index => $invoiceService)
                                    <div class="service-item row mb-3">
                                        <div class="col-md-5">
                                            <select name="services[{{ $index }}][service_id]" class="form-control service-select" required>
                                                <option value="">-- {{ __('messages.Select_Service') }} --</option>
                                                @foreach($services as $service)
                                                    <option value="{{ $service->id }}" data-price="{{ $service->price }}" {{ $invoiceService->service_id == $service->id ? 'selected' : '' }}>
                                                        {{ $service->name }} - JD{{ number_format($service->price, 2) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="services[{{ $index }}][invoice_service_id]" value="{{ $invoiceService->id }}">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" name="services[{{ $index }}][quantity]" class="form-control quantity-input" 
                                                placeholder="{{ __('messages.Quantity') }}" min="1" value="{{ $invoiceService->quantity }}" required>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">JD</span>
                                                </div>
                                                <input type="text" class="form-control subtotal-display" value="{{ number_format($invoiceService->service->price * $invoiceService->quantity, 2) }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-danger remove-service">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="service-item row mb-3">
                                    <div class="col-md-5">
                                        <select name="services[0][service_id]" class="form-control service-select" required>
                                            <option value="">-- {{ __('messages.Select_Service') }} --</option>
                                            @foreach($services as $service)
                                                <option value="{{ $service->id }}" data-price="{{ $service->price }}">
                                                    {{ $service->name }} - JD{{ number_format($service->price, 2) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" name="services[0][quantity]" class="form-control quantity-input" 
                                            placeholder="{{ __('messages.Quantity') }}" min="1" value="1" required>
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
                            @endif
                        </div>
                        
                        <button type="button" class="btn btn-success mt-3" id="addService">
                            <i class="fas fa-plus"></i> {{ __('messages.Add_Service') }}
                        </button>
                        
                        <div class="row mt-4">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>{{ __('messages.Subtotal') }}:</th>
                                            <td class="text-right">JD<span id="subtotal">0.00</span></td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('messages.Discount') }}:</th>
                                            <td class="text-right">-JD<span id="discountAmount">0.00</span></td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('messages.Total') }}:</th>
                                            <td class="text-right"><strong>JD<span id="total">0.00</span></strong></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="notes">{{ __('messages.Notes') }}</label>
                    <textarea name="notes" id="notes" rows="3" class="form-control @error('notes') is-invalid @enderror">{{ old('notes', $invoice->notes) }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">{{ __('messages.Status') }}</label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="paid" {{ old('status', $invoice->status) == 'paid' ? 'selected' : '' }}>{{ __('messages.Paid') }}</option>
                        <option value="unpaid" {{ old('status', $invoice->status) == 'unpaid' ? 'selected' : '' }}>{{ __('messages.Unpaid') }}</option>
                        <option value="partial" {{ old('status', $invoice->status) == 'partial' ? 'selected' : '' }}>{{ __('messages.Partial') }}</option>
                        <option value="cancelled" {{ old('status', $invoice->status) == 'cancelled' ? 'selected' : '' }}>{{ __('messages.Cancelled') }}</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <a href="{{ route('invoices.index') }}" class="btn btn-secondary">{{ __('messages.Cancel') }}</a>
                    <button type="submit" class="btn btn-primary">{{ __('messages.Update_Invoice') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
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
                            <option value="">-- {{ __('messages.Select_Service') }} --</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}" data-price="{{ $service->price }}">
                                    {{ $service->name }} - JD{{ number_format($service->price, 2) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="services[${index}][quantity]" class="form-control quantity-input" 
                            placeholder="{{ __('messages.Quantity') }}" min="1" value="1" required>
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
                alert("{{ __('messages.At_Least_One_Service_Required') }}");
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
                alert("{{ __('messages.At_Least_One_Service_Required') }}");
            }
        });

        // On page load, trigger change on all service rows to calculate subtotals
        $('.service-select').trigger('change');
    });
</script>
@endsection