<x-layout.app>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Our Fruits') }}
        </h2>
    </x-slot>
<div class="bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Our Fruits</h1>
        
        <!-- Filters and Sorting -->
        <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-4 mb-8">
            <form action="{{ route('fruits.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="md:w-1/3">
                    <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Filter by Category</label>
                    <select name="category" id="category" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-yellow-500 focus:ring focus:ring-yellow-200 focus:ring-opacity-50">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="md:w-1/3">
                    <label for="sort" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sort By</label>
                    <select name="sort" id="sort" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-yellow-500 focus:ring focus:ring-yellow-200 focus:ring-opacity-50">
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                        <option value="origin" {{ request('sort') == 'origin' ? 'selected' : '' }}>Origin</option>
                        <option value="seasonality" {{ request('sort') == 'seasonality' ? 'selected' : '' }}>Seasonality</option>
                    </select>
                </div>
                
                <div class="md:w-1/3">
                    <label for="direction" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sort Direction</label>
                    <select name="direction" id="direction" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-yellow-500 focus:ring focus:ring-yellow-200 focus:ring-opacity-50">
                        <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
                        <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Descending</option>
                    </select>
                </div>
                
                <div class="md:self-end">
                    <button type="submit" class="w-full md:w-auto bg-green-800 hover:bg-green-700 text-white font-medium py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                        Apply Filters
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Fruits Grid -->
        @if($fruits->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($fruits as $fruit)
                    <x-fruit.card :fruit="$fruit" />
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-8">
                {{ $fruits->withQueryString()->links() }}
            </div>
        @else
            <div class="text-center py-12 bg-gray-100 dark:bg-gray-800 rounded-lg">
                <p class="text-xl text-gray-600 dark:text-gray-400">No fruits found matching your criteria.</p>
                <a href="{{ route('fruits.index') }}" class="mt-4 inline-block text-green-800 dark:text-yellow-400 hover:underline">Clear filters</a>
            </div>
        @endif
    </div>
</div>
</x-layout.app>
