<div 
    x-data="{ 
        show: !localStorage.getItem('cookie-consent'), 
        acceptAll: function() { 
            localStorage.setItem('cookie-consent', 'accepted'); 
            this.show = false; 
        },
        decline: function() {
            localStorage.setItem('cookie-consent', 'declined');
            this.show = false;
        }
    }" 
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-full"
    x-transition:enter-end="opacity-100 transform translate-y-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform translate-y-full"
    class="fixed bottom-0 inset-x-0 z-50"
>
    <div class="bg-green-700 dark:bg-green-800 text-white p-4 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 md:flex md:items-center">
                    <div class="text-xl font-medium">{{ __('legal.cookie_consent_title') }}</div>
                    <p class="mt-2 md:mt-0 md:ml-4 text-sm">
                        {{ __('legal.cookie_consent_message') }}
                        <a href="{{ route('legal.privacy') }}?locale={{ app()->getLocale() }}" class="underline hover:text-yellow-300">
                            {{ __('legal.cookie_consent_learn_more') }}
                        </a>
                    </p>
                </div>
                <div class="mt-4 md:mt-0 md:ml-6 flex flex-shrink-0 items-center space-x-3">
                    <button 
                        @click="decline()" 
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-green-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                    >
                        {{ __('legal.cookie_consent_decline') }}
                    </button>
                    <button 
                        @click="acceptAll()" 
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500"
                    >
                        {{ __('legal.cookie_consent_accept') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
