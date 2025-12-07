<div class="site-breadcrumb" style="background: url({{ asset('assets/img/breadcrumb/services-1.jpg') }})">
    <div class="container">
        <h2 class="breadcrumb-title">@yield('breadcrumb_title')</h2>
        {{-- <ul class="breadcrumb-menu">
            <li><a href="{{ url('/') }}">Home</a></li>
            @if(isset($breadcrumbs))
                @foreach($breadcrumbs as $breadcrumb)
                    <li class="{{ $loop->last ? 'active' : '' }}">
                        @if(!$loop->last && isset($breadcrumb['url']))
                            <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['title'] }}</a>
                        @else
                            {{ $breadcrumb['title'] }}
                        @endif
                    </li>
                @endforeach
            @else
                <li class="active">@yield('breadcrumb_title')</li>
            @endif
        </ul> --}}
    </div>
</div>