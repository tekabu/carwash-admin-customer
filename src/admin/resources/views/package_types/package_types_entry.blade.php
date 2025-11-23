<form class="form-entry">
    @if (isset($row))
        <input type="hidden" name="id" value="{{ $row->id }}">
    @endif

    @php
        $uuid_package_type = Str::uuid();
    @endphp
    <div class="mb-3">
        <div class="form-group">
            <label for="{{ $uuid_package_type }}" class="form-label">Package Type<span class="required"> *</span></label>
            <input id="{{ $uuid_package_type }}" name="package_type" placeholder="Package Type" required="required" type="text"
                value="{{ $row->package_type ?? '' }}" class="form-control">
        </div>
    </div>
</form>
