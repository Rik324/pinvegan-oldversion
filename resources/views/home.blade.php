<x-layout.app>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
<div class="bg-white dark:bg-gray-900">
    <!-- Hero Section -->
    <div class="bg-yellow-400 dark:bg-yellow-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0 md:pr-8">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                        Fresh Fruits for Every Occasion
                    </h1>
                    <p class="text-xl text-gray-800 dark:text-gray-200 mb-6">
                        We provide high-quality, fresh fruits sourced from local and international farms. Perfect for events, restaurants, and health-conscious individuals.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('fruits.index') }}" class="bg-green-800 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                            Browse Fruits
                        </a>
                        <a href="{{ route('quote.index') }}" class="bg-white hover:bg-gray-100 text-green-800 font-bold py-3 px-6 rounded-lg border-2 border-green-800 transition duration-300">
                            Request a Quote
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2">
                    <img src="https://images.unsplash.com/photo-1619566636858-adf3ef46400b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                         alt="Fresh Fruits" 
                         class="rounded-lg shadow-xl w-full h-auto">
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Fruits Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8 text-center">Featured Fruits</h2>
        
        @if($featuredFruits->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredFruits as $fruit)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:shadow-lg hover:-translate-y-1">
                <div class="h-48 overflow-hidden">
                    @if($fruit->image)
                    <img src="{{ $fruit->image }}" alt="{{ $fruit->name }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                        <span class="text-gray-500 dark:text-gray-400">No image available</span>
                    </div>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ $fruit->name }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-2">{{ $fruit->description }}</p>
                    <div class="flex justify-between items-center">
                        <a href="{{ route('fruits.show', $fruit) }}" class="text-green-800 dark:text-yellow-400 hover:underline font-medium">
                            View Details
                        </a>
                        <form action="{{ route('quote.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="fruit_id" value="{{ $fruit->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="bg-green-800 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
                                Add to Quote
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-8">
            <p class="text-gray-600 dark:text-gray-400">No featured fruits available at the moment.</p>
        </div>
        @endif
        
        <div class="mt-10 text-center">
            <a href="{{ route('fruits.index') }}" class="inline-block bg-green-800 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                View All Fruits
            </a>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="bg-gray-100 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8 text-center">Browse by Category</h2>
            
            @if($categories->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach($categories as $category)
                <a href="{{ route('fruits.index', ['category' => $category]) }}" class="bg-white dark:bg-gray-700 rounded-lg shadow p-6 text-center hover:shadow-lg transition-transform duration-300 hover:-translate-y-1">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $category }}</h3>
                </a>
                @endforeach
            </div>
            @else
            <div class="text-center py-8">
                <p class="text-gray-600 dark:text-gray-400">No categories available at the moment.</p>
            </div>
            @endif
        </div>
    </div>

    <!-- About Us Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-8 md:mb-0 md:pr-8">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">About Fahad Mart</h2>
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                    Founded in 2010, Fahad Mart has grown from a small local fruit stand to a trusted supplier for events, restaurants, and health-conscious individuals across the region.
                </p>
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                    Our mission is to provide the freshest, highest quality fruits while supporting sustainable farming practices and building lasting relationships with our customers and suppliers.
                </p>
                <a href="{{ route('about') }}" class="inline-block bg-green-800 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                    Learn More About Us
                </a>
            </div>
            <div class="md:w-1/2">
                <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" 
                     alt="Our Farm" 
                     class="rounded-lg shadow-xl w-full h-auto">
            </div>
        </div>
    </div>

    <!-- Call to Action Section -->
    <div class="bg-yellow-400 dark:bg-yellow-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-center">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Ready to Place an Order?</h2>
            <p class="text-xl text-gray-800 dark:text-gray-200 mb-8 max-w-3xl mx-auto">
                Contact us today to request a quote for your event, restaurant, or personal needs.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('quote.index') }}" class="bg-green-800 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                    Request a Quote
                </a>
                <a href="{{ route('contact') }}" class="bg-white hover:bg-gray-100 text-green-800 font-bold py-3 px-6 rounded-lg border-2 border-green-800 transition duration-300">
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</div>
</x-layout.app>
