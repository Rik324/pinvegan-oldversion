<x-layout.app>
    {{-- This slot defines the content for the header section of the layout --}}
    <x-slot name="header">
        <h2 class="mt-4 text-xl font-semibold leading-tight text-yellow-300 dark:text-gray-200">
            {{ __('Quote Requests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Back to Dashboard Link --}}
                    <div class="mb-4">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center text-green-800 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Back to Dashboard
                        </a>
                    </div>

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="relative px-4 py-3 mb-4 text-green-700 bg-green-100 rounded border border-green-400" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Name</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Email</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Phone</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Status</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Date</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                {{-- Loop through the quote requests or show an empty state message --}}
                                @forelse ($quoteRequests as $quoteRequest)
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">{{ $quoteRequest->name }}</td>
                                        <td class="px-6 py-4 text-sm whitespace-nowrap">{{ $quoteRequest->email }}</td>
                                        <td class="px-6 py-4 text-sm whitespace-nowrap">{{ $quoteRequest->phone }}</td>
                                        <td class="px-6 py-4 text-sm whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $quoteRequest->status == 'new' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ ucfirst($quoteRequest->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm whitespace-nowrap">{{ $quoteRequest->created_at->format('M d, Y H:i') }}</td>
                                        <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                            <a href="{{ route('admin.quotes.show', $quoteRequest) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-200">View</a>
                                            {{-- Delete Form --}}
                                            <form action="{{ route('admin.quotes.destroy', $quoteRequest) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this quote request?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="ml-4 text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-200">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-sm text-center whitespace-nowrap">
                                            No quote requests found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination Links --}}
                    <div class="mt-4">
                        {{ $quoteRequests->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-layout.app>