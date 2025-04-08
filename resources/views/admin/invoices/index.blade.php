{{-- resources/views/admin/invoices/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('messages.Invoices') }}</h1>
        <a href="{{ route('invoices.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> {{ __('messages.Add_New_Invoice') }}
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('messages.All_Invoices') }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="invoicesTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ __('messages.ID') }}</th>
                            <th>{{ __('messages.Patient') }}</th>
                            <th>{{ __('messages.Date') }}</th>
                            <th>{{ __('messages.Total') }}</th>
                            <th>{{ __('messages.Discount') }}</th>
                            <th>{{ __('messages.Payment_Method') }}</th>
                            <th>{{ __('messages.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->id }}</td>
                                <td>{{ $invoice->patient->name }}</td>
                                <td>{{ $invoice->invoice_date->format('M d, Y') }}</td>
                                <td>${{ number_format($invoice->total_amount, 2) }}</td>
                                <td>{{ $invoice->discount }}</td>
                                <td>
                                    @switch($invoice->payment_method)
                                        @case('cash')
                                            <span class="badge badge-success">{{ __('messages.Cash') }}</span>
                                            @break
                                        @case('credit_card')
                                            <span class="badge badge-info">{{ __('messages.Credit_Card') }}</span>
                                            @break
                                        @case('debit_card')
                                            <span class="badge badge-primary">{{ __('messages.Debit_Card') }}</span>
                                            @break
                                        @case('insurance')
                                            <span class="badge badge-warning">{{ __('messages.Insurance') }}</span>
                                            @break
                                        @case('bank_transfer')
                                            <span class="badge badge-secondary">{{ __('messages.Bank_Transfer') }}</span>
                                            @break
                                        @case('check')
                                            <span class="badge badge-dark">{{ __('messages.Check') }}</span>
                                            @break
                                        @default
                                            <span class="badge badge-light">{{ __('messages.Other') }}</span>
                                    @endswitch
                                </td>
                             
                                <td>
                                    <a href="{{ route('invoices.show', $invoice) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('invoices.edit', $invoice) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('messages.Confirm_Delete_Invoice') }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">{{ __('messages.No_Invoices_Found') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $invoices->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#invoicesTable').DataTable({
            "paging": false,
            "ordering": true,
            "info": false,
            "language": {
                "search": "{{ __('messages.Search') }}:",
                "emptyTable": "{{ __('messages.No_Invoices_Found') }}",
                "zeroRecords": "{{ __('messages.No_Matching_Records_Found') }}"
            }
        });
    });
</script>
@endsection

