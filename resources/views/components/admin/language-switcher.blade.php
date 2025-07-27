@props(['class' => ''])

<div {{ $attributes->merge(['class' => 'relative ' . $class]) }}>
    <button id="language-dropdown-button" data-dropdown-toggle="language-dropdown" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-2 focus:ring-green-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700" type="button">
        @switch(app()->getLocale())
            @case('en')
                <span class="mr-2">🇬🇧</span> English
                @break
            @case('th')
                <span class="mr-2">🇹🇭</span> Thai
                @break
            @case('zh')
                <span class="mr-2">🇨🇳</span> Chinese
                @break
            @default
                <span class="mr-2">🇬🇧</span> English
        @endswitch
        <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
        </svg>
    </button>
    
    <div id="language-dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-800 dark:divide-gray-600">
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="language-dropdown-button">
            <li>
                <a href="{{ route('locale.switch', 'en') }}" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white {{ app()->getLocale() === 'en' ? 'bg-gray-100 dark:bg-gray-600' : '' }}">
                    <span class="mr-2">🇬🇧</span> English
                </a>
            </li>
            <li>
                <a href="{{ route('locale.switch', 'th') }}" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white {{ app()->getLocale() === 'th' ? 'bg-gray-100 dark:bg-gray-600' : '' }}">
                    <span class="mr-2">🇹🇭</span> Thai
                </a>
            </li>
            <li>
                <a href="{{ route('locale.switch', 'zh') }}" class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white {{ app()->getLocale() === 'zh' ? 'bg-gray-100 dark:bg-gray-600' : '' }}">
                    <span class="mr-2">🇨🇳</span> Chinese
                </a>
            </li>
        </ul>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownButton = document.getElementById('language-dropdown-button');
        const dropdown = document.getElementById('language-dropdown');
        
        if (dropdownButton && dropdown) {
            dropdownButton.addEventListener('click', function() {
                dropdown.classList.toggle('hidden');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!dropdownButton.contains(event.target) && !dropdown.contains(event.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        }
    });
</script>
@endpush
