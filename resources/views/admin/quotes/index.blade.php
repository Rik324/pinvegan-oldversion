<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Quote Requests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-6">
                        <h3 class="text-lg font-medium">Quote Request Management</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">View and manage customer quote requests.</p>
                    </div>

                    <x-admin.table>
                        <x-slot name="header">
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Date</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </x-slot>
                        <x-slot name="body">
                            @forelse ($quoteRequests as $quoteRequest)
                                <tr>
                                    <td class="border px-4 py-2">{{ $quoteRequest->id }}</td>
                                    <td class="border px-4 py-2">{{ $quoteRequest->name }}</td>
                                    <td class="border px-4 py-2">{{ $quoteRequest->email }}</td>
                                    <td class="border px-4 py-2">{{ $quoteRequest->created_at->format('M d, Y') }}</td>
                                    <td class="border px-4 py-2">
                                        <span class="px-2 py-1 rounded text-xs font-semibold
                                            @if($quoteRequest->status == 'new') bg-blue-100 text-blue-800 @endif
                                            @if($quoteRequest->status == 'responded') bg-yellow-100 text-yellow-800 @endif
                                            @if($quoteRequest->status == 'completed') bg-green-100 text-green-800 @endif
                                        ">
                                            {{ ucfirst($quoteRequest->status) }}
                                        </span>
                                    </td>
                                    <td class="border px-4 py-2">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('admin.quotes.show', $quoteRequest) }}" 
                                               class="text-blue-600 hover:text-blue-900">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </a>
                                            
                                            <form action="{{ route('admin.quotes.destroy', $quoteRequest) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" 
                                                        onclick="return confirm('Are you sure you want to delete this quote request?')">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="border px-4 py-2 text-center">No quote requests found.</td>
                                </tr>
                            @endforelse
                        </x-slot>
                    </x-admin.table>

                    <div class="mt-4">
                        {{ $quoteRequests->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
