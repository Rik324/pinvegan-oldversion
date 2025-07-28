<x-layout.app>
    <x-slot:header>
        <h2 class="text-xl font-semibold leading-tight text-yellow-300 dark:text-gray-200">
            {{ __('frontend.about_us') }}
        </h2>
    </x-slot>
<div class="bg-white dark:bg-gray-900">
    <!-- Hero Section -->
    <div class="bg-yellow-400 dark:bg-yellow-600">
        <div class="px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="mb-4 text-4xl font-bold text-gray-900 dark:text-white">{{ __('frontend.about_us_title', ['title' => $aboutData['title']]) }}</h1>
                <p class="mx-auto max-w-3xl text-xl text-gray-800 dark:text-gray-200">
                    {{ __('frontend.about_us_description', ['description' => $aboutData['description']]) }}
                </p>
            </div>
        </div>
    </div>

    <!-- Our Story Section -->
    <div class="px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex flex-col items-center md:flex-row">
            <div class="mb-8 md:w-1/2 md:mb-0 md:pr-8">
                <h2 class="mb-6 text-3xl font-bold text-gray-900 dark:text-white">{{ __('frontend.our_story') }}</h2>
                <p class="mb-6 text-gray-600 dark:text-gray-300">
                    {{ __('frontend.our_history', ['history' => $aboutData['history']]) }}
                </p>
                <h3 class="mb-4 text-xl font-semibold text-gray-900 dark:text-white">{{ __('frontend.our_mission') }}</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    {{ __('frontend.our_mission_text', ['mission' => $aboutData['mission']]) }}
                </p>
            </div>
            <div class="md:w-1/2">
                <img src="{{ asset('images/fruits/about.jpg') }}"
                     alt="Our Story" 
                     class="w-full h-auto rounded-lg shadow-xl">
            </div>
        </div>
    </div>

    <!-- Our Values Section -->
    <div class="bg-gray-100 dark:bg-gray-800">
        <div class="px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h2 class="mb-12 text-3xl font-bold text-center text-gray-900 dark:text-white">{{ __('frontend.our_values') }}</h2>
            
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <div class="p-6 text-center bg-white rounded-lg shadow-md dark:bg-gray-700">
                    <div class="inline-flex justify-center items-center mb-4 w-16 h-16 bg-yellow-400 rounded-full dark:bg-yellow-600">
                        <svg class="w-8 h-8 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">{{ __('frontend.quality') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        {{ __('frontend.quality_description') }}
                    </p>
                </div>
                
                <div class="p-6 text-center bg-white rounded-lg shadow-md dark:bg-gray-700">
                    <div class="inline-flex justify-center items-center mb-4 w-16 h-16 bg-yellow-400 rounded-full dark:bg-yellow-600">
                        <svg class="w-8 h-8 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">{{ __('frontend.sustainability') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        {{ __('frontend.sustainability_description') }}
                    </p>
                </div>
                
                <div class="p-6 text-center bg-white rounded-lg shadow-md dark:bg-gray-700">
                    <div class="inline-flex justify-center items-center mb-4 w-16 h-16 bg-yellow-400 rounded-full dark:bg-yellow-600">
                        <svg class="w-8 h-8 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">{{ __('frontend.community') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        {{ __('frontend.community_description') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Our Team Section -->
    <div class="px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h2 class="mb-12 text-3xl font-bold text-center text-gray-900 dark:text-white">{{ __('frontend.meet_our_team') }}</h2>
        
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            @foreach($aboutData['team'] as $member)
                <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <div class="h-64 bg-gray-200 dark:bg-gray-700">
                        <!-- In a real app, you would have team member photos here -->
                        <div class="flex justify-center items-center w-full h-full">
                            <svg class="w-24 h-24 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="mb-1 text-xl font-semibold text-gray-900 dark:text-white">{{ $member['name'] }}</h3>
                        <p class="mb-4 text-green-800 dark:text-yellow-400">{{ $member['position'] }}</p>
                        <p class="text-gray-600 dark:text-gray-300">{{ $member['bio'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-yellow-400 dark:bg-yellow-600">
        <div class="px-4 py-12 mx-auto max-w-7xl text-center sm:px-6 lg:px-8">
            <h2 class="mb-4 text-3xl font-bold text-gray-900 dark:text-white">{{ __('frontend.ready_to_work') }}</h2>
            <p class="mx-auto mb-8 max-w-3xl text-xl text-gray-800 dark:text-gray-200">
                {{ __('frontend.contact_us_cta') }}
            </p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route('quote.index', ['locale' => app()->getLocale()]) }}" class="px-6 py-3 font-bold text-white bg-green-800 rounded-lg transition duration-300 hover:bg-green-700">
                    {{ __('frontend.request_quote') }}
                </a>
                <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" class="px-6 py-3 font-bold text-green-800 bg-white rounded-lg border-2 border-green-800 transition duration-300 hover:bg-gray-100">
                    {{ __('frontend.contact_us') }}
                </a>
            </div>
        </div>
    </div>
</div>
</x-layout.app>
