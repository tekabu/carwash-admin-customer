<form class="form-entry" enctype="multipart/form-data">
    @if (isset($row))
        <input type="hidden" name="id" value="{{ $row->id }}">
    @endif

    @php
        $uuid_soap_type = Str::uuid();
        $uuid_sub_title = Str::uuid();
        $uuid_image_url = Str::uuid();
        $uuid_amount = Str::uuid();
    @endphp
    <div class="mb-3">
        <div class="form-group">
            <label for="{{ $uuid_soap_type }}" class="form-label">Soap Type<span class="required"> *</span></label>
            <input id="{{ $uuid_soap_type }}" name="soap_type" placeholder="Soap Type" required="required" type="text"
                value="{{ $row->soap_type ?? '' }}" class="form-control">
        </div>
    </div>
    <div class="mb-3">
        <div class="form-group">
            <label for="{{ $uuid_sub_title }}" class="form-label">Sub Title</label>
            <input id="{{ $uuid_sub_title }}" name="sub_title" placeholder="Sub Title" type="text"
                value="{{ $row->sub_title ?? '' }}" class="form-control">
        </div>
    </div>
    <div class="mb-3">
        <div class="form-group">
            <label for="{{ $uuid_image_url }}" class="form-label">Image</label>
            <input id="{{ $uuid_image_url }}" name="image_url" type="file" class="form-control" accept="image/jpeg,image/png,image/jpg">
            <small class="text-muted">Allowed file types: JPEG, PNG.</small>
            @if (isset($row) && $row->image_url)
                <div class="mt-2">
                    Current image: <a href="{{ asset('storage/' . $row->image_url) }}" target="_blank" rel="noreferrer">View</a>
                </div>
            @endif
        </div>
    </div>
    <div class="mb-3">
        <div class="form-group">
            <label for="{{ $uuid_amount }}" class="form-label">Amount<span class="required"> *</span></label>
            <input id="{{ $uuid_amount }}" name="amount" placeholder="Amount" required="required" type="number" step="0.01" min="0"
                value="{{ $row->amount ?? '' }}" class="form-control">
        </div>
    </div>
</form>
