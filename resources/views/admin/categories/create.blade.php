<x-layout.app>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Add New Category
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('admin.categories.index') }}" class="text-green-800 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300">
                    &larr; Back to All Categories
                </a>
            </div>

            <x-admin.form :action="route('admin.categories.store')" method="POST">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="flex items-center">
                        <input id="is_active" name="is_active" type="checkbox" class="h-4 w-4 text-green-800 focus:ring-green-700 border-gray-300 rounded" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label for="is_active" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">
                            Active
                        </label>
                    </div>
                </div>

                <x-slot:actions>
                    <x-secondary-button onclick="window.history.back()">
                        Cancel
                    </x-secondary-button>
                    <x-primary-button>
                        Create Category
                    </x-primary-button>
                </x-slot:actions>
            </x-admin.form>
        </div>
    </div>
</x-layout.app>
