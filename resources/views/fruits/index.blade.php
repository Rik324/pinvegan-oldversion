<x-layout.app>
    <x-slot:header>
        <h2 class="mt-4 text-xl font-semibold leading-tight text-yellow-300 dark:text-gray-200">
            {{ __('frontend.our_fruits') }}
        </h2>
    </x-slot>
<div class="bg-white dark:bg-gray-900">
    <div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
     
        <!-- Filters and Sorting -->
        <div class="p-4 mb-8 bg-gray-100 rounded-lg dark:bg-gray-800">
            <form action="{{ route('fruits.index') }}" method="GET" class="flex flex-col gap-4 md:flex-row">
                <input type="hidden" name="locale" value="{{ app()->getLocale() }}">
                <div class="md:w-1/3">
                    <label for="category_id" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('frontend.filter_by_category') }}</label>
                    <select name="category_id" id="category_id" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-yellow-500 focus:ring focus:ring-yellow-200 focus:ring-opacity-50">
                        <option value="">{{ __('frontend.all_categories') }}</option>
                        @foreach($topLevelCategories as $topCategory)
                            <!-- Parent category -->
                            <option value="{{ $topCategory->id }}" {{ request('category_id') == $topCategory->id ? 'selected' : '' }}>{{ $topCategory->name }}</option>
                            
                            <!-- Child categories with indentation -->
                            @foreach($topCategory->children as $childCategory)
                                <option value="{{ $childCategory->id }}" {{ request('category_id') == $childCategory->id ? 'selected' : '' }}>&nbsp;&nbsp;&nbsp;&nbsp;{{ $childCategory->name }}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
                
                <div class="md:w-1/3">
                    <label for="sort" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('frontend.sort_by') }}</label>
                    <select name="sort" id="sort" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-yellow-500 focus:ring focus:ring-yellow-200 focus:ring-opacity-50">
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>{{ __('frontend.sort_name') }}</option>
                        <option value="origin" {{ request('sort') == 'origin' ? 'selected' : '' }}>{{ __('frontend.sort_origin') }}</option>
                        <option value="seasonality" {{ request('sort') == 'seasonality' ? 'selected' : '' }}>{{ __('frontend.sort_seasonality') }}</option>
                    </select>
                </div>
                
                <div class="md:w-1/3">
                    <label for="direction" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('frontend.sort_direction') }}</label>
                    <select name="direction" id="direction" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-yellow-500 focus:ring focus:ring-yellow-200 focus:ring-opacity-50">
                        <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>{{ __('frontend.ascending') }}</option>
                        <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>{{ __('frontend.descending') }}</option>
                    </select>
                </div>
                
                <div class="md:self-end">
                    <button type="submit" class="px-4 py-2 w-full font-medium text-white bg-green-800 rounded md:w-auto hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                        {{ __('frontend.apply_filters') }}
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Fruits Grid -->
        @if($fruits->count() > 0)
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($fruits as $fruit)
                    <x-fruit.card :fruit="$fruit" />
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-8">
                {{ $fruits->withQueryString()->links() }}
            </div>
        @else
            <div class="py-12 text-center bg-gray-100 rounded-lg dark:bg-gray-800">
                <p class="text-xl text-gray-600 dark:text-gray-400">{{ __('frontend.no_products_found') }}</p>
                <a href="{{ route('fruits.index') }}?locale={{ app()->getLocale() }}" class="inline-block mt-4 text-green-800 dark:text-yellow-400 hover:underline">{{ __('frontend.clear_filters') }}</a>
            </div>
        @endif
    </div>
</div>
</x-layout.app>
