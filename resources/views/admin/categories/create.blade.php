<x-layout.app>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('admin.add_new_category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 flex space-x-6">
                <a href="{{ route('admin.categories.index') }}" class="text-green-800 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    {{ __('admin.back') }} {{ __('admin.all_categories') }}
                </a>
                <a href="{{ route('admin.dashboard') }}" class="text-green-800 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    {{ __('admin.back') }} {{ __('admin.dashboard') }}
                </a>
            </div>

            <!-- Error Messages -->            
            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <p class="font-bold">{{ __('admin.please_fix_errors') }}</p>
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <x-admin.form :action="route('admin.categories.store')" method="POST" novalidate>
                <!-- Language Tabs with Alpine.js -->
                <div x-data="{ activeTab: localStorage.getItem('activeLanguageTab') || 'english' }" class="mb-6">
                    <div class="mb-6 border-b border-gray-200 dark:border-gray-700">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" role="tablist">
                            <li class="mr-2" role="presentation">
                                <button 
                                    @click="activeTab = 'english'; localStorage.setItem('activeLanguageTab', 'english')" 
                                    :class="{'border-green-600 text-green-600': activeTab === 'english', 'border-transparent': activeTab !== 'english'}"
                                    class="inline-block p-4 rounded-t-lg border-b-2 hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" 
                                    type="button">{{ __('admin.english') }}</button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button 
                                    @click="activeTab = 'thai'; localStorage.setItem('activeLanguageTab', 'thai')" 
                                    :class="{'border-green-600 text-green-600': activeTab === 'thai', 'border-transparent': activeTab !== 'thai'}"
                                    class="inline-block p-4 rounded-t-lg border-b-2 hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" 
                                    type="button">{{ __('admin.thai') }}</button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button 
                                    @click="activeTab = 'chinese'; localStorage.setItem('activeLanguageTab', 'chinese')" 
                                    :class="{'border-green-600 text-green-600': activeTab === 'chinese', 'border-transparent': activeTab !== 'chinese'}"
                                    class="inline-block p-4 rounded-t-lg border-b-2 hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" 
                                    type="button">{{ __('admin.chinese') }}</button>
                            </li>
                        </ul>
                    </div>

                <!-- Tab Content -->
                <div>
                    <!-- English Content -->
                    <div x-show="activeTab === 'english'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                        <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800 mb-6">
                            <h3 class="text-lg font-medium mb-4">{{ __('admin.english_content') }}</h3>
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <x-input-label for="en_name" :value="__('admin.name') . ' (' . __('admin.english') . ')'" />
                                    <x-text-input id="en_name" name="en[name]" type="text" class="mt-1 block w-full" :value="old('en.name')" />
                                    <x-input-error :messages="$errors->get('en.name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="en_description" :value="__('admin.description') . ' (' . __('admin.english') . ')'" />
                                    <textarea id="en_description" name="en[description]" rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('en.description') }}</textarea>
                                    <x-input-error :messages="$errors->get('en.description')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Thai Content -->
                    <div x-show="activeTab === 'thai'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
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
                            </div>
                        </div>
                    </div>

                    <!-- Chinese Content -->
                    <div x-show="activeTab === 'chinese'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                        <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800 mb-6">
                            <h3 class="text-lg font-medium mb-4">{{ __('admin.chinese_content') }}</h3>
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <x-input-label for="zh_name" :value="__('admin.name') . ' (' . __('admin.chinese') . ')'" />
                                    <x-text-input id="zh_name" name="zh[name]" type="text" class="mt-1 block w-full" :value="old('zh.name')" />
                                    <x-input-error :messages="$errors->get('zh.name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="zh_description" :value="__('admin.description') . ' (' . __('admin.chinese') . ')'" />
                                    <textarea id="zh_description" name="zh[description]" rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('zh.description') }}</textarea>
                                    <x-input-error :messages="$errors->get('zh.description')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Non-translatable fields -->
                <div class="grid grid-cols-1 gap-6 mt-6">
                    <div class="flex items-center">
                        <input id="is_active" name="is_active" type="checkbox" class="h-4 w-4 text-green-800 focus:ring-green-700 border-gray-300 rounded" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label for="is_active" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">
                            {{ __('admin.active') }}
                        </label>
                        <x-input-error :messages="$errors->get('is_active')" class="mt-2 ml-2" />
                    </div>
                </div>

                <x-slot:actions>
                    <x-secondary-button onclick="window.history.back()">
                        {{ __('admin.cancel') }}
                    </x-secondary-button>
                    <x-primary-button>
                        {{ __('admin.create_category') }}
                    </x-primary-button>
                </x-slot:actions>
            </x-admin.form>
        </div>
    </div>

    <!-- No custom JavaScript needed as we're using Alpine.js -->
</x-layout.app>
