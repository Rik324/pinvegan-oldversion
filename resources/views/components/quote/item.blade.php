@props(['item'])

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
    <div class="flex flex-col sm:flex-row">
        <div class="sm:w-1/4 bg-gray-100 dark:bg-gray-700">
            @if($item->fruit->image)
                <img src="{{ $item->fruit->image }}" alt="{{ $item->fruit->name }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full min-h-[120px] bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                    <span class="text-gray-500 dark:text-gray-400">{{ __('frontend.no_image_available') }}</span>
                </div>
            @endif
        </div>
        
        <div class="p-4 sm:w-3/4">
            <div class="flex flex-col sm:flex-row justify-between">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ $item->fruit->name }}</h3>
                
                <div class="flex items-center space-x-2">
                    <form action="{{ route('quote.update', $item->id) }}" method="POST" class="flex items-center">
                        <input type="hidden" name="locale" value="{{ app()->getLocale() }}">
                        @csrf
                        @method('PUT')
                        <label for="quantity-{{ $item->id }}" class="sr-only">{{ __('frontend.quantity') }}</label>
                        <input type="number" name="quantity" id="quantity-{{ $item->id }}" min="1" value="{{ $item->quantity }}" 
                            class="w-16 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                        <button type="submit" class="ml-2 text-green-800 dark:text-yellow-400 hover:text-green-700 dark:hover:text-yellow-300">
                            <span class="sr-only">{{ __('frontend.update') }}</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                    </form>
                    
                    <form action="{{ route('quote.remove', $item->id) }}" method="POST">
                        <input type="hidden" name="locale" value="{{ app()->getLocale() }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                            <span class="sr-only">{{ __('frontend.remove') }}</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                @if($item->fruit->origin)
                    <p><span class="font-medium">{{ __('frontend.origin') }}:</span> {{ $item->fruit->origin }}</p>
                @endif
                
                @if($item->fruit->seasonality)
                    <p><span class="font-medium">{{ __('frontend.seasonality') }}:</span> {{ $item->fruit->seasonality }}</p>
                @endif
            </div>
            
            <div class="mt-4">
                <a href="{{ route('fruits.show', ['fruit' => $item->fruit, 'locale' => app()->getLocale()]) }}" class="text-green-800 dark:text-yellow-400 hover:underline text-sm">
                    {{ __('frontend.view_fruit_details') }}
                </a>
            </div>
        </div>
    </div>
</div>
