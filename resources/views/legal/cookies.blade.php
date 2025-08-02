<x-layout.app :title="__('legal.cookie_policy')">
    <div class="py-12 bg-white dark:bg-gray-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ __('legal.cookie_policy') }}</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('legal.privacy_policy_last_updated') }}</p>
            </div>
            
            <div class="prose prose-green max-w-none dark:prose-invert">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mt-8 mb-4">{{ __('legal.what_are_cookies') }}</h2>
                <p class="mb-6">{{ __('legal.what_are_cookies_text') }}</p>
                
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mt-8 mb-4">{{ __('legal.how_we_use_cookies') }}</h2>
                <p class="mb-6">{{ __('legal.how_we_use_cookies_text') }}</p>
                
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mt-8 mb-4">{{ __('legal.types_of_cookies') }}</h2>
                <p class="mb-6">{{ __('legal.types_of_cookies_text') }}</p>
                
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mt-6 mb-3">{{ __('legal.essential_cookies') }}</h3>
                <p class="mb-4">{{ __('legal.essential_cookies_text') }}</p>
                
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mt-6 mb-3">{{ __('legal.analytics_cookies') }}</h3>
                <p class="mb-4">{{ __('legal.analytics_cookies_text') }}</p>
                
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mt-6 mb-3">{{ __('legal.marketing_cookies') }}</h3>
                <p class="mb-4">{{ __('legal.marketing_cookies_text') }}</p>
                
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mt-8 mb-4">{{ __('legal.managing_cookies') }}</h2>
                <p class="mb-6">{{ __('legal.managing_cookies_text') }}</p>
            </div>
        </div>
    </div>
</x-layout.app>
