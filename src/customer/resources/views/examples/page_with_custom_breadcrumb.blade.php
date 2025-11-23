@extends('layouts.app')

@section('title', 'Contact Us - Carwash')
@section('breadcrumb_title', 'Contact Us')

{{-- Custom breadcrumb trail --}}
@php
    $breadcrumbs = [
        ['title' => 'Pages', 'url' => url('pages')],
        ['title' => 'Contact Us']
    ];
@endphp

@section('content')

    {{-- Contact Area --}}
    <div class="contact-area py-120">
        <div class="container">
            {{-- Your contact content here --}}
        </div>
    </div>

@endsection
