<x-layout.app :title="__('legal.disclaimer_title')">
    <div class="py-12 bg-white dark:bg-gray-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ __('legal.disclaimer_title') }}</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('legal.disclaimer_last_updated') }}</p>
            </div>
            
            <div class="prose prose-green max-w-none dark:prose-invert">
                <p class="mb-6">{{ __('legal.disclaimer_intro') }}</p>
                
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mt-8 mb-4">{{ __('legal.disclaimer_accuracy') }}</h2>
                <p class="mb-6">{{ __('legal.disclaimer_accuracy_text') }}</p>
                
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mt-8 mb-4">{{ __('legal.disclaimer_use') }}</h2>
                <p class="mb-6">{{ __('legal.disclaimer_use_text') }}</p>
                
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mt-8 mb-4">{{ __('legal.disclaimer_external') }}</h2>
                <p class="mb-6">{{ __('legal.disclaimer_external_text') }}</p>
                
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mt-8 mb-4">{{ __('legal.disclaimer_products') }}</h2>
                <p class="mb-6">{{ __('legal.disclaimer_products_text') }}</p>
                
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mt-8 mb-4">{{ __('legal.disclaimer_health') }}</h2>
                <p class="mb-6">{{ __('legal.disclaimer_health_text') }}</p>
            </div>
        </div>
    </div>
</x-layout.app>
