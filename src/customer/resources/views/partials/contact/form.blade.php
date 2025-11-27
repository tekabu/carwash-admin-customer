<!-- contact form -->
@php
    $currentUser = auth()->user();
@endphp

<div class="contact-wrapper">
    <div class="row">
        <div class="col-lg-6 align-self-center">
            <div class="contact-img">
                <img src="{{ asset('publicx/assets/img/contact/01.jpg') }}" alt="">
            </div>
        </div>
        <div class="col-lg-6 align-self-center">
            <div class="contact-form">
                <div class="contact-form-header">
                    <h2>Get In Touch</h2>
                    <p>It is a long established fact that a reader will be distracted by the readable
                        content of a page randomised words which don't look even slightly when looking at its layout. </p>
                </div>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ route('contact.submit') }}" id="contact-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name"
                                    placeholder="Your Name" value="{{ old('name', $currentUser?->name) }}"
                                    @if($currentUser) readonly @endif required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email"
                                    placeholder="Your Email" value="{{ old('email', $currentUser?->email) }}"
                                    @if($currentUser) readonly @endif required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="subject"
                            placeholder="Your Subject" value="{{ old('subject') }}" required>
                    </div>
                    <div class="form-group">
                        <textarea name="message" cols="30" rows="5" class="form-control"
                            placeholder="Write Your Message" required>{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="theme-btn">Send
                        Message <i class="far fa-paper-plane"></i></button>
                    <div class="col-md-12 mt-3">
                        <div class="form-messege text-success"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
