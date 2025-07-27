<x-layout.app>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('admin.manage_fruits') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('admin.dashboard') }}" class="text-green-800 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    {{ __('admin.back') }} {{ __('admin.dashboard') }}
                </a>
            </div>
            
            <div class="mb-6 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('admin.all_fruits') }}</h1>
                <a href="{{ route('admin.fruits.create') }}" class="bg-green-800 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('admin.create_fruit') }}
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <x-admin.table :headers="['ID', __('admin.image'), __('admin.name'), __('admin.category'), __('admin.is_available'), __('admin.is_featured')]" :actions="true">
                @forelse($fruits as $fruit)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $fruit->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($fruit->image)
                                <img src="{{ $fruit->image }}" alt="{{ $fruit->name }}" class="h-10 w-10 rounded-full object-cover">
                            @else
                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-500 text-xs">No img</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ $fruit->translate(app()->getLocale())->name }}
                            @if(app()->getLocale() !== 'en')
                                <span class="text-xs text-gray-500 block">({{ $fruit->translate('en')->name }})</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            @if(is_object($fruit->category))
                                {{ $fruit->category->translate()->name }}
                            @else
                                {{ 'Uncategorized' }}
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            @if($fruit->is_available)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ __('Yes') }}
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    {{ __('No') }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            @if($fruit->is_featured)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    {{ __('admin.is_featured') }}
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    {{ __('Standard') }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
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
                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 text-center">
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
