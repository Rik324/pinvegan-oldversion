<x-layout.app>
    <x-slot:header>
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Edit Fruit: {{ $fruit->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('admin.fruits.index') }}" class="text-green-800 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300">
                    &larr; Back to All Fruits
                </a>
            </div>

            <form action="{{ route('admin.fruits.update', $fruit) }}" method="POST" enctype="multipart/form-data" class="p-6 rounded-lg shadow-md bg-white dark:bg-gray-800">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="block mt-1 w-full" :value="old('name', $fruit->name)" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="category_id" :value="__('Category')" />
                        <select id="category_id" name="category_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $fruit->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    <div class="md:col-span-2">
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" rows="4" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">{{ old('description', $fruit->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="origin" :value="__('Origin')" />
                        <x-text-input id="origin" name="origin" type="text" class="block mt-1 w-full" :value="old('origin', $fruit->origin)" />
                        <x-input-error :messages="$errors->get('origin')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="taste_profile" :value="__('Taste Profile')" />
                        <x-text-input id="taste_profile" name="taste_profile" type="text" class="block mt-1 w-full" :value="old('taste_profile', $fruit->taste_profile)" />
                        <x-input-error :messages="$errors->get('taste_profile')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="seasonality" :value="__('Seasonality')" />
                        <x-text-input id="seasonality" name="seasonality" type="text" class="block mt-1 w-full" :value="old('seasonality', $fruit->seasonality)" />
                        <x-input-error :messages="$errors->get('seasonality')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input id="price" name="price" type="number" step="0.01" min="0" class="block mt-1 w-full" :value="old('price', $fruit->price)" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="image" :value="__('Image')" />
                        @if($fruit->image)
                            <div class="mt-2 mb-4">
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">Current image:</p>
                                <img src="{{ asset($fruit->image) }}" alt="{{ $fruit->name }}" class="object-cover w-32 h-32 rounded-lg">
                            </div>
                        @endif
                        <input id="image" name="image" type="file" accept="image/jpeg,image/png,image/gif,image/webp" class="block mt-1 w-full text-gray-700 dark:text-gray-300">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Max file size: 2MB. Accepted formats: JPEG, PNG, GIF, WebP. Leave empty to keep current image.</p>
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        @if(session('image_error'))
                            <p class="mt-2 text-sm text-red-600">{{ session('image_error') }}</p>
                        @endif
                    </div>

                    <div class="flex items-center space-x-6">
                        <div class="flex items-center">
                            <input id="is_available" name="is_available" type="checkbox" class="w-4 h-4 text-green-800 rounded border-gray-300 focus:ring-green-700" {{ old('is_available', $fruit->is_available) ? 'checked' : '' }}>
                            <label for="is_available" class="block ml-2 text-sm text-gray-900 dark:text-gray-300">
                                Available
                            </label>
                        </div>
                        
                        <div class="flex items-center">
                            <input id="is_featured" name="is_featured" type="checkbox" class="w-4 h-4 text-yellow-500 rounded border-gray-300 focus:ring-yellow-400" {{ old('is_featured', $fruit->is_featured) ? 'checked' : '' }}>
                            <label for="is_featured" class="block ml-2 text-sm text-gray-900 dark:text-gray-300">
                                Featured
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Form actions are at the bottom of the form -->
                <div class="mt-8 flex justify-end space-x-3">
                    <button type="button" onclick="window.history.back()" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                        Cancel
                    </button>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-800 dark:bg-green-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 dark:hover:bg-green-600 focus:bg-green-700 dark:focus:bg-green-600 active:bg-green-900 dark:active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        Update Fruit
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout.app>
