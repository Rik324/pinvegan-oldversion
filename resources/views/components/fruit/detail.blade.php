@props(['fruit'])

<div class="overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800">
    <div class="md:flex">
        <div class="md:w-1/2">
            @if($fruit->image)
                <img src="{{ asset($fruit->image) }}" alt="{{ $fruit->translate()->name }}" class="object-contain w-full h-80">
            @else
                <div class="flex justify-center items-center w-full h-80 bg-gray-200 dark:bg-gray-700">
                    <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            @endif
        </div>
        
        <div class="p-6 md:w-1/2">
            <h1 class="mb-4 text-3xl font-bold text-gray-900 dark:text-white">{{ $fruit->translate()->name }}</h1>
            
            <div class="space-y-4">
                @if($fruit->translate()->description)
                    <div>
                        <h2 class="mb-2 text-lg font-semibold text-gray-800 dark:text-gray-200">{{ __('frontend.description') }}</h2>
                        <p class="text-gray-600 dark:text-gray-400">{{ $fruit->translate()->description }}</p>
                    </div>
                @endif
                
                <div class="grid grid-cols-2 gap-4">
                    @if($fruit->origin)
                        <div>
                            <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ __('frontend.origin') }}</h2>
                            <p class="text-gray-600 dark:text-gray-400">{{ $fruit->origin }}</p>
                        </div>
                    @endif
                    
                    @if($fruit->seasonality)
                        <div>
                            <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ __('frontend.seasonality') }}</h2>
                            <p class="text-gray-600 dark:text-gray-400">{{ $fruit->seasonality }}</p>
                        </div>
                    @endif
                    
                    @if($fruit->category)
                        <div>
                            <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ __('frontend.category') }}</h2>
                            <p class="text-gray-600 dark:text-gray-400">{{ $fruit->category->translate()->name }}</p>
                        </div>
                    @endif
                    
                    @if($fruit->nutritional_benefits)
                        <div>
                            <h2 class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ __('frontend.nutritional_benefits') }}</h2>
                            <p class="text-gray-600 dark:text-gray-400">{{ $fruit->nutritional_benefits }}</p>
                        </div>
                    @endif
                </div>
                
                <div class="pt-4">
                    <form action="{{ route('quote.add') }}?locale={{ app()->getLocale() }}" method="POST" class="flex flex-col gap-4 items-center sm:flex-row">
                        @csrf
                        <input type="hidden" name="fruit_id" value="{{ $fruit->id }}">
                        
                        <div class="w-full sm:w-1/3">
                            <label for="quantity" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('frontend.quantity') }}</label>
                            <input type="number" name="quantity" id="quantity" min="1" value="1" class="w-full rounded-md border-gray-300 shadow-sm dark:border-gray-700 dark:bg-gray-800 focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                        </div>
                        
                        <button type="submit" class="px-4 py-2 mt-6 w-full text-white bg-green-800 rounded-md transition duration-300 sm:w-auto hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                            {{ __('frontend.add_to_quote') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
