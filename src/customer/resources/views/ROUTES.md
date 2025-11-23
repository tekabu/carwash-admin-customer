# Example Routes Reference

## Available Example Routes

The following routes have been set up to demonstrate the Blade template system:

### 1. Home Example
- **URL:** `/examples/home`
- **Route Name:** `examples.home`
- **Template:** `resources/views/examples/home_example.blade.php`
- **Layout:** `layouts.home`
- **Description:** Demonstrates a home page layout without breadcrumb, with custom header and footer classes

### 2. Standard Page Example
- **URL:** `/examples/page`
- **Route Name:** `examples.page`
- **Template:** `resources/views/examples/page_example.blade.php`
- **Layout:** `layouts.app`
- **Description:** Shows a standard page with breadcrumb navigation

### 3. Custom Breadcrumb Example
- **URL:** `/examples/custom-breadcrumb`
- **Route Name:** `examples.custom-breadcrumb`
- **Template:** `resources/views/examples/page_with_custom_breadcrumb.blade.php`
- **Layout:** `layouts.app`
- **Description:** Demonstrates how to create a multi-level breadcrumb trail

### 4. No Header Top Example
- **URL:** `/examples/no-header-top`
- **Route Name:** `examples.no-header-top`
- **Template:** `resources/views/examples/page_without_header_top.blade.php`
- **Layout:** `layouts.app`
- **Description:** Shows how to hide the header top section (contact bar)

## Using Routes in Code

### In Blade Templates

```blade
<!-- Using URL helper -->
<a href="{{ url('/examples/home') }}">Home Example</a>

<!-- Using route helper (recommended) -->
<a href="{{ route('examples.home') }}">Home Example</a>
<a href="{{ route('examples.page') }}">Page Example</a>
<a href="{{ route('examples.custom-breadcrumb') }}">Custom Breadcrumb</a>
<a href="{{ route('examples.no-header-top') }}">No Header Top</a>
```

### In Controllers

```php
// Redirect to example page
return redirect()->route('examples.home');

// Generate URL
$url = route('examples.page');
```

## Testing the Examples

To test the example pages:

1. Make sure your Laravel development server is running:
   ```bash
   php artisan serve
   ```

2. Visit the examples in your browser:
   - http://localhost:8000/examples/home
   - http://localhost:8000/examples/page
   - http://localhost:8000/examples/custom-breadcrumb
   - http://localhost:8000/examples/no-header-top

## Notes

- All example routes are grouped under the `/examples` prefix
- These routes are for demonstration purposes only
- You can copy and modify the example templates to create your actual pages
- Remove or comment out these routes in production if not needed

## Creating Your Own Routes

Based on these examples, you can create your own routes:

```php
// Simple route
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

// Route with controller
Route::get('/services', [ServiceController::class, 'index'])->name('services');

// Route with parameters
Route::get('/service/{id}', [ServiceController::class, 'show'])->name('service.show');
```
