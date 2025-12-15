@extends('layouts.app')

@section('title', 'Transaction History')
@section('breadcrumb_title', 'Transaction History')

@section('content')

<!-- history area -->
<div class="login-area py-120">
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-12">
                <div class="login-form">
                    <div class="login-header">
                        <h2>Transaction History</h2>
                        <p>View your car wash transaction history</p>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($transactions->isEmpty())
                        <div class="alert alert-info">
                            <i class="far fa-info-circle"></i> You don't have any transactions yet.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table id="transactionsTable" class="table table-striped table-hover table-bordered" style="width:100%; min-width: 900px;">
                                <thead class="table-primary"> <!-- BLUE HEADER para malinaw -->
                                    <tr>
                                        <th>Date</th>
                                        <th>Vehicle Type</th>
                                        <th>Vehicle Type Price</th>
                                        <th>Soap Type</th>
                                        <th>Soap Type Price</th>
                                        <th>Total Price</th>
                                        <th>Points Earned</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactions as $transaction)
                                        <tr>
                                            <td data-order="{{ $transaction->created_at->timestamp }}">{{ $transaction->created_at->format('M d, Y h:i A') }}</td>
                                            <td>{{ $transaction->vehicle_type_name ?? 'N/A' }}</td>
                                            <td>₱{{ number_format($transaction->vehicle_type_amount ?? 0, 2) }}</td>
                                            <td>{{ $transaction->soap_type_name ?? 'N/A' }}</td>
                                            <td>₱{{ number_format($transaction->soap_type_amount ?? 0, 2) }}</td>
                                            <td>₱{{ number_format($transaction->total_amount ?? 0, 2) }}</td>
                                            <td>{{ number_format(($transaction->new_points ?? 0) - ($transaction->current_points ?? 0), 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- history area end -->

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

<style>
    /* Mas readable ang table cells */
    #transactionsTable th, 
    #transactionsTable td {
        padding: 12px 15px;
        white-space: nowrap; /* hindi mag-wrap */
    }

    .table-responsive {
        overflow-x: auto;
    }

    #transactionsTable {
        font-size: 0.95rem;
    }

    /* DataTables search and pagination */
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #0d6efd;
    }

    .page-item.active .page-link {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
    }

    .page-link:hover {
        color: #0d6efd !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#transactionsTable').DataTable({
            order: [[0, 'desc']],
            pageLength: 10,
            language: {
                search: "Search:",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ transactions",
                infoEmpty: "Showing 0 to 0 of 0 transactions",
                infoFiltered: "(filtered from _MAX_ total transactions)",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: '<i class="far fa-chevron-right"></i>',
                    previous: '<i class="far fa-chevron-left"></i>'
                }
            }
        });
    });
</script>
@endpush
