<form class="form-entry" enctype="multipart/form-data">
    @if (isset($row))
        <input type="hidden" name="id" value="{{ $row->id }}">
    @endif

    @php
        $uuid_customer = Str::uuid();
    @endphp
    <div class="mb-3">
        <div class="form-group">
            <label for="{{ $uuid_customer }}" class="form-label">Customer<span class="required"> *</span></label>
            <select id="{{ $uuid_customer }}" name="customer_id" class="form-select" required="required">
                <option value="">Select a customer</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}" @selected(isset($row) && $row->customer_id == $customer->id)>{{ $customer->name }} ({{ $customer->email }})</option>
                @endforeach
            </select>
        </div>
    </div>

    @php
        $uuid_proof = Str::uuid();
    @endphp
    <div class="mb-3">
        <div class="form-group">
            <label for="{{ $uuid_proof }}" class="form-label">Proof of Payment<span class="required"> *</span></label>
            <input id="{{ $uuid_proof }}" name="proof_of_payment" type="file" class="form-control" {{ isset($row) ? '' : 'required="required"' }}>
            <small class="text-muted">Allowed file types: JPEG, PNG, PDF.</small>
            @if (isset($row) && $row->proof_of_payment_url)
                <div class="mt-2">
                    Current attachment: <a href="{{ $row->proof_of_payment_url }}" target="_blank" rel="noreferrer">View</a>
                </div>
            @endif
        </div>
    </div>

    @php
        $uuid_status = Str::uuid();
        $statusOptions = ['Pending', 'Approved', 'Disapproved'];
    @endphp
    <div class="mb-3">
        <div class="form-group">
            <label for="{{ $uuid_status }}" class="form-label">Status<span class="required"> *</span></label>
            <select id="{{ $uuid_status }}" name="status" class="form-select" required="required">
                @foreach ($statusOptions as $status)
                    <option value="{{ $status }}" @selected((isset($row) && $row->status === $status) || (!isset($row) && $status === 'Pending'))>{{ $status }}</option>
                @endforeach
            </select>
        </div>
    </div>

    @php
        $uuid_remarks = Str::uuid();
    @endphp
    <div class="mb-3">
        <div class="form-group">
            <label for="{{ $uuid_remarks }}" class="form-label">Remarks</label>
            <textarea id="{{ $uuid_remarks }}" name="remarks" placeholder="Notes or comments" class="form-control">{{ $row->remarks ?? '' }}</textarea>
        </div>
    </div>
</form>
