# Car Wash Customer Portal

## Installation Instructions

Follow these steps to install and set up the Car Wash Customer Portal:

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

**Note:** This customer portal shares the same database as the admin panel. Make sure to configure your `.env` file with the same database connection settings as the admin configuration.

### 3. Generate Application Key

Generate a new application key:

```bash
php artisan key:generate
```

### 4. Database Setup

**Important:** Database migrations (including customer tables) are managed in the admin project (`src/admin`). Make sure to run migrations and seeders from the admin project before using the customer portal. See the [admin README](../admin/README.md) for database setup instructions.

### 5. Create Storage Link

Create a symbolic link for storage:

```bash
php artisan storage:link
```

### 6. Set Storage Permissions

Change ownership of storage directories to www-data for proper web server access:

```bash
chown -R www-data:www-data storage/logs
chown -R www-data:www-data storage/framework/cache
chown -R www-data:www-data storage/framework/sessions
chown -R www-data:www-data storage/framework/views
```

### 7. Clear Caches (Optional)

Clear application caches:

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### 8. Optimize Application

Optimize the application for production:

```bash
php artisan optimize
```

## Project Structure

This customer portal is part of a two-project system:
- **Admin Panel** (`src/admin`): Manages all database migrations, customer data, and administrative functions
- **Customer Portal** (`src/customer`): Provides customer-facing features and interfaces

Both projects share the same database to ensure data consistency.
