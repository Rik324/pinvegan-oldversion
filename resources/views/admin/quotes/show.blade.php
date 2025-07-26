<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Quote Request Details') }}
            </h2>
            <a href="{{ route('admin.quotes.index') }}" class="px-4 py-2 bg-gray-800 dark:bg-gray-200 text-white dark:text-gray-800 rounded-md text-sm">
                Back to List
            </a>
        </div>
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
                        <h3 class="text-lg font-medium">Customer Information</h3>
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</p>
                                <p>{{ $quoteRequest->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</p>
                                <p>{{ $quoteRequest->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Phone</p>
                                <p>{{ $quoteRequest->phone ?? 'Not provided' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Date Submitted</p>
                                <p>{{ $quoteRequest->created_at->format('F d, Y h:i A') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-medium">Status</h3>
                            <form action="{{ route('admin.quotes.update-status', $quoteRequest) }}" method="POST" class="flex items-center space-x-2">
                                @csrf
                                @method('PUT')
                                <select name="status" class="rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                    <option value="new" {{ $quoteRequest->status === 'new' ? 'selected' : '' }}>New</option>
                                    <option value="responded" {{ $quoteRequest->status === 'responded' ? 'selected' : '' }}>Responded</option>
                                    <option value="completed" {{ $quoteRequest->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md text-sm hover:bg-green-700">
                                    Update Status
                                </button>
                            </form>
                        </div>
                        <div class="mt-2">
                            @php
                                $statusColors = [
                                    'new' => 'bg-indigo-100 text-indigo-800',
                                    'responded' => 'bg-amber-100 text-amber-800',
                                    'completed' => 'bg-emerald-100 text-emerald-800'
                                ];
                                $statusClass = $statusColors[$quoteRequest->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-2 py-1 rounded text-xs font-semibold {{ $statusClass }}">
                                {{ ucfirst($quoteRequest->status) }}
                            </span>
                        </div>
                    </div>

                    @if($quoteRequest->message)
                        <div class="mb-6">
                            <h3 class="text-lg font-medium">Message</h3>
                            <div class="mt-2 p-4 bg-gray-100 dark:bg-gray-700 rounded-md">
                                {{ $quoteRequest->message }}
                            </div>
                        </div>
                    @endif

                    <div class="mb-6">
                        <h3 class="text-lg font-medium">Requested Items</h3>
                        <div class="mt-4 overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fruit</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Category</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Quantity</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse($quoteRequest->fruits as $fruit)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    @if($fruit->image)
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ $fruit->image }}" alt="{{ $fruit->name }}">
                                                        </div>
                                                    @endif
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                            {{ $fruit->name }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $fruit->category->name ?? 'Uncategorized' }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 dark:text-gray-100">{{ $fruit->pivot->quantity }}</div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                                No items in this quote request.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('admin.quotes.index') }}" class="px-4 py-2 bg-gray-800 dark:bg-gray-200 text-white dark:text-gray-800 rounded-md text-sm">
                            Back to List
                        </a>
                        <form action="{{ route('admin.quotes.destroy', $quoteRequest) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md text-sm hover:bg-red-700"
                                    onclick="return confirm('Are you sure you want to delete this quote request?')">
                                Delete Quote Request
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
