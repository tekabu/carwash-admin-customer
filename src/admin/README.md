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
php artisan db:seed --class=PackageTypeSeeder
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
sudo chown -R www-data:www-data storage/logs
sudo chown -R www-data:www-data storage/framework/cache
sudo chown -R www-data:www-data storage/framework/sessions
sudo chown -R www-data:www-data storage/framework/views
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
