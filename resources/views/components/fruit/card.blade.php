@props(['fruit'])

<div class="overflow-hidden bg-white rounded-lg shadow-md transition-transform duration-300 dark:bg-gray-800 hover:shadow-lg hover:-translate-y-1">
    <div class="overflow-hidden aspect-square">
        @if($fruit->image)
            <img src="{{ Storage::disk('public')->url($fruit->image) }}" alt="{{ $fruit->translate(app()->getLocale())->name ?? $fruit->translate('en')->name ?? 'Fruit Image' }}" class="object-contain w-full h-full">
        @else
            <div class="flex justify-center items-center w-full h-full bg-gray-200 dark:bg-gray-700">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        @endif
    </div>
    
    <div class="p-4">
        <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">{{ $fruit->translate(app()->getLocale())->name ?? $fruit->translate('en')->name ?? 'Unnamed Fruit' }}</h3>
        
        <p class="mb-3 text-sm text-gray-600 dark:text-gray-400 line-clamp-2">{{ $fruit->translate(app()->getLocale())->description ?? $fruit->translate('en')->description ?? '' }}</p>
        
        @if($fruit->translate(app()->getLocale())->origin ?? $fruit->translate('en')->origin ?? false)
            <p class="mb-2 text-sm text-gray-600 dark:text-gray-400">
                <span class="font-medium">{{ __('frontend.origin') }}:</span> {{ $fruit->translate(app()->getLocale())->origin ?? $fruit->translate('en')->origin ?? '' }}
            </p>
        @endif
        
        @if($fruit->translate(app()->getLocale())->seasonality ?? $fruit->translate('en')->seasonality ?? false)
            <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                <span class="font-medium">{{ __('frontend.seasonality') }}:</span> {{ $fruit->translate(app()->getLocale())->seasonality ?? $fruit->translate('en')->seasonality ?? '' }}
            </p>
        @endif

        @if($fruit->price)
            <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                <span class="font-medium">{{ __('frontend.price') }}:</span> {{ $fruit->price }}
            </p>
        @endif
        
        <div class="flex justify-between items-center mt-4">
            <a href="{{ route('fruits.show', $fruit) }}?locale={{ app()->getLocale() }}" class="font-medium text-green-800 dark:text-yellow-400 hover:underline">
                {{ __('frontend.view_details') }}
            </a>
            
            <form action="{{ route('quote.add') }}?locale={{ app()->getLocale() }}" method="POST">
                @csrf
                <input type="hidden" name="fruit_id" value="{{ $fruit->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="px-3 py-1 text-sm text-white bg-green-800 rounded-md transition duration-300 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                    {{ __('frontend.add_to_quote') }}
                </button>
            </form>
        </div>
    </div>
</div>
