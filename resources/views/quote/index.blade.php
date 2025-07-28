<x-layout.app>
    <x-slot:header>
        <h2 class="text-xl font-semibold leading-tight text-yellow-300 dark:text-gray-200">
            {{ __('frontend.quote_request') }}
        </h2>
    </x-slot>
<div class="bg-white dark:bg-gray-900">
    <!-- Hero Section -->
    <div class="bg-yellow-400 dark:bg-yellow-600">
        <div class="px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="mb-4 text-4xl font-bold text-gray-900 dark:text-white">{{ __('frontend.quote_request') }}</h1>
                <p class="mx-auto max-w-3xl text-xl text-gray-800 dark:text-gray-200">
                    {{ __('frontend.quote_description') }}
                </p>
            </div>
        </div>
    </div>

    <div class="px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <x-ui.flash-message />

        <!-- Quote Items Section -->
        <div class="mb-12">
            <h2 class="mb-6 text-2xl font-bold text-gray-900 dark:text-white">{{ __('frontend.your_quote_items') }}</h2>
            
            @if(isset($quoteItems) && count($quoteItems) > 0)
                <div class="space-y-4">
                    @foreach($quoteItems as $item)
                        <x-quote.item :item="$item" />
                    @endforeach
                </div>
                
                <div class="flex justify-between items-center mt-6">
                    <a href="{{ route('fruits.index', ['locale' => app()->getLocale()]) }}" class="inline-flex justify-center items-center px-6 py-3 font-medium text-white bg-green-800 rounded-md border-2 border-green-600 transition duration-300 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        {{ __('frontend.continue_add_fruit') }}
                    </a>
                    <form action="{{ route('quote.clear') }}" method="POST" class="inline-block">
                        <input type="hidden" name="locale" value="{{ app()->getLocale() }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 font-medium text-white bg-red-600 rounded-md transition duration-300 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                            {{ __('frontend.clear_all_items') }}
                        </button>
                    </form>
                </div>
            @else
                <div class="p-8 text-center bg-gray-100 rounded-lg dark:bg-gray-800">
                    <svg class="mx-auto mb-4 w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <h3 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">{{ __('frontend.quote_empty') }}</h3>
                    <p class="mb-6 text-gray-600 dark:text-gray-400">{{ __('frontend.browse_fruit_selection') }}</p>
                    <a href="{{ route('fruits.index', ['locale' => app()->getLocale()]) }}" class="px-6 py-2 font-medium text-white bg-green-800 rounded-md transition duration-300 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                        {{ __('frontend.browse_fruits') }}
                    </a>
                </div>
            @endif
        </div>

        <!-- Quote Request Form -->
        @if(isset($quoteItems) && count($quoteItems) > 0)
            <x-quote.form :quoteItems="$quoteItems" />
        @endif
    </div>

    <!-- Browse More Fruits Section -->
    <div class="bg-gray-100 dark:bg-gray-800">
        <div class="px-4 py-16 mx-auto max-w-7xl text-center sm:px-6 lg:px-8">
            <h2 class="mb-6 text-3xl font-bold text-gray-900 dark:text-white">{{ __('frontend.need_more_options') }}</h2>
            <p class="mx-auto mb-8 max-w-3xl text-xl text-gray-600 dark:text-gray-300">
                {{ __('frontend.browse_catalog_description') }}
            </p>
            <a href="{{ route('fruits.index', ['locale' => app()->getLocale()]) }}" class="px-6 py-3 font-bold text-gray-900 bg-yellow-400 rounded-lg transition duration-300 hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:ring-opacity-50">
                {{ __('frontend.browse_all_fruits') }}
            </a>
        </div>
    </div>
</div>
</x-layout.app>
