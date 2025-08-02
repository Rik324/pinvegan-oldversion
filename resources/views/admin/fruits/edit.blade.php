<x-layout.app>
    <x-slot:header>
        <h2 class="mt-4 text-xl font-semibold leading-tight text-yellow-300 dark:text-gray-200">
            {{ __('admin.edit_fruit') }}: {{ $fruit->translate('en')->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex mb-6 space-x-6">
                <a href="{{ route('admin.fruits.index') }}" class="flex items-center text-green-800 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    {{ __('admin.back') }} {{ __('admin.all_fruits') }}
                </a>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center text-green-800 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    {{ __('admin.back') }} {{ __('admin.dashboard') }}
                </a>
            </div>

            <form action="{{ route('admin.fruits.update', $fruit) }}" method="POST" enctype="multipart/form-data" class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                @csrf
                @method('PUT')
                
                <!-- Language Tabs with Alpine.js -->
                <div x-data="{ activeTab: localStorage.getItem('activeLanguageTab') || 'english' }" class="mb-6">
                    <div class="mb-6 border-b border-gray-200 dark:border-gray-700">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" role="tablist">
                            <li class="mr-2" role="presentation">
                                <button 
                                    @click="activeTab = 'english'; localStorage.setItem('activeLanguageTab', 'english')" 
                                    :class="{'border-green-600 text-green-600': activeTab === 'english', 'border-transparent': activeTab !== 'english'}"
                                    class="inline-block p-4 rounded-t-lg border-b-2 hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" 
                                    type="button">English</button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button 
                                    @click="activeTab = 'thai'; localStorage.setItem('activeLanguageTab', 'thai')" 
                                    :class="{'border-green-600 text-green-600': activeTab === 'thai', 'border-transparent': activeTab !== 'thai'}"
                                    class="inline-block p-4 rounded-t-lg border-b-2 hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" 
                                    type="button">Thai</button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button 
                                    @click="activeTab = 'chinese'; localStorage.setItem('activeLanguageTab', 'chinese')" 
                                    :class="{'border-green-600 text-green-600': activeTab === 'chinese', 'border-transparent': activeTab !== 'chinese'}"
                                    class="inline-block p-4 rounded-t-lg border-b-2 hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" 
                                    type="button">Chinese</button>
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Tab Content -->
                    <div>
                    <!-- English Content -->
                    <div x-show="activeTab === 'english'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                        <div class="p-4 mb-6 bg-gray-50 rounded-lg dark:bg-gray-800">
                            <h3 class="mb-4 text-lg font-medium">English Content</h3>
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <x-input-label for="en_name" :value="__('Name (English)')" />
                                    <x-text-input id="en_name" name="en[name]" type="text" class="block mt-1 w-full" :value="old('en.name', $fruit->translate('en')->name)" required />
                                    <x-input-error :messages="$errors->get('en.name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="en_description" :value="__('Description (English)')" />
                                    <textarea id="en_description" name="en[description]" rows="4" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">{{ old('en.description', $fruit->translate('en')->description) }}</textarea>
                                    <x-input-error :messages="$errors->get('en.description')" class="mt-2" />
                                </div>
                                
                                <div>
                                    <x-input-label for="en_origin" :value="__('Origin (English)')" />
                                    <x-text-input id="en_origin" name="en[origin]" type="text" class="block mt-1 w-full" :value="old('en.origin', $fruit->translate('en')->origin)" />
                                    <x-input-error :messages="$errors->get('en.origin')" class="mt-2" />
                                </div>
                                
                                <div>
                                    <x-input-label for="en_seasonality" :value="__('Seasonality (English)')" />
                                    <x-text-input id="en_seasonality" name="en[seasonality]" type="text" class="block mt-1 w-full" :value="old('en.seasonality', $fruit->translate('en')->seasonality)" />
                                    <x-input-error :messages="$errors->get('en.seasonality')" class="mt-2" />
                                </div>


                            </div>
                        </div>
                    </div>
                    
                    <!-- Thai Content -->
                    <div x-show="activeTab === 'thai'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                        <div class="p-4 mb-6 bg-gray-50 rounded-lg dark:bg-gray-800">
                            <h3 class="mb-4 text-lg font-medium">Thai Content</h3>
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <x-input-label for="th_name" :value="__('Name (Thai)')" />
                                    <x-text-input id="th_name" name="th[name]" type="text" class="block mt-1 w-full" :value="old('th.name', $fruit->translate('th')->name)" required />
                                    <x-input-error :messages="$errors->get('th.name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="th_description" :value="__('Description (Thai)')" />
                                    <textarea id="th_description" name="th[description]" rows="4" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">{{ old('th.description', $fruit->translate('th')->description) }}</textarea>
                                    <x-input-error :messages="$errors->get('th.description')" class="mt-2" />
                                </div>
                                
                                <div>
                                    <x-input-label for="th_origin" :value="__('Origin (Thai)')" />
                                    <x-text-input id="th_origin" name="th[origin]" type="text" class="block mt-1 w-full" :value="old('th.origin', $fruit->translate('th')->origin)" />
                                    <x-input-error :messages="$errors->get('th.origin')" class="mt-2" />
                                </div>
                                
                                <div>
                                    <x-input-label for="th_seasonality" :value="__('Seasonality (Thai)')" />
                                    <x-text-input id="th_seasonality" name="th[seasonality]" type="text" class="block mt-1 w-full" :value="old('th.seasonality', $fruit->translate('th')->seasonality)" />
                                    <x-input-error :messages="$errors->get('th.seasonality')" class="mt-2" />
                                </div>


                            </div>
                        </div>
                    </div>
                    
                    <!-- Chinese Content -->
                    <div x-show="activeTab === 'chinese'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                        <div class="p-4 mb-6 bg-gray-50 rounded-lg dark:bg-gray-800">
                            <h3 class="mb-4 text-lg font-medium">Chinese Content</h3>
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <x-input-label for="zh_name" :value="__('Name (Chinese)')" />
                                    <x-text-input id="zh_name" name="zh[name]" type="text" class="block mt-1 w-full" :value="old('zh.name', $fruit->translate('zh')->name)" required />
                                    <x-input-error :messages="$errors->get('zh.name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="zh_description" :value="__('Description (Chinese)')" />
                                    <textarea id="zh_description" name="zh[description]" rows="4" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">{{ old('zh.description', $fruit->translate('zh')->description) }}</textarea>
                                    <x-input-error :messages="$errors->get('zh.description')" class="mt-2" />
                                </div>
                                
                                <div>
                                    <x-input-label for="zh_origin" :value="__('Origin (Chinese)')" />
                                    <x-text-input id="zh_origin" name="zh[origin]" type="text" class="block mt-1 w-full" :value="old('zh.origin', $fruit->translate('zh')->origin)" />
                                    <x-input-error :messages="$errors->get('zh.origin')" class="mt-2" />
                                </div>
                                
                                <div>
                                    <x-input-label for="zh_seasonality" :value="__('Seasonality (Chinese)')" />
                                    <x-text-input id="zh_seasonality" name="zh[seasonality]" type="text" class="block mt-1 w-full" :value="old('zh.seasonality', $fruit->translate('zh')->seasonality)" />
                                    <x-input-error :messages="$errors->get('zh.seasonality')" class="mt-2" />
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Non-translatable fields -->
                <div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-2">
                    <div>
                        <x-input-label for="category_id" :value="__('admin.category')" />
                        <select id="category_id" name="category_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                            <option value="">-- {{ __('admin.select_category') }} --</option>
                            @foreach($parentCategories as $parentCategory)
                                <option value="{{ $parentCategory->id }}" {{ old('category_id', $fruit->category_id) == $parentCategory->id ? 'selected' : '' }}>
                                    {{ $parentCategory->translate(app()->getLocale())->name ?? $parentCategory->translate('en')->name ?? 'Unnamed Category' }}
                                </option>
                                @foreach($parentCategory->children as $childCategory)
                                    <option value="{{ $childCategory->id }}" {{ old('category_id', $fruit->category_id) == $childCategory->id ? 'selected' : '' }}>
                                        &nbsp;&nbsp;└─ {{ $childCategory->translate(app()->getLocale())->name ?? $childCategory->translate('en')->name ?? 'Unnamed Category' }}
                                    </option>
                                @endforeach
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('admin.select_category_help') }}</p>
                    </div>



                    <div>
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input id="price" name="price" type="number" step="0.01" min="0" class="block mt-1 w-full" :value="old('price', $fruit->price)" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div class="md:col-span-2">
                        <div class="mb-4">
                            <x-input-label for="image" :value="__('Current Image')" />
                            @if($fruit->image)
                                <div class="mt-2">
                                    <img src="{{ asset($fruit->image) }}" alt="{{ $fruit->translate('en')->name }}" class="object-cover w-auto h-32 rounded-md">
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $fruit->image }}</p>
                                </div>
                            @else
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">No image uploaded</p>
                            @endif
                        </div>
                        
                        <x-input-label for="image" :value="__('Upload New Image')" />
                        <input id="image" name="image" type="file" accept="image/*" class="block mt-1 w-full text-gray-700 dark:text-gray-300">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Max file size: 2MB. Recommended dimensions: 800x600px.</p>
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
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

                <div class="flex justify-end mt-6 space-x-4">
                    <a href="{{ route('admin.fruits.index') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase bg-white rounded-md border border-gray-300 shadow-sm transition duration-150 ease-in-out dark:bg-gray-800 dark:border-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-green-800 rounded-md border border-transparent transition duration-150 ease-in-out dark:bg-green-700 hover:bg-green-700 dark:hover:bg-green-600 focus:bg-green-700 dark:focus:bg-green-600 active:bg-green-900 dark:active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                        Update Fruit
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- No custom JavaScript needed as we're using Alpine.js -->
</x-layout.app>
