<x-layout.app>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-6">Welcome to the Admin Dashboard</h1>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <a href="{{ route('admin.fruits.index') }}" class="block p-6 bg-green-800 text-white rounded-lg shadow-md hover:bg-green-700 transition">
                            <h2 class="text-xl font-bold mb-2">Manage Fruits</h2>
                            <p>Add, edit, and delete fruits in your catalog.</p>
                        </a>
                        
                        <a href="{{ route('admin.categories.index') }}" class="block p-6 bg-yellow-500 text-gray-900 rounded-lg shadow-md hover:bg-yellow-400 transition">
                            <h2 class="text-xl font-bold mb-2">Manage Categories</h2>
                            <p>Organize your fruits with categories.</p>
                        </a>
                        
                        <a href="{{ route('admin.quotes.index') }}" class="block p-6 bg-gray-700 text-white rounded-lg shadow-md hover:bg-gray-600 transition">
                            <h2 class="text-xl font-bold mb-2">Quote Requests</h2>
                            <p>View and manage customer quote requests.</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
