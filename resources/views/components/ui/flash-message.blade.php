@if (session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-8" role="alert">
        <p class="font-medium">Success!</p>
        <p>{{ session('success') }}</p>
    </div>
@endif

@if (session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-8" role="alert">
        <p class="font-medium">Error!</p>
        <p>{{ session('error') }}</p>
    </div>
@endif
