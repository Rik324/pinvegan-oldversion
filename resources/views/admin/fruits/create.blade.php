<x-layout.app>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('admin.create_fruit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 flex space-x-6">
                <a href="{{ route('admin.fruits.index') }}" class="text-green-800 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    {{ __('admin.back') }} {{ __('admin.all_fruits') }}
                </a>
                <a href="{{ route('admin.dashboard') }}" class="text-green-800 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    {{ __('admin.back') }} {{ __('admin.dashboard') }}
                </a>
            </div>

            <x-admin.form :action="route('admin.fruits.store')" method="POST" enctype="multipart/form-data">
                <!-- Language Tabs -->
                <div class="mb-6 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="languageTabs" role="tablist">
                        <li class="mr-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg border-green-600 text-green-600" id="english-tab" data-tabs-target="#english" type="button" role="tab" aria-controls="english" aria-selected="true">{{ __('admin.english') }}</button>
                        </li>
                        <li class="mr-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="thai-tab" data-tabs-target="#thai" type="button" role="tab" aria-controls="thai" aria-selected="false">{{ __('admin.thai') }}</button>
                        </li>
                        <li class="mr-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="chinese-tab" data-tabs-target="#chinese" type="button" role="tab" aria-controls="chinese" aria-selected="false">{{ __('admin.chinese') }}</button>
                        </li>
                    </ul>
                </div>

                <!-- Tab Content -->
                <div id="languageTabContent">
                    <!-- English Content -->
                    <div class="block" id="english" role="tabpanel" aria-labelledby="english-tab">
                        <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800 mb-6">
                            <h3 class="text-lg font-medium mb-4">{{ __('admin.english_content') }}</h3>
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <x-input-label for="en_name" :value="__('admin.name') . ' (' . __('admin.english') . ')'" />
                                    <x-text-input id="en_name" name="en[name]" type="text" class="mt-1 block w-full" :value="old('en.name')" required />
                                    <x-input-error :messages="$errors->get('en.name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="en_description" :value="__('admin.description') . ' (' . __('admin.english') . ')'" />
                                    <textarea id="en_description" name="en[description]" rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('en.description') }}</textarea>
                                    <x-input-error :messages="$errors->get('en.description')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="en_taste_profile" :value="__('admin.taste_profile') . ' (' . __('admin.english') . ')'" />
                                    <x-text-input id="en_taste_profile" name="en[taste_profile]" type="text" class="mt-1 block w-full" :value="old('en.taste_profile')" />
                                    <x-input-error :messages="$errors->get('en.taste_profile')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Thai Content -->
                    <div class="hidden" id="thai" role="tabpanel" aria-labelledby="thai-tab">
                        <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800 mb-6">
                            <h3 class="text-lg font-medium mb-4">{{ __('admin.thai_content') }}</h3>
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <x-input-label for="th_name" :value="__('admin.name') . ' (' . __('admin.thai') . ')'" />
                                    <x-text-input id="th_name" name="th[name]" type="text" class="mt-1 block w-full" :value="old('th.name')" />
                                    <x-input-error :messages="$errors->get('th.name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="th_description" :value="__('admin.description') . ' (' . __('admin.thai') . ')'" />
                                    <textarea id="th_description" name="th[description]" rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('th.description') }}</textarea>
                                    <x-input-error :messages="$errors->get('th.description')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="th_taste_profile" :value="__('admin.taste_profile') . ' (' . __('admin.thai') . ')'" />
                                    <x-text-input id="th_taste_profile" name="th[taste_profile]" type="text" class="mt-1 block w-full" :value="old('th.taste_profile')" />
                                    <x-input-error :messages="$errors->get('th.taste_profile')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Chinese Content -->
                    <div class="hidden" id="chinese" role="tabpanel" aria-labelledby="chinese-tab">
                        <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800 mb-6">
                            <h3 class="text-lg font-medium mb-4">{{ __('admin.chinese_content') }}</h3>
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <x-input-label for="zh_name" :value="__('admin.name') . ' (' . __('admin.chinese') . ')'" />
                                    <x-text-input id="zh_name" name="zh[name]" type="text" class="mt-1 block w-full" :value="old('zh.name')" required />
                                    <x-input-error :messages="$errors->get('zh.name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="zh_description" :value="__('admin.description') . ' (' . __('admin.chinese') . ')'" />
                                    <textarea id="zh_description" name="zh[description]" rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('zh.description') }}</textarea>
                                    <x-input-error :messages="$errors->get('zh.description')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="zh_taste_profile" :value="__('admin.taste_profile') . ' (' . __('admin.chinese') . ')'" />
                                    <x-text-input id="zh_taste_profile" name="zh[taste_profile]" type="text" class="mt-1 block w-full" :value="old('zh.taste_profile')" />
                                    <x-input-error :messages="$errors->get('zh.taste_profile')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Non-translatable fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <x-input-label for="category_id" :value="__('admin.category')" />
                        <select id="category_id" name="category_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="">-- {{ __('admin.select_category') }} --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="origin" :value="__('admin.origin')" />
                        <x-text-input id="origin" name="origin" type="text" class="mt-1 block w-full" :value="old('origin')" />
                        <x-input-error :messages="$errors->get('origin')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="seasonality" :value="__('admin.seasonality')" />
                        <x-text-input id="seasonality" name="seasonality" type="text" class="mt-1 block w-full" :value="old('seasonality')" />
                        <x-input-error :messages="$errors->get('seasonality')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="price" :value="__('admin.price')" />
                        <x-text-input id="price" name="price" type="number" step="0.01" min="0" class="mt-1 block w-full" :value="old('price')" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="image" :value="__('admin.image')" />
                        <input id="image" name="image" type="file" accept="image/*" class="mt-1 block w-full text-gray-700 dark:text-gray-300">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('admin.image_help') }}</p>
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <div class="flex items-center space-x-6">
                        <div class="flex items-center">
                            <input id="is_available" name="is_available" type="checkbox" class="h-4 w-4 text-green-800 focus:ring-green-700 border-gray-300 rounded" {{ old('is_available') ? 'checked' : '' }}>
                            <label for="is_available" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">
                                {{ __('admin.available') }}
                            </label>
                        </div>
                        
                        <div class="flex items-center">
                            <input id="is_featured" name="is_featured" type="checkbox" class="h-4 w-4 text-yellow-500 focus:ring-yellow-400 border-gray-300 rounded" {{ old('is_featured') ? 'checked' : '' }}>
                            <label for="is_featured" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">
                                {{ __('admin.featured') }}
                            </label>
                        </div>
                    </div>
                </div>

                <x-slot:actions>
                    <x-secondary-button onclick="window.history.back()">
                        {{ __('admin.cancel') }}
                    </x-secondary-button>
                    <x-primary-button>
                        {{ __('admin.create_fruit') }}
                    </x-primary-button>
                </x-slot:actions>
            </x-admin.form>
        </div>
    </div>

    @push('scripts')
    <script>
        // Simple tab functionality
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('[role="tab"]');
            const tabContents = document.querySelectorAll('[role="tabpanel"]');
            
            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    // Deactivate all tabs
                    tabs.forEach(t => {
                        t.classList.remove('border-green-600', 'text-green-600');
                        t.classList.add('border-transparent');
                        t.setAttribute('aria-selected', 'false');
                    });
                    
                    // Hide all tab contents
                    tabContents.forEach(content => {
                        content.classList.add('hidden');
                    });
                    
                    // Activate clicked tab
                    tab.classList.remove('border-transparent');
                    tab.classList.add('border-green-600', 'text-green-600');
                    tab.setAttribute('aria-selected', 'true');
                    
                    // Show corresponding content
                    const targetId = tab.getAttribute('data-tabs-target').substring(1);
                    document.getElementById(targetId).classList.remove('hidden');
                });
            });
        });
    </script>
    @endpush
</x-layout.app>
