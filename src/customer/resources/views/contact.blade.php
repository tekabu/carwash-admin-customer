@extends('layouts.app')

@section('breadcrumb_title', 'Contact Us')

@php
    $breadcrumbs = [
        ['title' => 'Contact Us']
    ];
@endphp

@section('content')

<!-- contact area -->
<div class="contact-area py-120">
    <div class="container">
        @include('partials.contact.info')
        @include('partials.contact.form')
    </div>
</div>
<!-- end contact area -->

@endsection
