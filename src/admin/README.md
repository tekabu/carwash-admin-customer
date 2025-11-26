# Car Wash Admin Portal

## Installation Instructions

Follow these steps to install and set up the Car Wash Admin Portal:

### 1. Install Dependencies

Install PHP dependencies using Composer:

```bash
composer install
```

Or update existing packages:

```bash
composer update
```

### 2. Environment Configuration

**Note:** Make sure to configure your `.env` file with your database connection settings. This admin panel shares the same database with the customer portal.

Set `TELESCOPE_ENABLED=false` in environments where you don't want to expose the Telescope dashboard. It defaults to `true` for local development. When Telescope is enabled outside of `local`, make sure the admin session login page is reachable because Telescope now requires an authenticated web session before loading. Use `TELESCOPE_AUTH_GUARD` (default `web`) and `TELESCOPE_LOGIN_ROUTE` (default `login`) if you need to point Telescope at a custom guard or login route.

### Telescope Installation

If Telescope is not yet installed, run:

```bash
composer require laravel/telescope
php artisan telescope:install
php artisan migrate
```

### 3. Generate Application Key

Generate a new application key:

```bash
php artisan key:generate
```

### 4. Run Database Migrations

Create the database tables:

```bash
php artisan migrate
```

### 5. Seed Database (Optional)

Populate the database with initial data:

```bash
php artisan db:seed
```

Or run specific seeders:

```bash
php artisan db:seed --class=CustomerSeeder
php artisan db:seed --class=VehicleTypeSeeder
php artisan db:seed --class=SoapTypeSeeder
php artisan db:seed --class=TransactionSeeder
```

### 6. Create Storage Link

Create a symbolic link for storage:

```bash
php artisan storage:link
```

### 7. Set Storage Permissions

Change ownership of storage directories to www-data for proper web server access:

```bash
chown -R www-data:www-data storage/logs
chown -R www-data:www-data storage/framework/cache
chown -R www-data:www-data storage/framework/sessions
chown -R www-data:www-data storage/framework/views
```

### 8. Clear Caches (Optional)

Clear application caches:

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### 9. Optimize Application

Optimize the application for production:

```bash
php artisan optimize
```
