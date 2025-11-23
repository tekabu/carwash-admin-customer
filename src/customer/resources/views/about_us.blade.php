@extends('layouts.app')

@section('breadcrumb_title', 'About Us')

@php
    $breadcrumbs = [
        ['title' => 'About Us']
    ];
@endphp

@section('content')

    @include('partials.home.about')

@endsection
