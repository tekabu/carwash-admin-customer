<form class="form-entry">
    @if (isset($row))
        <input type="hidden" name="id" value="{{ $row->id }}">
    @endif

    <!-- name of customer -->

    @php
        $uuid_name = Str::uuid();
    @endphp
    <div class="mb-3">
        <div class="form-group">
            <label for="{{ $uuid_name }}" class="form-label">Name<span class="required"> *</span></label>
            <input id="{{ $uuid_name }}" name="name" placeholder="Full Name" required="required" type="text"
                value="{{ $row->name ?? '' }}" class="form-control">
        </div>
    </div>

   
<!-- Email field -->

    @php
        $uuid_email = Str::uuid();
    @endphp
    <div class="mb-3">
        <div class="form-group">
            <label for="{{ $uuid_email }}" class="form-label">Email<span class="required"> *</span></label>
            <input id="{{ $uuid_email }}" name="email" placeholder="Email Address" required="required" type="email"
                value="{{ $row->email ?? '' }}" class="form-control">
        </div>
    </div>


    @unless(isset($row))
    <!-- Password Field -->
    @php
        $uuid_password = Str::uuid();
    @endphp
    <div class="mb-3">
        <div class="form-group">
            <label for="{{ $uuid_password }}" class="form-label">
                Password<span class="required"> *</span>
            </label>
            <input
                id="{{ $uuid_password }}"
                name="password"
                placeholder="Password"
                type="password"
                required
                class="form-control"
            >
        </div>
    </div>

    <!-- Confirm Password Field -->
        @php
            $uuid_password_confirmation = Str::uuid();
        @endphp
        <div class="mb-3">
            <div class="form-group">
                <label for="{{ $uuid_password_confirmation }}" class="form-label">
                    Confirm Password<span class="required"> *</span>
                </label>
                <input
                    id="{{ $uuid_password_confirmation }}"
                    name="password_confirmation"
                    placeholder="Confirm Password"
                    type="password"
                    required
                    class="form-control"
                >
            </div>
        </div>
        @endunless



    <!-- Phone number field -->


    @php
        $uuid_phone = Str::uuid();
    @endphp
    <div class="mb-3">
        <div class="form-group">
            <label for="{{ $uuid_phone }}" class="form-label">Phone<span class="required"> *</span></label>
            <input id="{{ $uuid_phone }}" name="phone" placeholder="Phone Number" required="required" type="tel"
                value="{{ $row->phone ?? '' }}" class="form-control">
        </div>
    </div>


    <!-- RFID field -->

    @php
        $uuid_rfid = Str::uuid();
    @endphp
    <div class="mb-3">
        <div class="form-group">
            <label for="{{ $uuid_rfid }}" class="form-label">RFID</label>
            <input id="{{ $uuid_rfid }}" name="rfid" placeholder="RFID Number" type="text"
                value="{{ $row->rfid ?? '' }}" class="form-control">
        </div>
    </div>

    <!-- Address field -->


    @php
        $uuid_address = Str::uuid();
    @endphp
    <div class="mb-3">
        <div class="form-group">
            <label for="{{ $uuid_address }}" class="form-label">Address<span class="required"> *</span></label>
            <textarea id="{{ $uuid_address }}" name="address" placeholder="Full Address" class="form-control">{{ $row->address ?? '' }}</textarea>
        </div>
    </div>
</form>