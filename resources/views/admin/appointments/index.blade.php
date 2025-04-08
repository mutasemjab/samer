@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('messages.Appointments') }}</h1>
        <a href="{{ route('appointments.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> {{ __('messages.Add_New_Appointment') }}
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('messages.All_Appointments') }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="appointmentsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ __('messages.ID') }}</th>
                            <th>{{ __('messages.Patient') }}</th>
                            <th>{{ __('messages.Date_Time') }}</th>
                            <th>{{ __('messages.Status') }}</th>
                            <th>{{ __('messages.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($appointments as $appointment)
                            <tr>
                                <td>{{ $appointment->id }}</td>
                                <td>{{ $appointment->patient->name }}</td>
                                <td>{{ $appointment->appointment_datetime->format('M d, Y - h:i A') }}</td>
                                <td>
                                    @if($appointment->status == 'pending')
                                        <span class="badge badge-primary">{{ __('messages.Pending') }}</span>
                                    @elseif($appointment->status == 'completed')
                                        <span class="badge badge-success">{{ __('messages.Completed') }}</span>
                                    @elseif($appointment->status == 'cancelled')
                                        <span class="badge badge-danger">{{ __('messages.Cancelled') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('appointments.show', $appointment) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('messages.Confirm_Delete_Appointment') }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">{{ __('messages.No_Appointments_Found') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $appointments->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#appointmentsTable').DataTable({
            "paging": false,
            "ordering": true,
            "info": false
        });
    });
</script>
@endsection


