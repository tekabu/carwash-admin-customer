<?php

$providers = [
    App\Providers\AppServiceProvider::class,
];

if (env('TELESCOPE_ENABLED', env('APP_ENV') === 'local')) {
    $providers[] = App\Providers\TelescopeDashboardServiceProvider::class;
}

return $providers;
