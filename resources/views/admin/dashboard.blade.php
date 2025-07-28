<x-layout.app>
    <x-slot:header>
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight text-yellow-300 dark:text-gray-200">
                {{ __('admin.dashboard') }}
            </h2>
    
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="mb-6 text-2xl font-bold">{{ __('admin.dashboard') }}</h1>
                    
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                        <a href="{{ route('admin.fruits.index') }}" class="block p-6 text-white bg-green-800 rounded-lg shadow-md transition hover:bg-green-700">
                            <h2 class="mb-2 text-xl font-bold">{{ __('admin.manage_fruits') }}</h2>
                            <p>{{ __('admin.all_fruits') }}</p>
                        </a>
                        
                        <a href="{{ route('admin.categories.index') }}" class="block p-6 text-gray-900 bg-yellow-500 rounded-lg shadow-md transition hover:bg-yellow-400">
                            <h2 class="mb-2 text-xl font-bold">{{ __('admin.manage_categories') }}</h2>
                            <p>{{ __('admin.category') }}</p>
                        </a>
                        
                        <a href="{{ route('admin.quotes.index') }}" class="block p-6 text-white bg-gray-700 rounded-lg shadow-md transition hover:bg-gray-600">
                            <h2 class="mb-2 text-xl font-bold">{{ __('admin.manage_quotes') }}</h2>
                            <p>{{ __('admin.quotes') }}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
