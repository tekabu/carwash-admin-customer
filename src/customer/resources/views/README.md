# Blade Template Documentation

This directory contains reusable Blade templates extracted from the HTML templates in `public/publicx`.

## Directory Structure

```
resources/views/
├── layouts/
│   ├── app.blade.php          # Main layout for regular pages (with breadcrumb)
│   └── home.blade.php         # Layout for home pages (without breadcrumb)
├── partials/
│   ├── head.blade.php         # Meta tags, CSS links
│   ├── preloader.blade.php    # Loading animation
│   ├── header-top.blade.php   # Top header bar (contact info, social links)
│   ├── navigation.blade.php   # Main navigation menu
│   ├── header.blade.php       # Complete header (combines header-top + navigation)
│   ├── search-popup.blade.php # Search overlay
│   ├── breadcrumb.blade.php   # Page breadcrumb navigation
│   ├── footer.blade.php       # Footer section
│   ├── scroll-top.blade.php   # Scroll to top button
│   └── scripts.blade.php      # JavaScript files
└── examples/                   # Example usage templates
```

## Layouts

### 1. App Layout (`layouts/app.blade.php`)
Use this for regular pages that need a breadcrumb section.

**Features:**
- Includes breadcrumb by default
- Full header with top bar
- Standard footer

**Example:**
```blade
@extends('layouts.app')

@section('title', 'About Us - Carwash')
@section('breadcrumb_title', 'About Us')

@section('content')
    <!-- Your page content here -->
@endsection
```

### 2. Home Layout (`layouts.home.blade.php`)
Use this for home pages that don't need breadcrumbs.

**Features:**
- No breadcrumb section
- Customizable header and footer classes
- Ideal for landing pages

**Example:**
```blade
@extends('layouts.home')

@section('title', 'Home - Carwash')
@section('main_class', 'home-3 main')
@section('header_class', 'home-3 header')
@section('footer_class', 'home-3 footer-area')

@section('content')
    <!-- Your hero section and content here -->
@endsection
```

## Common Sections

### Setting Page Title
```blade
@section('title', 'Your Page Title - Carwash')
```

### Setting Meta Tags
```blade
@section('meta_description', 'Your page description')
@section('meta_keywords', 'keyword1, keyword2, keyword3')
```

### Setting Breadcrumb
Simple breadcrumb:
```blade
@section('breadcrumb_title', 'Contact Us')
```

Custom breadcrumb trail:
```blade
@section('breadcrumb_title', 'Service Details')

@php
    $breadcrumbs = [
        ['title' => 'Services', 'url' => url('services')],
        ['title' => 'Auto Detailing']
    ];
@endphp
```

### Hiding Components

Hide breadcrumb:
```blade
@php
    $hideBreadcrumb = true;
@endphp
```

Hide header top section:
```blade
@php
    $hideHeaderTop = true;
@endphp
```

### Custom CSS Classes

Set custom main class:
```blade
@section('main_class', 'custom-main-class')
```

Set custom header class:
```blade
@section('header_class', 'home-3 header')
```

Set custom footer class:
```blade
@section('footer_class', 'home-3 footer-area')
```

## Adding Custom Styles and Scripts

### Page-specific CSS
```blade
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/custom-page.css') }}">
@endpush
```

### Page-specific JavaScript
```blade
@push('scripts')
    <script src="{{ asset('js/custom-page.js') }}"></script>
@endpush
```

## Navigation Active States

The navigation automatically highlights active menu items based on the current route using Laravel's `request()->is()` helper.

Example from navigation:
```blade
<li class="nav-item">
    <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ url('about') }}">About</a>
</li>
```

## Asset Helper

All assets use Laravel's `asset()` helper function to generate proper URLs:

```blade
<img src="{{ asset('assets/img/logo/logo.png') }}" alt="logo">
```

This ensures assets work correctly regardless of your application's installation directory.

**Note:** All assets should be placed in the `public/assets` directory. The `public/publicx` folder is only for reference and will be removed after project completion.

## Example Templates

Check the `examples/` directory for complete working examples:

1. **home_example.blade.php** - Home page with custom classes
2. **page_example.blade.php** - Standard page with breadcrumb
3. **page_with_custom_breadcrumb.blade.php** - Page with multi-level breadcrumb
4. **page_without_header_top.blade.php** - Page without top header bar

### Example Routes

You can view these examples by visiting:

- `/examples/home` - Home page example
- `/examples/page` - Standard page example
- `/examples/custom-breadcrumb` - Page with custom breadcrumb trail
- `/examples/no-header-top` - Page without header top section

Or use named routes in your code:

```php
// Using route helper
route('examples.home')
route('examples.page')
route('examples.custom-breadcrumb')
route('examples.no-header-top')
```

## Partials Reference

### Head (`partials/head.blade.php`)
Contains all meta tags, title, favicon, and CSS links.

### Header Top (`partials/header-top.blade.php`)
Top bar with contact information and social media links.

### Navigation (`partials/navigation.blade.php`)
Main menu with dropdowns and mobile toggle.

### Header (`partials/header.blade.php`)
Combines header-top and navigation. Can hide header-top by setting `$hideHeaderTop = true`.

### Search Popup (`partials/search-popup.blade.php`)
Search overlay that appears when search icon is clicked.

### Breadcrumb (`partials/breadcrumb.blade.php`)
Page breadcrumb navigation with customizable trail.

### Footer (`partials/footer.blade.php`)
Footer with widgets, links, and copyright information.

### Scroll Top (`partials/scroll-top.blade.php`)
Scroll to top button that appears when scrolling down.

### Scripts (`partials/scripts.blade.php`)
All JavaScript files and libraries.

## Tips

1. **Always extend a layout** - Don't create standalone pages
2. **Use @section for content areas** - This keeps templates clean and maintainable
3. **Use @push for additional assets** - Don't modify the head/scripts partials directly
4. **Use Laravel's helpers** - Use `url()`, `asset()`, `route()` for all links
5. **Keep partials reusable** - Avoid hardcoding page-specific content in partials

## Customization

To customize site-wide elements:

- **Logo**: Edit `partials/navigation.blade.php` and `partials/footer.blade.php`
- **Contact Info**: Edit `partials/header-top.blade.php` and `partials/footer.blade.php`
- **Menu Items**: Edit `partials/navigation.blade.php`
- **Social Links**: Edit `partials/header-top.blade.php` and `partials/footer.blade.php`
- **Footer Content**: Edit `partials/footer.blade.php`
