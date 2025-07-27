<!DOCTYPE html>
<html lang="{{ app()->getLocale() === 'zh' ? 'zh-CN' : str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Fruit Shop') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <!-- Language Switcher -->
            <div class="bg-gray-900 dark:bg-gray-800">
                <div class="flex justify-between items-center px-4 py-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="flex items-center space-x-4 text-white">
                        <a href="{{ route('about') }}?locale={{ app()->getLocale() }}" class="text-sm hover:text-gray-200">{{ __('frontend.about_us_title', ['title' => __('frontend.about_title')]) }}</a>
                        <a href="{{ route('contact') }}?locale={{ app()->getLocale() }}" class="text-sm hover:text-gray-200">{{ __('frontend.contact_us_title') }}</a>
                    </div>
                    <div class="flex items-center space-x-2 text-white">
                        <a href="{{ request()->fullUrlWithQuery(['locale' => 'en']) }}" class="text-sm hover:text-gray-200 {{ app()->getLocale() === 'en' ? 'font-bold underline' : '' }}">English</a>
                        <span class="text-gray-500">|</span>
                        <a href="{{ request()->fullUrlWithQuery(['locale' => 'th']) }}" class="text-sm hover:text-gray-200 {{ app()->getLocale() === 'th' ? 'font-bold underline' : '' }}">ไทย</a>
                        <span class="text-gray-500">|</span>
                        <a href="{{ request()->fullUrlWithQuery(['locale' => 'zh']) }}" class="text-sm hover:text-gray-200 {{ app()->getLocale() === 'zh' ? 'font-bold underline' : '' }}">中文</a>
                    </div>
                </div>
            </div>
            
            <x-layout.navigation />

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-green-800 shadow dark:bg-green-900">
                    
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
                
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- Footer -->
            <x-layout.footer />
        </div>
    </body>
</html>
