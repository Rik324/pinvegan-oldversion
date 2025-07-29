<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
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
        
        // Share categories with all views
        View::composer('*', function ($view) {
            // Get only top-level categories (parent_id is null) that are active
            $topLevelCategories = Category::where('is_active', true)
                ->whereNull('parent_id')
                ->with(['children' => function($query) {
                    $query->where('is_active', true);
                }])
                ->get();
            
            // Also get all categories for backward compatibility
            $allCategories = Category::where('is_active', true)->get();
            
            $view->with([
                'navCategories' => $allCategories,
                'topLevelCategories' => $topLevelCategories
            ]);
        });
    }
}
