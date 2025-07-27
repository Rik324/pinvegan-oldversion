<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocaleController extends Controller
{
    /**
     * Switch the application locale
     *
     * @param  string  $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switchLocale($locale, Request $request)
    {
        // Validate if the locale is supported - use strict comparison
        if (!in_array($locale, ['en', 'th', 'zh'], true)) {
            $locale = 'en'; // Default to English if not supported
        }
        
        // Store locale in session - ensure it's properly saved
        session()->put('locale', $locale);
        session()->save();
        
        // Set the locale immediately and update config
        App::setLocale($locale);
        config(['app.locale' => $locale]);
        
        // Get the URL to redirect back to
        $redirect = $request->header('referer');
        
        // If no referer is available or if accessed directly, redirect to home
        if (empty($redirect) || $redirect == url('locale/'.$locale)) {
            return redirect()->route('home', ['locale' => $locale]);
        }
        
        // Parse the URL to ensure we can add locale parameter if needed
        $parsedUrl = parse_url($redirect);
        $query = [];
        
        // Extract existing query parameters if any
        if (isset($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $query);
        }
        
        // Add or update the locale parameter
        $query['locale'] = $locale;
        
        // Rebuild the URL with the updated query
        $path = $parsedUrl['path'] ?? '';
        $newQuery = http_build_query($query);
        $fragment = isset($parsedUrl['fragment']) ? "#{$parsedUrl['fragment']}" : '';
        
        // Construct the final URL
        $scheme = isset($parsedUrl['scheme']) ? "{$parsedUrl['scheme']}://" : '';
        $host = $parsedUrl['host'] ?? '';
        $port = isset($parsedUrl['port']) ? ":{$parsedUrl['port']}" : '';
        
        $newUrl = "{$scheme}{$host}{$port}{$path}?{$newQuery}{$fragment}";
        
        // Redirect to the new URL with locale parameter
        return redirect($newUrl);
    }
}
