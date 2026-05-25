<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // BU SATIRI EKLE

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // BU KOD BLOGUNU EKLE
        // Sadece canlı sunucuda (production) HTTPS'e zorlar
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }
    }
}