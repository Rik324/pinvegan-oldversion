<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Set locale from session if available
        if (session()->has('locale')) {
            $locale = session('locale');
            if (in_array($locale, ['en', 'th', 'zh'])) {
                App::setLocale($locale);
            }
        }
    }
}
