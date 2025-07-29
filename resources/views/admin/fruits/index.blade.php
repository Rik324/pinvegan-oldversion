<x-layout.app>
    <x-slot:header>
        <h2 class="text-xl font-semibold leading-tight text-yellow-300 dark:text-gray-200">
            {{ __('admin.manage_fruits') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center text-green-800 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    {{ __('admin.back') }} {{ __('admin.dashboard') }}
                </a>
            </div>
            
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('admin.all_fruits') }}</h1>
                <a href="{{ route('admin.fruits.create') }}" class="px-4 py-2 font-bold text-white bg-green-800 rounded hover:bg-green-700">
                    {{ __('admin.create_fruit') }}
                </a>
            </div>

            @if(session('success'))
                <div class="p-4 mb-6 text-green-700 bg-green-100 border-l-4 border-green-500" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 mb-6 text-red-700 bg-red-100 border-l-4 border-red-500" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <x-admin.table :headers="['ID', __('admin.image'), __('admin.name'), __('admin.category'), __('admin.is_available'), __('admin.is_featured')]" :actions="true">
                @forelse($fruits as $fruit)
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                            {{ $fruit->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($fruit->image)
                                <img src="{{ asset($fruit->image) }}" alt="{{ $fruit->name }}" class="object-cover w-10 h-10 rounded-full">
                            @else
                                <div class="flex justify-center items-center w-10 h-10 bg-gray-200 rounded-full">
                                    <span class="text-xs text-gray-500">No img</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
                            {{ $fruit->translate(app()->getLocale())->name }}
                            @if(app()->getLocale() !== 'en')
                                <span class="block text-xs text-gray-500">({{ $fruit->translate('en')->name }})</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                            @if(is_object($fruit->category))
                                @php
                                    $category = $fruit->category;
                                    
                                    // Get full category hierarchy path
                                    $categoryPath = '';
                                    $ancestors = collect([]);
                                    
                                    // Build ancestors collection
                                    $currentCategory = $category;
                                    while ($currentCategory) {
                                        $ancestors->prepend($currentCategory);
                                        $currentCategory = $currentCategory->parent;
                                    }
                                    
                                    // Build path string
                                    $categoryPath = $ancestors->map(function($cat) {
                                        $locale = app()->getLocale();
                                        return $cat->translate($locale)->name ?? $cat->translate('en')->name ?? 'Unnamed Category';
                                    })->implode(' > ');
                                @endphp
                                <span class="whitespace-normal">
                                    @if($category->parent_id)
                                        <span class="text-gray-500">{{ $categoryPath }}</span>
                                    @else
                                        <span class="font-medium">{{ $category->translate(app()->getLocale())->name ?? $category->translate('en')->name ?? 'Unnamed Category' }}</span>
                                    @endif
                                </span>
                            @else
                                {{ 'Uncategorized' }}
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                            @if($fruit->is_available)
                                <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                    {{ __('Yes') }}
                                </span>
                            @else
                                <span class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                    {{ __('admin.no') }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                            @if($fruit->is_featured)
                                <span class="inline-flex px-2 text-xs font-semibold leading-5 text-yellow-800 bg-yellow-100 rounded-full">
                                    {{ __('admin.is_featured') }}
                                </span>
                            @else
                                <span class="inline-flex px-2 text-xs font-semibold leading-5 text-gray-800 bg-gray-100 rounded-full">
                                    {{ __('admin.no') }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                            <div class="flex justify-end space-x-2">
                                <a href="{{ route('admin.fruits.edit', $fruit) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                    {{ __('admin.edit') }}
                                </a>
                                <form action="{{ route('admin.fruits.destroy', $fruit) }}" method="POST" class="inline" onsubmit="return confirmDelete(event);">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                        {{ __('admin.delete') }}
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-sm text-center text-gray-500 whitespace-nowrap dark:text-gray-400">
                            {{ __('No fruits found') }}. <a href="{{ route('admin.fruits.create') }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">{{ __('admin.create_fruit') }}</a>.
                        </td>
                    </tr>
                @endforelse
            </x-admin.table>

            <div class="mt-4">
                {{ $fruits->links() }}
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(event) {
            const message = "{{ __('admin.confirm_delete') }}";
            return confirm(message);
        }
    </script>
</x-layout.app>
