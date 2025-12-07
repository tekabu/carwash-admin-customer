@extends('layouts.app')

@section('breadcrumb_title', 'Services')

@php
    $breadcrumbs = [
        ['title' => 'Services']
    ];
@endphp

@section('content')

    @include('partials.home.services')

     @include('partials.home.promotion')

    @include('partials.home.portfolio')

@endsection