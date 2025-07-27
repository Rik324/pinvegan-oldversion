<x-layout.app>
    <x-slot:header>
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('admin.dashboard') }}
            </h2>
            <x-admin.language-switcher class="ml-4" />
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-6">{{ __('admin.dashboard') }}</h1>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <a href="{{ route('admin.fruits.index') }}" class="block p-6 bg-green-800 text-white rounded-lg shadow-md hover:bg-green-700 transition">
                            <h2 class="text-xl font-bold mb-2">{{ __('admin.manage_fruits') }}</h2>
                            <p>{{ __('admin.all_fruits') }}</p>
                        </a>
                        
                        <a href="{{ route('admin.categories.index') }}" class="block p-6 bg-yellow-500 text-gray-900 rounded-lg shadow-md hover:bg-yellow-400 transition">
                            <h2 class="text-xl font-bold mb-2">{{ __('admin.manage_categories') }}</h2>
                            <p>{{ __('admin.category') }}</p>
                        </a>
                        
                        <a href="{{ route('admin.quotes.index') }}" class="block p-6 bg-gray-700 text-white rounded-lg shadow-md hover:bg-gray-600 transition">
                            <h2 class="text-xl font-bold mb-2">{{ __('admin.manage_quotes') }}</h2>
                            <p>{{ __('admin.quotes') }}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
