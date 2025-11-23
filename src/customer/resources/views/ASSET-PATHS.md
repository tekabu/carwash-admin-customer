# Asset Paths Information

## Important Note

All Blade templates now reference assets from the `public/assets` directory.

### Asset Path Structure

```
public/
└── assets/
    ├── css/
    │   ├── bootstrap.min.css
    │   ├── all-fontawesome.min.css
    │   ├── icomoon.css
    │   ├── animate.min.css
    │   ├── magnific-popup.min.css
    │   ├── owl.carousel.min.css
    │   └── style.css
    ├── js/
    │   ├── jquery-3.6.0.min.js
    │   ├── modernizr.min.js
    │   ├── bootstrap.bundle.min.js
    │   ├── imagesloaded.pkgd.min.js
    │   ├── jquery.magnific-popup.min.js
    │   ├── isotope.pkgd.min.js
    │   ├── jquery.appear.min.js
    │   ├── jquery.easing.min.js
    │   ├── owl.carousel.min.js
    │   ├── counter-up.js
    │   ├── masonry.pkgd.min.js
    │   ├── wow.min.js
    │   └── main.js
    └── img/
        ├── logo/
        │   ├── logo.png
        │   ├── logo-light.png
        │   └── favicon.png
        ├── icon/
        │   ├── phone.svg
        │   ├── live-chat.svg
        │   ├── mail.svg
        │   └── clock.svg
        └── breadcrumb/
            └── 01.jpg
```

## Usage in Blade Templates

All asset references use Laravel's `asset()` helper:

```blade
<!-- CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

<!-- JavaScript -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Images -->
<img src="{{ asset('assets/img/logo/logo.png') }}" alt="logo">
```

## Migration Note

The `public/publicx` directory contains the original HTML templates and assets for reference only. After copying the necessary assets to `public/assets`, the `public/publicx` folder can be safely removed.

### To Copy Assets

You can manually copy the assets from `public/publicx/assets` to `public/assets`:

```bash
# Make sure you're in the project root
cp -r public/publicx/assets/* public/assets/
```

Or create the assets directory structure manually and copy only what you need.
