@props(['quoteItems' => []])

<div class="p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
    <h2 class="mb-6 text-2xl font-bold text-gray-900 dark:text-white">Request a Quote</h2>
    
    <form action="{{ route('quote.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="name" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                <input type="text" name="name" id="name" required 
                    class="w-full rounded-md border-gray-300 shadow-sm dark:border-gray-700 dark:bg-gray-800 focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50"
                    value="{{ old('name') }}">
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="email" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input type="email" name="email" id="email" required 
                    class="w-full rounded-md border-gray-300 shadow-sm dark:border-gray-700 dark:bg-gray-800 focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50"
                    value="{{ old('email') }}">
                @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="phone" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Phone Number</label>
                <input type="tel" name="phone" id="phone" 
                    class="w-full rounded-md border-gray-300 shadow-sm dark:border-gray-700 dark:bg-gray-800 focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50"
                    value="{{ old('phone') }}">
                @error('phone')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="company" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Company (Optional)</label>
                <input type="text" name="company" id="company" 
                    class="w-full rounded-md border-gray-300 shadow-sm dark:border-gray-700 dark:bg-gray-800 focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50"
                    value="{{ old('company') }}">
            </div>
        </div>
        
        <div class="mb-6">
            <label for="message" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Additional Requirements</label>
            <textarea name="message" id="message" rows="4" 
                class="w-full rounded-md border-gray-300 shadow-sm dark:border-gray-700 dark:bg-gray-800 focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">{{ old('message') }}</textarea>
            @error('message')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex justify-end">
            <button type="submit" class="px-6 py-2 font-medium text-white bg-green-800 rounded-md transition duration-300 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                Submit Quote Request
            </button>
        </div>
    </form>
</div>
