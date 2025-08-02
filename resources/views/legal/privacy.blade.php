<x-layout.app :title="__('legal.privacy_policy_title')">
    <div class="py-12 bg-white dark:bg-gray-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ __('legal.privacy_policy_title') }}</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('legal.privacy_policy_last_updated') }}</p>
            </div>
            
            <div class="prose prose-green max-w-none dark:prose-invert">
                <p class="mb-6">{{ __('legal.privacy_policy_intro') }}</p>
                
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mt-8 mb-4">{{ __('legal.privacy_policy_collecting') }}</h2>
                <p class="mb-6">{{ __('legal.privacy_policy_collecting_text') }}</p>
                
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mt-8 mb-4">{{ __('legal.privacy_policy_using') }}</h2>
                <p class="mb-6">{{ __('legal.privacy_policy_using_text') }}</p>
                
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mt-8 mb-4">{{ __('legal.privacy_policy_sharing') }}</h2>
                <p class="mb-6">{{ __('legal.privacy_policy_sharing_text') }}</p>
                
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mt-8 mb-4">{{ __('legal.privacy_policy_cookies') }}</h2>
                <p class="mb-6">{{ __('legal.privacy_policy_cookies_text') }}</p>
                
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mt-8 mb-4">{{ __('legal.privacy_policy_rights') }}</h2>
                <p class="mb-6">{{ __('legal.privacy_policy_rights_text') }}</p>
                
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mt-8 mb-4">{{ __('legal.privacy_policy_contact') }}</h2>
                <p class="mb-6">{{ __('legal.privacy_policy_contact_text') }}</p>
            </div>
        </div>
    </div>
</x-layout.app>
