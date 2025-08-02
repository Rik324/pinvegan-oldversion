<x-layout.app :title="__('legal.terms_title')">
    <div class="py-12 bg-white dark:bg-gray-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ __('legal.terms_title') }}</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('legal.terms_last_updated') }}</p>
            </div>
            
            <div class="prose prose-green max-w-none dark:prose-invert">
                <p class="mb-6">{{ __('legal.terms_intro') }}</p>
                
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mt-8 mb-4">{{ __('legal.terms_acceptance') }}</h2>
                <p class="mb-6">{{ __('legal.terms_acceptance_text') }}</p>
                
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mt-8 mb-4">{{ __('legal.terms_intellectual') }}</h2>
                <p class="mb-6">{{ __('legal.terms_intellectual_text') }}</p>
                
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mt-8 mb-4">{{ __('legal.terms_user_conduct') }}</h2>
                <p class="mb-6">{{ __('legal.terms_user_conduct_text') }}</p>
                
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mt-8 mb-4">{{ __('legal.terms_products') }}</h2>
                <p class="mb-6">{{ __('legal.terms_products_text') }}</p>
                
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mt-8 mb-4">{{ __('legal.terms_disclaimer') }}</h2>
                <p class="mb-6">{{ __('legal.terms_disclaimer_text') }}</p>
                
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mt-8 mb-4">{{ __('legal.terms_limitation') }}</h2>
                <p class="mb-6">{{ __('legal.terms_limitation_text') }}</p>
            </div>
        </div>
    </div>
</x-layout.app>
