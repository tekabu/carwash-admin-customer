@extends('layouts.app')

@section('title', 'Top Up')

@section('breadcrumb_title', 'Top Up')

@section('content')

<!-- top up area -->
<div class="login-area py-120">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="login-form">
                    <div class="login-header">
                        <h2>Top Up Balance</h2>
                        <p>Upload your proof of payment to request a manual top up.</p>
                    </div>

                    @if (empty($topUpEndpointTemplate))
                        <div class="alert alert-warning">
                            <i class="far fa-exclamation-triangle"></i> Top up service is not yet configured. Please contact support.
                        </div>
                    @elseif(!$customerId)
                        <div class="alert alert-warning">
                            <i class="far fa-exclamation-triangle"></i> We cannot locate your customer profile. Please complete your registration first.
                        </div>
                    @else
                        <form id="topUpForm" class="row g-3" enctype="multipart/form-data"
                            data-endpoint="{{ $topUpEndpoint }}">

                            <div class="col-md-6">
                                <label class="form-label">Top Up Amount</label>
                                <input type="number" name="top_up_amount" class="form-control" min="1" step="0.01" placeholder="e.g. 500.00" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Proof of Payment</label>
                                <input type="file" name="proof_of_payment" class="form-control" accept="image/*" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Remarks</label>
                                <textarea name="remarks" rows="3" class="form-control" placeholder="Bank transfer reference XYZ" required></textarea>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100">Send Top Up Request</button>
                            </div>

                            <div class="col-12">
                                <div id="topUpStatus" class="alert d-none mt-3"></div>
                            </div>
                        </form>
                    @endif

                    <hr class="my-5">

                    <div class="login-header">
                        <h2>Top Up History</h2>
                        <p>Review your submission records</p>
                    </div>

                    @if($topUps->isEmpty())
                        <div class="alert alert-info">
                            <i class="far fa-info-circle"></i> You have not submitted any top up requests yet.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table id="topUpsTable" class="table table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>ID</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Remarks</th>
                                        <th>Proof</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($topUps as $topUp)
                                        <tr>
                                            <td data-order="{{ $topUp->created_at->timestamp }}">{{ $topUp->created_at->format('M d, Y h:i A') }}</td>
                                            <td>{{ $topUp->id }}</td>
                                            <td>{{ number_format($topUp->top_up_amount, 2) }}</td>
                                            <td>{{ $topUp->status }}</td>
                                            <td>{{ $topUp->remarks ?? 'N/A' }}</td>
                                            <td>{{ $topUp->proof_of_payment ? basename($topUp->proof_of_payment) : 'N/A' }}</td>
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
<!-- top up area end -->

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#topUpsTable').DataTable({
            order: [[0, 'desc']],
            pageLength: 10,
            language: {
                search: "Search:",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "Showing 0 to 0 of 0 entries",
                infoFiltered: "(filtered from _MAX_ total entries)",
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const topUpForm = document.getElementById('topUpForm');
        const statusAlert = document.getElementById('topUpStatus');

        if (!topUpForm || !statusAlert) {
            return;
        }

        const showStatus = (message, type = 'info') => {
            statusAlert.classList.remove('d-none', 'alert-success', 'alert-danger', 'alert-info', 'alert-warning');
            statusAlert.classList.add(`alert-${type}`);
            statusAlert.textContent = message;
        };

        topUpForm.addEventListener('submit', async function (event) {
            event.preventDefault();

            const endpoint = topUpForm.dataset.endpoint;
            const amount = topUpForm.querySelector('input[name="top_up_amount"]').value;
            const remarks = topUpForm.querySelector('textarea[name="remarks"]').value;
            const proofInput = topUpForm.querySelector('input[name="proof_of_payment"]');
            const proofFile = proofInput && proofInput.files.length ? proofInput.files[0] : null;

            if (!endpoint) {
                showStatus('Top up endpoint is not configured.', 'warning');
                return;
            }

            if (!amount || parseFloat(amount) <= 0) {
                showStatus('Please enter a valid top up amount.', 'warning');
                return;
            }

            if (!proofFile) {
                showStatus('Please attach a proof of payment file.', 'warning');
                return;
            }

            const formData = new FormData();
            formData.append('top_up_amount', amount);
            formData.append('status', 'PENDING');
            formData.append('remarks', remarks || '');
            formData.append('proof_of_payment', proofFile, proofFile.name);

            try {
                const response = await fetch(endpoint, {
                    method: 'POST',
                    body: formData,
                });

                const payload = await response.text();

                if (response.ok) {
                    showStatus('Top up request submitted successfully. We will review it shortly.', 'success');
                    topUpForm.reset();
                } else {
                    showStatus(`Top up request failed (${response.status}): ${payload}`, 'danger');
                }
            } catch (error) {
                showStatus(`Top up request could not be sent: ${error.message}`, 'danger');
            }
        });
    });
</script>
@endpush
