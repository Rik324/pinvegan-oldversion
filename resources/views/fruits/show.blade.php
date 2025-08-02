<x-layout.app>
    <x-slot:header>
        <h2 class="mt-4 text-xl font-semibold leading-tight text-yellow-300 dark:text-gray-200">
            {{ $fruit->translate()->name }}
        </h2>
    </x-slot>
<div class="bg-white dark:bg-gray-900">
    <div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
    
        
        <!-- Breadcrumbs -->
        <x-ui.breadcrumb :items="[
            ['label' => __('frontend.fruits'), 'url' => route('fruits.index') . '?locale=' . app()->getLocale()],
            ['label' => $fruit->translate()->name]
        ]" />

        <!-- Fruit Details -->
        <x-fruit.detail :fruit="$fruit" />
        
        <!-- Related Fruits (if same category) -->
        @if($fruit->category)
            <div class="mt-12">
                <h2 class="mb-6 text-2xl font-bold text-gray-900 dark:text-white">{{ $fruit->category->translate()->name }}</h2>
                
                @php
                    $relatedFruits = \App\Models\Fruit::where('category_id', $fruit->category_id)
                        ->where('id', '!=', $fruit->id)
                        ->take(4)
                        ->get();
                @endphp
                
                @if($relatedFruits->count() > 0)
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach($relatedFruits as $relatedFruit)
                            <x-fruit.card :fruit="$relatedFruit" />
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600 dark:text-gray-400">No related fruits found.</p>
                @endif
            </div>
        @endif
        
        <!-- Call to Action -->
        <div class="p-6 mt-12 text-center bg-yellow-400 rounded-lg dark:bg-yellow-600">
            <h2 class="mb-4 text-2xl font-bold text-gray-900 dark:text-white">{{ __('frontend.need_custom_quote') }}</h2>
            <p class="mx-auto mb-6 max-w-3xl text-lg text-gray-800 dark:text-gray-200">
                {{ __('frontend.bulk_order_description') }}
            </p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route('quote.index') }}?locale={{ app()->getLocale() }}" class="px-6 py-2 font-bold text-white bg-green-800 rounded-lg transition duration-300 hover:bg-green-700">
                    {{ __('frontend.view_quote_request') }}
                </a>
                <a href="{{ route('contact') }}?locale={{ app()->getLocale() }}" class="px-6 py-2 font-bold text-green-800 bg-white rounded-lg border-2 border-green-800 transition duration-300 hover:bg-gray-100">
                    {{ __('frontend.contact_us') }}
                </a>
            </div>
        </div>
    </div>
</div>
</x-layout.app>
