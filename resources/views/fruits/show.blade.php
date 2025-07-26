<x-layout.app>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $fruit->name }}
        </h2>
    </x-slot>
<div class="bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Breadcrumbs -->
        <x-ui.breadcrumb :items="[
            ['label' => 'Fruits', 'url' => route('fruits.index')],
            ['label' => $fruit->name]
        ]" />

        <!-- Fruit Details -->
        <x-fruit.detail :fruit="$fruit" />
        
        <!-- Related Fruits (if same category) -->
        @if($fruit->category)
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Other {{ $fruit->category }} Fruits</h2>
                
                @php
                    $relatedFruits = \App\Models\Fruit::where('category', $fruit->category)
                        ->where('id', '!=', $fruit->id)
                        ->take(4)
                        ->get();
                @endphp
                
                @if($relatedFruits->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
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
        <div class="mt-12 bg-yellow-400 dark:bg-yellow-600 rounded-lg p-6 text-center">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Need a Custom Quote?</h2>
            <p class="text-lg text-gray-800 dark:text-gray-200 mb-6 max-w-3xl mx-auto">
                Looking for bulk orders or specific varieties? Contact us for a personalized quote.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('quote.index') }}" class="bg-green-800 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
                    View Quote Request
                </a>
                <a href="{{ route('contact') }}" class="bg-white hover:bg-gray-100 text-green-800 font-bold py-2 px-6 rounded-lg border-2 border-green-800 transition duration-300">
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</div>
</x-layout.app>
