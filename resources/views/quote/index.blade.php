<x-layout.app>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Quote Request') }}
        </h2>
    </x-slot>
<div class="bg-white dark:bg-gray-900">
    <!-- Hero Section -->
    <div class="bg-yellow-400 dark:bg-yellow-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Request a Quote</h1>
                <p class="text-xl text-gray-800 dark:text-gray-200 max-w-3xl mx-auto">
                    Get a customized quote for your fruit needs. Add fruits to your quote request and let us know your specific requirements.
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-8" role="alert">
                <p class="font-medium">Success!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-8" role="alert">
                <p class="font-medium">Error!</p>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <!-- Quote Items Section -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Your Quote Items</h2>
            
            @if(isset($quoteItems) && count($quoteItems) > 0)
                <div class="space-y-4">
                    @foreach($quoteItems as $item)
                        <x-quote.item :item="$item" />
                    @endforeach
                </div>
                
                <div class="mt-6 flex justify-between items-center">
                    <a href="{{ route('fruits.index') }}" class="inline-flex items-center justify-center bg-green-800 hover:bg-green-700 text-white font-medium py-3 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 transition duration-300 border-2 border-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Continue to Add Fruit
                    </a>
                    <form action="{{ route('quote.clear') }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 transition duration-300">
                            Clear All Items
                        </button>
                    </form>
                </div>
            @else
                <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-8 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Your quote request is empty</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">Browse our fruit selection and add items to your quote request.</p>
                    <a href="{{ route('fruits.index') }}" class="bg-green-800 hover:bg-green-700 text-white font-medium py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 transition duration-300">
                        Browse Fruits
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Need More Options?</h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto">
                Browse our complete fruit catalog to find the perfect fruits for your needs.
            </p>
            <a href="{{ route('fruits.index') }}" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-3 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:ring-opacity-50 transition duration-300">
                Browse All Fruits
            </a>
        </div>
    </div>
</div>
</x-layout.app>
