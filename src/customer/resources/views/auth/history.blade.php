@extends('layouts.app')

@section('title', 'Transaction History')

@section('breadcrumb_title', 'Transaction History')

@section('content')

<!-- history area -->
<div class="login-area py-120">
    <div class="container">
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
                            <table id="transactionsTable" class="table table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Vehicle Type</th>
                                        <th>Vehicle Type Price</th>
                                        <th>Soap Type</th>
                                        <th>Soap Type Price</th>
                                        <th>Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactions as $transaction)
                                        <tr>
                                            <td data-order="{{ $transaction->created_at->timestamp }}">{{ $transaction->created_at->format('M d, Y h:i A') }}</td>
                                            <td>{{ $transaction->vehicle_type_name ?? 'N/A' }}</td>
                                            <td>{{ $transaction->vehicle_type_amount ?? 'N/A' }}</td>
                                            <td>{{ $transaction->soap_type_name ?? 'N/A' }}</td>
                                            <td>{{ $transaction->soap_type_amount ?? 'N/A' }}</td>
                                            <td>{{ $transaction->total_amount ?? 'N/A' }}</td>
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
