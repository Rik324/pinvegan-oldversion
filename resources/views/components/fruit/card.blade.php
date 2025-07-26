@props(['fruit'])

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:shadow-lg hover:-translate-y-1">
    <div class="h-48 overflow-hidden">
        @if($fruit->image)
            <img src="{{ $fruit->image }}" alt="{{ $fruit->name }}" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        @endif
    </div>
    
    <div class="p-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ $fruit->name }}</h3>
        
        @if($fruit->origin)
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                <span class="font-medium">Origin:</span> {{ $fruit->origin }}
            </p>
        @endif
        
        @if($fruit->seasonality)
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                <span class="font-medium">Season:</span> {{ $fruit->seasonality }}
            </p>
        @endif
        
        <div class="flex justify-between items-center mt-4">
            <a href="{{ route('fruits.show', $fruit) }}" class="text-green-800 dark:text-yellow-400 hover:underline font-medium">
                View Details
            </a>
            
            <form action="{{ route('quote.add') }}" method="POST">
                @csrf
                <input type="hidden" name="fruit_id" value="{{ $fruit->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="bg-green-800 hover:bg-green-700 text-white text-sm py-1 px-3 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 transition duration-300">
                    Add to Quote
                </button>
            </form>
        </div>
    </div>
</div>
