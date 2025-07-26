<x-layout.app>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Add New Fruit
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('admin.fruits.index') }}" class="text-green-800 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300">
                    &larr; Back to All Fruits
                </a>
            </div>

            <x-admin.form :action="route('admin.fruits.store')" method="POST" enctype="multipart/form-data">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="category_id" :value="__('Category')" />
                        <select id="category_id" name="category_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    <div class="md:col-span-2">
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="origin" :value="__('Origin')" />
                        <x-text-input id="origin" name="origin" type="text" class="mt-1 block w-full" :value="old('origin')" />
                        <x-input-error :messages="$errors->get('origin')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="taste_profile" :value="__('Taste Profile')" />
                        <x-text-input id="taste_profile" name="taste_profile" type="text" class="mt-1 block w-full" :value="old('taste_profile')" />
                        <x-input-error :messages="$errors->get('taste_profile')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="seasonality" :value="__('Seasonality')" />
                        <x-text-input id="seasonality" name="seasonality" type="text" class="mt-1 block w-full" :value="old('seasonality')" />
                        <x-input-error :messages="$errors->get('seasonality')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input id="price" name="price" type="number" step="0.01" min="0" class="mt-1 block w-full" :value="old('price')" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="image" :value="__('Image')" />
                        <input id="image" name="image" type="file" accept="image/*" class="mt-1 block w-full text-gray-700 dark:text-gray-300">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Max file size: 2MB. Recommended dimensions: 800x600px.</p>
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <div class="flex items-center space-x-6">
                        <div class="flex items-center">
                            <input id="is_available" name="is_available" type="checkbox" class="h-4 w-4 text-green-800 focus:ring-green-700 border-gray-300 rounded" {{ old('is_available') ? 'checked' : '' }}>
                            <label for="is_available" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">
                                Available
                            </label>
                        </div>
                        
                        <div class="flex items-center">
                            <input id="is_featured" name="is_featured" type="checkbox" class="h-4 w-4 text-yellow-500 focus:ring-yellow-400 border-gray-300 rounded" {{ old('is_featured') ? 'checked' : '' }}>
                            <label for="is_featured" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">
                                Featured
                            </label>
                        </div>
                    </div>
                </div>

                <x-slot:actions>
                    <x-secondary-button onclick="window.history.back()">
                        Cancel
                    </x-secondary-button>
                    <x-primary-button>
                        Create Fruit
                    </x-primary-button>
                </x-slot:actions>
            </x-admin.form>
        </div>
    </div>
</x-layout.app>
