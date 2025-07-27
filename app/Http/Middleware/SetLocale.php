<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // First priority: Check URL parameter
        if ($request->has('locale')) {
            $locale = $request->get('locale');
            if (in_array($locale, ['en', 'th', 'zh'], true)) {
                App::setLocale($locale);
                session()->put('locale', $locale);
                session()->save();
                config(['app.locale' => $locale]);
            }
        }
        // Second priority: Check form input
        elseif ($request->input('locale')) {
            $locale = $request->input('locale');
            if (in_array($locale, ['en', 'th', 'zh'], true)) {
                App::setLocale($locale);
                session()->put('locale', $locale);
                session()->save();
                config(['app.locale' => $locale]);
            }
        }
        // Third priority: Check session
        elseif (session()->has('locale')) {
            $locale = session('locale');
            if (in_array($locale, ['en', 'th', 'zh'], true)) {
                App::setLocale($locale);
                config(['app.locale' => $locale]);
            }
        }
        
        // Make sure app locale is set in config
        config(['app.locale' => App::getLocale()]);
        
        // Debug: Log the current locale
        \Illuminate\Support\Facades\Log::info('Current locale: ' . App::getLocale());
        \Illuminate\Support\Facades\Log::info('Session locale: ' . session('locale', 'not set'));
        \Illuminate\Support\Facades\Log::info('Config locale: ' . config('app.locale'));
        \Illuminate\Support\Facades\Log::info('Request locale: ' . $request->get('locale', 'not set'));
        \Illuminate\Support\Facades\Log::info('Form locale: ' . $request->input('locale', 'not set'));
        
        return $next($request);
    }
}
