<x-layout.app>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('About Us') }}
        </h2>
    </x-slot>
<div class="bg-white dark:bg-gray-900">
    <!-- Hero Section -->
    <div class="bg-yellow-400 dark:bg-yellow-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">{{ __('frontend.about_us_title', ['title' => $aboutData['title']]) }}</h1>
                <p class="text-xl text-gray-800 dark:text-gray-200 max-w-3xl mx-auto">
                    {{ __('frontend.about_us_description', ['description' => $aboutData['description']]) }}
                </p>
            </div>
        </div>
    </div>

    <!-- Our Story Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-8 md:mb-0 md:pr-8">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">{{ __('frontend.our_story') }}</h2>
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                    {{ __('frontend.our_history', ['history' => $aboutData['history']]) }}
                </p>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('frontend.our_mission') }}</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    {{ __('frontend.our_mission_text', ['mission' => $aboutData['mission']]) }}
                </p>
            </div>
            <div class="md:w-1/2">
                <img src="https://images.unsplash.com/photo-1550989460-0adf9ea622e2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" 
                     alt="Our Story" 
                     class="rounded-lg shadow-xl w-full h-auto">
            </div>
        </div>
    </div>

    <!-- Our Values Section -->
    <div class="bg-gray-100 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-12 text-center">{{ __('frontend.our_values') }}</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md p-6 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-yellow-400 dark:bg-yellow-600 rounded-full mb-4">
                        <svg class="w-8 h-8 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('frontend.quality') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        {{ __('frontend.quality_description') }}
                    </p>
                </div>
                
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md p-6 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-yellow-400 dark:bg-yellow-600 rounded-full mb-4">
                        <svg class="w-8 h-8 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('frontend.sustainability') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        {{ __('frontend.sustainability_description') }}
                    </p>
                </div>
                
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md p-6 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-yellow-400 dark:bg-yellow-600 rounded-full mb-4">
                        <svg class="w-8 h-8 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('frontend.community') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        {{ __('frontend.community_description') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Our Team Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-12 text-center">{{ __('frontend.meet_our_team') }}</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($aboutData['team'] as $member)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                    <div class="h-64 bg-gray-200 dark:bg-gray-700">
                        <!-- In a real app, you would have team member photos here -->
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-24 h-24 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-1">{{ $member['name'] }}</h3>
                        <p class="text-green-800 dark:text-yellow-400 mb-4">{{ $member['position'] }}</p>
                        <p class="text-gray-600 dark:text-gray-300">{{ $member['bio'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-yellow-400 dark:bg-yellow-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-center">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">{{ __('frontend.ready_to_work') }}</h2>
            <p class="text-xl text-gray-800 dark:text-gray-200 mb-8 max-w-3xl mx-auto">
                {{ __('frontend.contact_us_cta') }}
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('quote.index', ['locale' => app()->getLocale()]) }}" class="bg-green-800 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                    {{ __('frontend.request_quote') }}
                </a>
                <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" class="bg-white hover:bg-gray-100 text-green-800 font-bold py-3 px-6 rounded-lg border-2 border-green-800 transition duration-300">
                    {{ __('frontend.contact_us') }}
                </a>
            </div>
        </div>
    </div>
</div>
</x-layout.app>
