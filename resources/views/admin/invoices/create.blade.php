{{-- resources/views/admin/invoices/create.blade.php --}}
@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('messages.Create_New_Invoice') }}</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('messages.Invoice_Details') }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('invoices.store') }}" method="POST" id="invoiceForm">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_id">{{ __('messages.Patient') }} <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <select name="user_id" id="user_id" class="form-control select2 @error('user_id') is-invalid @enderror" required>
                                    <option value="">-- {{ __('messages.Select_Patient') }} --</option>
                                    @foreach($patients as $patient)
                                        <option value="{{ $patient->id }}" {{ old('user_id') == $patient->id ? 'selected' : '' }}>
                                            {{ $patient->name }} ({{ $patient->phone }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newPatientModal">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="appointment_id">{{ __('messages.Appointment') }}</label>
                            <div class="input-group">
                                <select name="appointment_id" id="appointment_id" class="form-control select2 @error('appointment_id') is-invalid @enderror">
                                    <option value="">-- {{ __('messages.Select_Appointment') }} --</option>
                                    @foreach($appointments as $appointment)
                                        <option value="{{ $appointment->id }}" {{ old('appointment_id') == $appointment->id ? 'selected' : '' }}>
                                            {{ $appointment->appointment_datetime->format('M d, Y - h:i A') }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newAppointmentModal">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                @error('appointment_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="invoice_date">{{ __('messages.Invoice_Date') }} <span class="text-danger">*</span></label>
                            <input type="date" name="invoice_date" id="invoice_date" class="form-control" 
                                value="{{ old('invoice_date', date('Y-m-d')) }}" required>
                            @error('invoice_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="discount">{{ __('messages.Discount') }} <span class="text-danger">*</span></label>
                            <input type="number" name="discount" id="discount" min="0" max="100" step="0.01" class="form-control @error('discount') is-invalid @enderror" 
                                value="{{ old('discount', 0) }}" required>
                            @error('discount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="payment_method">{{ __('messages.Payment_Method') }} <span class="text-danger">*</span></label>
                            <select name="payment_method" id="payment_method" class="form-control @error('payment_method') is-invalid @enderror" required>
                                <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>{{ __('messages.Cash') }}</option>
                                <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>{{ __('messages.Credit_Card') }}</option>
                                <option value="debit_card" {{ old('payment_method') == 'debit_card' ? 'selected' : '' }}>{{ __('messages.Debit_Card') }}</option>
                                <option value="insurance" {{ old('payment_method') == 'insurance' ? 'selected' : '' }}>{{ __('messages.Insurance') }}</option>
                                <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>{{ __('messages.Bank_Transfer') }}</option>
                                <option value="check" {{ old('payment_method') == 'check' ? 'selected' : '' }}>{{ __('messages.Check') }}</option>
                                <option value="other" {{ old('payment_method') == 'other' ? 'selected' : '' }}>{{ __('messages.Other') }}</option>
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
                    <textarea name="notes" id="notes" rows="3" class="form-control @error('notes') is-invalid @enderror">{{ old('notes') }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <a href="{{ route('invoices.index') }}" class="btn btn-secondary">{{ __('messages.Cancel') }}</a>
                    <button type="submit" class="btn btn-primary">{{ __('messages.Create_Invoice') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- New Patient Modal -->
<div class="modal fade" id="newPatientModal" tabindex="-1" role="dialog" aria-labelledby="newPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newPatientModalLabel">{{ __('messages.Create_New_Patient') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createPatientForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="patient_name">{{ __('messages.Name') }} <span class="text-danger">*</span></label>
                                <input type="text" id="patient_name" name="name" class="form-control" required>
                                <div class="invalid-feedback" id="name-error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="patient_phone">{{ __('messages.Phone') }} <span class="text-danger">*</span></label>
                                <input type="text" id="patient_phone" name="phone" class="form-control" required>
                                <div class="invalid-feedback" id="phone-error"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="patient_address">{{ __('messages.Address') }}</label>
                        <input type="text" id="patient_address" name="address" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="patient_password">{{ __('messages.Password') }} <span class="text-danger">*</span></label>
                        <input type="password" id="patient_password" name="password" class="form-control" required>
                        <div class="invalid-feedback" id="password-error"></div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="patient_medical_history">{{ __('messages.Medical_History') }}</label>
                                <textarea id="patient_medical_history" name="medical_history" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="patient_allergies">{{ __('messages.Allergies') }}</label>
                                <textarea id="patient_allergies" name="allergies" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.Cancel') }}</button>
                    <button type="submit" class="btn btn-primary" id="savePatientBtn">{{ __('messages.Save_Patient') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- New Appointment Modal -->
<div class="modal fade" id="newAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="newAppointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newAppointmentModalLabel">{{ __('messages.Create_New_Appointment') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createAppointmentForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="appointment_user_id">{{ __('messages.Patient') }} <span class="text-danger">*</span></label>
                        <select id="appointment_user_id" name="user_id" class="form-control select2-modal" required>
                            <option value="">-- {{ __('messages.Select_Patient') }} --</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}">
                                    {{ $patient->name }} ({{ $patient->phone }})
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="user-id-error"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="appointment_datetime">{{ __('messages.Appointment_Date_Time') }} <span class="text-danger">*</span></label>
                        <input type="datetime-local" id="appointment_datetime" name="appointment_datetime" class="form-control" required>
                        <div class="invalid-feedback" id="appointment-datetime-error"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="appointment_status">{{ __('messages.Status') }}</label>
                        <select id="appointment_status" name="status" class="form-control">
                            <option value="pending">{{ __('messages.Pending') }}</option>
                            <option value="completed">{{ __('messages.Completed') }}</option>
                            <option value="cancelled">{{ __('messages.Cancelled') }}</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="appointment_notes">{{ __('messages.Notes') }}</label>
                        <textarea id="appointment_notes" name="notes" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.Cancel') }}</button>
                    <button type="submit" class="btn btn-primary" id="saveAppointmentBtn">{{ __('messages.Save_Appointment') }}</button>
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
        // Initialize Select2
        $('.select2').select2({
            placeholder: "Search and select...",
            allowClear: true
        });
        
        // Initialize Select2 for modals
        $('.select2-modal').select2({
            placeholder: "Search and select...",
            allowClear: true,
            dropdownParent: $('.modal')
        });
        
        // Re-initialize Select2 when modal opens
        $('#newAppointmentModal').on('shown.bs.modal', function () {
            $('.select2-modal').select2({
                dropdownParent: $('#newAppointmentModal')
            });
        });
        
        // Load appointments when patient is selected
        $('#user_id').on('change', function() {
            const patientId = $(this).val();
            
            if (patientId) {
                loadAppointmentsByPatient(patientId);
            } else {
                // Clear appointment dropdown if no patient selected
                $('#appointment_id').empty().append('<option value="">-- {{ __("messages.Select_Appointment") }} --</option>').trigger('change');
            }
        });
        
        // Function to load appointments by patient
        function loadAppointmentsByPatient(patientId) {
            $.ajax({
                url: "{{ route('appointments.by.patient') }}",
                type: "GET",
                data: { user_id: patientId },
                success: function(response) {
                    // Clear previous options
                    $('#appointment_id').empty().append('<option value="">-- {{ __("messages.Select_Appointment") }} --</option>');
                    
                    // Add appointment options
                    if (response.appointments && response.appointments.length > 0) {
                        $.each(response.appointments, function(index, appointment) {
                            // Format the appointment date for display
                            const dateObj = new Date(appointment.appointment_datetime);
                            const formattedDate = dateObj.toLocaleDateString('en-US', {
                                month: 'short', 
                                day: 'numeric', 
                                year: 'numeric',
                                hour: 'numeric',
                                minute: 'numeric',
                                hour12: true
                            });
                            
                            $('#appointment_id').append(new Option(
                                formattedDate,
                                appointment.id,
                                index === 0, // Select first item (latest appointment)
                                index === 0
                            ));
                        });
                    }
                    
                    // Trigger change to refresh Select2
                    $('#appointment_id').trigger('change');
                },
                error: function() {
                    alert("{{ __('messages.Error_Loading_Appointments') }}");
                }
            });
        }
        
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
                    $(this).find('input[name^="services"]').attr('name', `services[${index}][quantity]`);
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
        
        // Create new patient
        $('#createPatientForm').on('submit', function(e) {
            e.preventDefault();
            
            // Reset error messages
            $('.invalid-feedback').text('');
            $('.is-invalid').removeClass('is-invalid');
            
            // Collect form data
            const formData = new FormData(this);
            
            // Create patient via AJAX
            $.ajax({
                url: "{{ route('users.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response && response.success && response.patient) {
                        const patient = response.patient;
                        
                        // Add new patient to the dropdown
                        const newOption = new Option(
                            `${patient.name} (${patient.phone})`, 
                            patient.id, 
                            true, 
                            true
                        );
                        
                        // Remove option if it already exists (avoid duplicates)
                        $(`#user_id option[value="${patient.id}"]`).remove();
                        
                        // Add the new option and select it
                        $('#user_id').append(newOption).trigger('change');
                        
                        // Close modal and reset form
                        $('#newPatientModal').modal('hide');
                        $('#createPatientForm')[0].reset();
                        
                        // Show success message
                        alert("{{ __('messages.Patient_Created_Successfully') }}");
                    } else {
                        alert("{{ __('messages.Error_Creating_Patient') }}");
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        
                        // Display validation errors
                        $.each(errors, function(field, messages) {
                            const inputField = $(`#patient_${field}`);
                            if (inputField.length) {
                                inputField.addClass('is-invalid');
                                $(`#${field}-error`).text(messages[0]);
                            }
                        });
                    } else {
                        alert("{{ __('messages.An_Error_Occurred') }}");
                    }
                }
            });
        });
        
        // Create new appointment
        $('#createAppointmentForm').on('submit', function(e) {
            e.preventDefault();
            
            // Reset error messages
            $('.invalid-feedback').text('');
            $('.is-invalid').removeClass('is-invalid');
            
            // Collect form data
            const formData = new FormData(this);
            
            // Create appointment via AJAX
            $.ajax({
                url: "{{ route('appointments.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response && response.success && response.appointment) {
                        const appointment = response.appointment;
                        
                        // Format datetime for display
                        const date = new Date(appointment.appointment_datetime);
                        const formattedDate = date.toLocaleDateString('en-US', {
                            month: 'short', 
                            day: 'numeric', 
                            year: 'numeric', 
                            hour: 'numeric', 
                            minute: 'numeric',
                            hour12: true
                        });
                        
                        // Add new appointment to the dropdown
                        const newOption = new Option(
                            formattedDate, 
                            appointment.id, 
                            true, 
                            true
                        );
                        
                        // Remove option if it already exists (avoid duplicates)
                        $(`#appointment_id option[value="${appointment.id}"]`).remove();
                        
                        // Add the new option and select it
                        $('#appointment_id').append(newOption).trigger('change');
                        
                        // Close modal and reset form
                        $('#newAppointmentModal').modal('hide');
                        $('#createAppointmentForm')[0].reset();
                        
                        // Show success message
                        alert("{{ __('messages.Appointment_Created_Successfully') }}");
                    } else {
                        alert("{{ __('messages.Error_Creating_Appointment') }}");
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        
                        // Display validation errors
                        $.each(errors, function(field, messages) {
                            const inputField = $(`#appointment_${field}`);
                            if (inputField.length) {
                                inputField.addClass('is-invalid');
                                $(`#${field.replace('_', '-')}-error`).text(messages[0]);
                            }
                        });
                    } else {
                        alert("{{ __('messages.An_Error_Occurred') }}");
                    }
                }
            });
        });
        
        // Auto-select the patient in appointment modal based on the current patient selection
        $('#newAppointmentModal').on('show.bs.modal', function() {
            const selectedPatientId = $('#user_id').val();
            if (selectedPatientId) {
                $('#appointment_user_id').val(selectedPatientId).trigger('change');
            }
        });
        
        // Reset forms when modals are closed
        $('.modal').on('hidden.bs.modal', function() {
            $(this).find('form').trigger('reset');
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').text('');
        });
        
        // If a patient is pre-selected (e.g., page reload with old values), load their appointments
        if ($('#user_id').val()) {
            loadAppointmentsByPatient($('#user_id').val());
        }
    });
</script>
@endsection