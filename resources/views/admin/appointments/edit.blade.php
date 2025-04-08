
{{-- resources/views/admin/appointments/edit.blade.php --}}
@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('messages.Edit_Appointment') }} #{{ $appointment->id }}</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('messages.Appointment_Details') }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('appointments.update', $appointment) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="patient_id">{{ __('messages.Patient') }} <span class="text-danger">*</span></label>
                    <select name="user_id" id="user_id" class="form-control select2 @error('user_id') is-invalid @enderror" required>
                        <option value="">-- {{ __('messages.Select_Patient') }} --</option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}" {{ (old('user_id', $appointment->user_id) == $patient->id) ? 'selected' : '' }}>
                                {{ $patient->name }} ({{ $patient->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="appointment_date">{{ __('messages.Appointment_Date') }} <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="appointment_datetime" id="appointment_datetime" class="form-control" 
                                value="{{ old('appointment_datetime', $appointment->appointment_datetime) }}" required>
                            @error('appointment_datetime')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                  
                
                <div class="form-group">
                    <label for="status">{{ __('messages.Status') }} <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="pending" {{ (old('status', $appointment->status) == 'pending') ? 'selected' : '' }}>{{ __('messages.Pending') }}</option>
                        <option value="completed" {{ (old('status', $appointment->status) == 'completed') ? 'selected' : '' }}>{{ __('messages.Completed') }}</option>
                        <option value="cancelled" {{ (old('status', $appointment->status) == 'cancelled') ? 'selected' : '' }}>{{ __('messages.Cancelled') }}</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="notes">{{ __('messages.Notes') }}</label>
                    <textarea name="notes" id="notes" rows="3" class="form-control @error('notes') is-invalid @enderror">{{ old('notes', $appointment->notes) }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <a href="{{ route('appointments.index') }}" class="btn btn-secondary">{{ __('messages.Cancel') }}</a>
                    <button type="submit" class="btn btn-primary">{{ __('messages.Update_Appointment') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- Include Select2 CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        // Initialize Select2 for class selection
        $('.select2').select2({
            placeholder: "Search and select classes...",
            allowClear: true
        });
    });
</script>

@endsection