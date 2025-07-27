<x-layout.app>
    <x-slot:header>
        
    </x-slot>
<div class="bg-white dark:bg-gray-900">
    <!-- Hero Section -->
    <div class="bg-yellow-400 dark:bg-yellow-600">
        <div class="px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8 md:py-24">
            <div class="flex flex-col items-center md:flex-row">
                <div class="mb-8 md:w-1/2 md:mb-0 md:pr-8">
                    <h1 class="mb-4 text-4xl font-bold text-gray-900 md:text-5xl dark:text-white">
                        {{ __('frontend.hero_title') }}
                    </h1>
                    <p class="mb-6 text-xl text-gray-800 dark:text-gray-200">
                        {{ __('frontend.hero_description') }}
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('fruits.index') }}" class="px-6 py-3 font-bold text-white bg-green-800 rounded-lg transition duration-300 hover:bg-green-700">
                            {{ __('frontend.browse_fruits') }}
                        </a>
                        <a href="{{ route('quote.index') }}" class="px-6 py-3 font-bold text-green-800 bg-white rounded-lg border-2 border-green-800 transition duration-300 hover:bg-gray-100">
                            {{ __('frontend.request_quote') }}
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2">
                    <img src="{{ asset('images/fruits/hero-fruits.jpg') }}" 
                         alt="Fresh Fruits" 
                         class="w-full h-auto rounded-lg shadow-xl">
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Fruits Section -->
    <div class="px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h2 class="mb-8 text-3xl font-bold text-center text-gray-900 dark:text-white">{{ __('frontend.featured_fruits') }}</h2>
        
        @if($featuredFruits->count() > 0)
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($featuredFruits as $fruit)
            <div class="overflow-hidden bg-white rounded-lg shadow-md transition-transform duration-300 dark:bg-gray-800 hover:shadow-lg hover:-translate-y-1">
                <div class="overflow-hidden h-48">
                    @if($fruit->image)
                    <img src="{{ $fruit->image }}" alt="{{ $fruit->name }}" class="object-cover w-full h-full">
                    @else
                    <div class="flex justify-center items-center w-full h-full bg-gray-200 dark:bg-gray-700">
                        <span class="text-gray-500 dark:text-gray-400">{{ __('frontend.no_image') }}</span>
                    </div>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">{{ $fruit->name }}</h3>
                    <p class="mb-4 text-gray-600 dark:text-gray-300 line-clamp-2">{{ $fruit->description }}</p>
                    <div class="flex justify-between items-center">
                        <a href="{{ route('fruits.show', $fruit) }}" class="font-medium text-green-800 dark:text-yellow-400 hover:underline">
                            {{ __('frontend.view_details') }}
                        </a>
                        <form action="{{ route('quote.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="fruit_id" value="{{ $fruit->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="px-3 py-1 text-sm text-white bg-green-800 rounded hover:bg-green-700">
                                {{ __('frontend.add_to_quote') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="py-8 text-center">
            <p class="text-gray-600 dark:text-gray-400">{{ __('frontend.no_featured_fruits') }}</p>
        </div>
        @endif
        
        <div class="mt-10 text-center">
            <a href="{{ route('fruits.index') }}" class="inline-block px-6 py-3 font-bold text-white bg-green-800 rounded-lg transition duration-300 hover:bg-green-700">
                {{ __('frontend.view_all_fruits') }}
            </a>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="bg-green-800 dark:bg-gray-800">
        <div class="px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h2 class="mb-8 text-3xl font-bold text-center text-white dark:text-white">{{ __('frontend.browse_by_category') }}</h2>
            
            @if($categories->count() > 0)
            <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-6">
                @foreach($categories as $category)
                <a href="{{ route('fruits.index', ['category_id' => $category->id]) }}" class="p-6 text-center bg-white rounded-lg shadow transition-transform duration-300 dark:bg-gray-700 hover:shadow-lg hover:-translate-y-1">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $category->name }}</h3>
                    @if($category->description)
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 line-clamp-2">{{ $category->description }}</p>
                    @endif
                </a>
                @endforeach
            </div>
            @else
            <div class="py-8 text-center">
                <p class="text-gray-600 dark:text-gray-400">{{ __('frontend.no_categories') }}</p>
            </div>
            @endif
        </div>
    </div>

    <!-- About Us Section -->
    <div class="px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex flex-col items-center md:flex-row">
            <div class="mb-8 md:w-1/2 md:mb-0 md:pr-8">
                <h2 class="mb-4 text-3xl font-bold text-gray-900 dark:text-white">{{ __('frontend.about_fahad_mart') }}</h2>
                <p class="mb-6 text-gray-600 dark:text-gray-300">
                    {{ __('frontend.about_description_1') }}
                </p>
                <p class="mb-6 text-gray-600 dark:text-gray-300">
                    {{ __('frontend.about_description_2') }}
                </p>
                <a href="{{ route('about') }}" class="inline-block px-4 py-2 font-bold text-white bg-green-800 rounded transition duration-300 hover:bg-green-700">
                    {{ __('frontend.learn_more') }}
                </a>
            </div>
            <div class="md:w-1/2">
                <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" 
                     alt="Our Farm" 
                     class="w-full h-auto rounded-lg shadow-xl">
            </div>
        </div>
    </div>

    <!-- Call to Action Section -->
    <div class="bg-yellow-400 dark:bg-yellow-600">
        <div class="px-4 py-12 mx-auto max-w-7xl text-center sm:px-6 lg:px-8">
            <h2 class="mb-4 text-3xl font-bold text-gray-900 dark:text-white">{{ __('frontend.ready_to_order') }}</h2>
            <p class="mx-auto mb-8 max-w-3xl text-xl text-gray-800 dark:text-gray-200">
                {{ __('frontend.cta_description') }}
            </p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route('quote.index') }}" class="px-6 py-3 font-bold text-white bg-green-800 rounded-lg transition duration-300 hover:bg-green-700">
                    {{ __('frontend.request_quote') }}
                </a>
                <a href="{{ route('contact') }}" class="px-6 py-3 font-bold text-green-800 bg-white rounded-lg border-2 border-green-800 transition duration-300 hover:bg-gray-100">
                    {{ __('frontend.contact_us') }}
                </a>
            </div>
        </div>
    </div>
</div>
</x-layout.app>
