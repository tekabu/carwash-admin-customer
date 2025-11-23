<form class="form-add-balance">
    <input type="hidden" name="customer_id" value="{{ $row->id }}">

    @php
        $uuid_amount = Str::uuid();
    @endphp
    <div class="mb-3">
        <div class="form-group">
            <label for="{{ $uuid_amount }}" class="form-label">Amount<span class="required"> *</span></label>
            <input id="{{ $uuid_amount }}" name="amount" placeholder="Enter amount (negative to subtract)" required="required" type="number" step="0.01"
                value="" class="form-control">
            <small class="form-text text-muted">Enter a positive amount to add or negative amount to subtract from balance</small>
        </div>
    </div>

    <div class="mb-3">
        <div class="alert alert-info">
            <strong>Current Balance:</strong> {{ number_format($row->balance ?? 0, 2) }}
        </div>
    </div>
</form>
