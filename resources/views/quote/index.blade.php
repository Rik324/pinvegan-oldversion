<x-layout.app>
    <x-slot:header>
        <h2 class="mt-4 text-xl font-semibold leading-tight text-yellow-300 dark:text-gray-200">
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
            @auth
                <x-quote.form :quoteItems="$quoteItems" />
            @else
                <div class="p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
                    <h2 class="mb-6 text-2xl font-bold text-gray-900 dark:text-white">{{ __('frontend.request_quote') }}</h2>
                    
                    <div class="p-6 text-center bg-gray-100 rounded-lg dark:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-4 w-16 h-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <h3 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">{{ __('Please login or register to submit your quote request') }}</h3>
                        <p class="mb-6 text-gray-600 dark:text-gray-400">{{ __('You need to be logged in to submit a quote request. This helps us keep track of your orders and provide better service.') }}</p>
                        
                        <div class="flex flex-col justify-center space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
                            <a href="{{ route('login') }}" class="px-6 py-2 font-medium text-white bg-blue-600 rounded-md transition duration-300 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                {{ __('Login') }}
                            </a>
                            <a href="{{ route('register') }}" class="px-6 py-2 font-medium text-gray-800 bg-gray-200 rounded-md transition duration-300 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
                                {{ __('Register') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endauth
        @endif
    </div>

    <!-- User's Submitted Quotes Section -->
    @auth
        @if(isset($userQuotes) && $userQuotes->count() > 0)
            <div class="bg-white dark:bg-gray-900">
                <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h2 class="mb-6 text-3xl font-bold text-gray-900 dark:text-white">{{ __('frontend.your_submitted_quotes') }}</h2>
                        <p class="mx-auto mb-8 max-w-3xl text-xl text-gray-600 dark:text-gray-300">
                            {{ __('frontend.review_submitted_quotes') }}
                        </p>
                    </div>
                    
                    <div class="mt-8 space-y-6">
                        @foreach($userQuotes as $quote)
                            <div class="p-6 bg-gray-50 rounded-lg shadow-md dark:bg-gray-800">
                                <div class="flex justify-between items-center mb-4">
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('frontend.quote_request_number') }} {{ $quote->id }}</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $quote->created_at->format('F j, Y, g:i a') }}</p>
                                    </div>
                                    <span class="px-3 py-1 text-xs font-medium rounded-full
                                        {{ $quote->status == 'new' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : '' }}
                                        {{ $quote->status == 'processing' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : '' }}
                                        {{ $quote->status == 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : '' }}
                                        {{ $quote->status == 'cancelled' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : '' }}">
                                        {{ ucfirst($quote->status) }}
                                    </span>
                                </div>
                                
                                @if($quote->message)
                                    <div class="mb-4">
                                        <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('frontend.your_message') }}:</h4>
                                        <p class="mt-1 text-gray-600 dark:text-gray-400">{{ $quote->message }}</p>
                                    </div>
                                @endif
                                
                                <div>
                                    <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('frontend.requested_items') }}:</h4>
                                    <ul class="grid grid-cols-1 gap-2 mt-2 sm:grid-cols-2 lg:grid-cols-3">
                                        @foreach($quote->fruits as $fruit)
                                            <li class="flex items-center p-2 bg-white rounded-md shadow-sm dark:bg-gray-700">
                                                <span class="flex-1">{{ $fruit->name }}</span>
                                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('frontend.quantity_short') }}: {{ $fruit->pivot->quantity }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endauth

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
