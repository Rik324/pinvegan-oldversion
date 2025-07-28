@props(['fruit'])

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
    <div class="md:flex">
        <div class="md:w-1/2">
            @if($fruit->image)
                <img src="{{ $fruit->image }}" alt="{{ $fruit->translate()->name }}" class="w-full h-80 object-contain">
            @else
                <div class="w-full h-80 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                    <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            @endif
        </div>
        
        <div class="md:w-1/2 p-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">{{ $fruit->translate()->name }}</h1>
            
            <div class="space-y-4">
                @if($fruit->translate()->description)
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">{{ __('Description') }}</h2>
                        <p class="text-gray-600 dark:text-gray-400">{{ $fruit->translate()->description }}</p>
                    </div>
                @endif
                
                <div class="grid grid-cols-2 gap-4">
                    @if($fruit->origin)
                        <div>
                            <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Origin</h2>
                            <p class="text-gray-600 dark:text-gray-400">{{ $fruit->origin }}</p>
                        </div>
                    @endif
                    
                    @if($fruit->seasonality)
                        <div>
                            <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Seasonality</h2>
                            <p class="text-gray-600 dark:text-gray-400">{{ $fruit->seasonality }}</p>
                        </div>
                    @endif
                    
                    @if($fruit->translate()->taste_profile)
                        <div>
                            <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ __('Taste Profile') }}</h2>
                            <p class="text-gray-600 dark:text-gray-400">{{ $fruit->translate()->taste_profile }}</p>
                        </div>
                    @endif
                    
                    @if($fruit->nutritional_benefits)
                        <div>
                            <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Nutritional Benefits</h2>
                            <p class="text-gray-600 dark:text-gray-400">{{ $fruit->nutritional_benefits }}</p>
                        </div>
                    @endif
                </div>
                
                <div class="pt-4">
                    <form action="{{ route('quote.add') }}?locale={{ app()->getLocale() }}" method="POST" class="flex flex-col sm:flex-row items-center gap-4">
                        @csrf
                        <input type="hidden" name="fruit_id" value="{{ $fruit->id }}">
                        
                        <div class="w-full sm:w-1/3">
                            <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Quantity</label>
                            <input type="number" name="quantity" id="quantity" min="1" value="1" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                        </div>
                        
                        <button type="submit" class="w-full sm:w-auto bg-green-800 hover:bg-green-700 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 transition duration-300 mt-6">
                            Add to Quote
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
