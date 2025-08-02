<x-layout.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="mt-4 text-xl font-semibold leading-tight text-yellow-300 dark:text-gray-200">
                {{ __('Quote Request Details') }}
            </h2>
            <a href="{{ route('admin.quotes.index') }}" class="px-4 py-2 text-sm text-white bg-gray-800 rounded-md dark:bg-gray-200 dark:text-gray-800">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded border border-green-400">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-6">
                        <h3 class="text-lg font-medium">Customer Information</h3>
                        <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-2">
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
                                <p>{{ $quoteRequest->created_at ? $quoteRequest->created_at->format('F d, Y h:i A') : 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-medium">Status</h3>
                            <span class="px-3 py-1 text-sm font-medium rounded-full {{ 
                                $quoteRequest->status === 'new' ? 'bg-blue-100 text-blue-800' : 
                                ($quoteRequest->status === 'responded' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') 
                            }}">
                                {{ ucfirst($quoteRequest->status) }}
                            </span>
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
                            <div class="p-4 mt-2 bg-gray-100 rounded-md dark:bg-gray-700">
                                {{ $quoteRequest->message }}
                            </div>
                        </div>
                    @endif

                    <div class="mb-6">
                        <h3 class="text-lg font-medium">Requested Items</h3>
                        <div class="overflow-x-auto mt-4">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Fruit</th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Category</th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Quantity</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                    @forelse($quoteRequest->fruits as $fruit)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    @if($fruit->image)
                                                        <div class="flex-shrink-0 w-10 h-10">
                                                            <img class="object-cover w-10 h-10 rounded-full" src="{{ asset($fruit->image) }}" alt="{{ $fruit->name }}">
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
                                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $fruit->category ? $fruit->category->translate()->name : 'Uncategorized' }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 dark:text-gray-100">{{ $fruit->pivot->quantity }}</div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-6 py-4 text-sm text-center text-gray-500 dark:text-gray-400">
                                                No items in this quote request.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="flex space-x-4">
                        <a href="{{ route('admin.quotes.index') }}" class="px-4 py-2 text-sm text-white bg-gray-800 rounded-md dark:bg-gray-200 dark:text-gray-800">
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
