<form class="form-entry">
    @if (isset($row))
        <input type="hidden" name="id" value="{{ $row->id }}">
    @endif

    @php
        $uuid_vehicle_type = Str::uuid();
    @endphp
    <div class="mb-3">
        <div class="form-group">
            <label for="{{ $uuid_vehicle_type }}" class="form-label">Vehicle Type<span class="required"> *</span></label>
            <input id="{{ $uuid_vehicle_type }}" name="vehicle_type" placeholder="Vehicle Type" required="required" type="text"
                value="{{ $row->vehicle_type ?? '' }}" class="form-control">
        </div>
    </div>
</form>
