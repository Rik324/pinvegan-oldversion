@php
    use Illuminate\Support\Facades\Auth;
@endphp

<nav x-data="{ open: false }" class="text-white bg-green-800 border-b border-green-700 dark:bg-green-900 dark:border-green-800">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('home') }}?locale={{ app()->getLocale() }}" class="text-xl font-bold text-white">
                        {{ __('frontend.fruit_shop') }}
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-ui.nav-link :href="route('home') . '?locale=' . app()->getLocale()" :active="request()->routeIs('home')">
                        {{ __('frontend.home') }}
                    </x-ui.nav-link>
                    
                    <x-ui.nav-link :href="route('fruits.index') . '?locale=' . app()->getLocale()" :active="request()->routeIs('fruits.*') && !request()->has('category_id')">
                        {{ __('frontend.products') }}
                    </x-ui.nav-link>
                    
                    <!-- Hierarchical Categories Menu -->
                    @foreach($topLevelCategories as $topCategory)
                        @if($topCategory->children->count() > 0)
                        <!-- Category with children - show as dropdown -->
                        <div x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false" class="relative">
                            <button @click="open = !open" class="inline-flex items-center px-1 pt-2 h-16 border-b-2 border-transparent text-sm font-medium leading-5 text-white hover:text-yellow-400 hover:border-yellow-300 focus:outline-none focus:text-yellow-400 focus:border-yellow-300 transition duration-150 ease-in-out {{ request()->routeIs('fruits.*') && request()->has('category_id') && in_array(request()->category_id, [$topCategory->id, ...$topCategory->children->pluck('id')->toArray()]) ? 'border-yellow-400 text-yellow-400' : '' }}">
                                {{ $topCategory->name }}
                                <svg class="ml-1 w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="open"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 z-50 mt-2 w-48 rounded-md shadow-lg origin-top-right"
                                style="display: none;">
                                <div class="py-1 bg-white rounded-md ring-1 ring-black ring-opacity-5">
                                    <!-- Child categories -->
                                    @foreach($topCategory->children as $childCategory)
                                        <a href="{{ route('fruits.index') }}?locale={{ app()->getLocale() }}&category_id={{ $childCategory->id }}&sort=name&direction=asc" class="block px-4 py-2 pl-6 text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                                            {{ $childCategory->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @else
                        <!-- Category without children - show as direct link -->
                        <x-ui.nav-link :href="route('fruits.index') . '?locale=' . app()->getLocale() . '&category_id=' . $topCategory->id . '&sort=name&direction=asc'" :active="request()->routeIs('fruits.*') && request()->has('category_id') && request()->category_id == $topCategory->id">
                            {{ $topCategory->name }}
                        </x-ui.nav-link>
                        @endif
                    @endforeach                    
                    
                    <x-ui.nav-link :href="route('quote.index') . '?locale=' . app()->getLocale()" :active="request()->routeIs('quote.*')">
                        {{ __('frontend.request_quote_menu') }}
                    </x-ui.nav-link>
                </div>
            </div>


            
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center">
                @auth
                    <x-ui.dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-white rounded-md border border-transparent transition duration-150 ease-in-out hover:text-yellow-400 focus:outline-none">
                                <div class="flex items-center">
                                    {{ Auth::user()->name }}
                                    @if(Auth::user()->is_admin)
                                        <span class="ml-2 px-1.5 py-0.5 text-xs font-medium bg-yellow-500 text-green-900 rounded-full">{{ __('frontend.admin_badge') }}</span>
                                    @endif
                                </div>

                                <div class="ms-1">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @if(Auth::check() && Auth::user()->is_admin)
                                <x-ui.dropdown-link :href="route('dashboard') . '?locale=' . app()->getLocale()">
                                    {{ __('frontend.dashboard') }}
                                </x-ui.dropdown-link>
                            @endif
                            
                            <x-ui.dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-ui.dropdown-link>
                            
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}?locale={{ app()->getLocale() }}">
                                @csrf
                                <input type="hidden" name="locale" value="{{ app()->getLocale() }}">

                                <x-ui.dropdown-link :href="route('logout') . '?locale=' . app()->getLocale()"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('frontend.logout') }}
                                </x-ui.dropdown-link>
                            </form>
                        </x-slot>
                        
                    </x-ui.dropdown>
                @else
                    <div class="space-x-4">
                        <a href="{{ route('login') }}?locale={{ app()->getLocale() }}" class="text-white transition hover:text-yellow-400">{{ __('frontend.login') }}</a>
                        <a href="{{ route('register') }}?locale={{ app()->getLocale() }}" class="text-white transition hover:text-yellow-400">{{ __('frontend.register') }}</a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -me-2 sm:hidden">
                <button @click="open = ! open" class="inline-flex justify-center items-center p-2 text-white rounded-md transition duration-150 ease-in-out hover:text-yellow-400 hover:bg-green-700 focus:outline-none focus:bg-green-700 focus:text-yellow-400">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <!-- Mobile Language Switcher is moved to the section below -->
        
        <div class="pt-2 pb-3 space-y-1">
            <x-ui.responsive-nav-link :href="route('home') . '?locale=' . app()->getLocale()" :active="request()->routeIs('home')">
                {{ __('frontend.home') }}
            </x-ui.responsive-nav-link>
            
            <x-ui.responsive-nav-link :href="route('fruits.index') . '?locale=' . app()->getLocale()" :active="request()->routeIs('fruits.*') && !request()->has('category_id')">
                {{ __('frontend.fruits') }}
            </x-ui.responsive-nav-link>
            
            <!-- Hierarchical Categories for Mobile -->            
            @foreach($topLevelCategories as $topCategory)
                @if($topCategory->children->count() > 0)
                <!-- Category with children - show as dropdown -->
                <div x-data="{openTopCategory{{$topCategory->id}}: false}" class="border-l-4 border-transparent">
                    <button @click="openTopCategory{{$topCategory->id}} = !openTopCategory{{$topCategory->id}}" class="flex items-center w-full px-4 py-2 text-base font-medium text-white transition duration-150 ease-in-out hover:bg-green-700 focus:outline-none focus:bg-green-700 {{ request()->routeIs('fruits.*') && request()->has('category_id') && in_array(request()->category_id, [$topCategory->id, ...$topCategory->children->pluck('id')->toArray()]) ? 'bg-green-700' : '' }}">
                        <span>{{ $topCategory->name }}</span>
                        <svg :class="{'rotate-180': openTopCategory{{$topCategory->id}}}" class="ml-auto w-4 h-4 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div x-show="openTopCategory{{$topCategory->id}}" x-transition class="pl-4">
                        <!-- Child categories -->
                        @foreach($topCategory->children as $childCategory)
                            <x-ui.responsive-nav-link :href="route('fruits.index') . '?locale=' . app()->getLocale() . '&category_id=' . $childCategory->id . '&sort=name&direction=asc'" class="pl-2">
                                {{ $childCategory->name }}
                            </x-ui.responsive-nav-link>
                        @endforeach
                    </div>
                </div>
                @else
                <!-- Category without children - show as direct link -->
                <x-ui.responsive-nav-link :href="route('fruits.index') . '?locale=' . app()->getLocale() . '&category_id=' . $topCategory->id . '&sort=name&direction=asc'" :active="request()->routeIs('fruits.*') && request()->has('category_id') && request()->category_id == $topCategory->id">
                    {{ $topCategory->name }}
                </x-ui.responsive-nav-link>
                @endif
            @endforeach
            
            <x-ui.responsive-nav-link :href="route('about') . '?locale=' . app()->getLocale()" :active="request()->routeIs('about')">
                {{ __('About Us') }}
            </x-ui.responsive-nav-link>
            
            <x-ui.responsive-nav-link :href="route('contact') . '?locale=' . app()->getLocale()" :active="request()->routeIs('contact')">
                {{ __('Contact') }}
            </x-ui.responsive-nav-link>
            
            <x-ui.responsive-nav-link :href="route('quote.index') . '?locale=' . app()->getLocale()" :active="request()->routeIs('quote.*')">
                {{ __('frontend.request_quote_menu') }}
            </x-ui.responsive-nav-link>
        </div>



        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-green-700 dark:border-green-800">
                <div class="px-4">
                    <div class="flex items-center text-base font-medium text-white">
                        {{ Auth::user()->name }}
                        @if(Auth::user()->is_admin)
                            <span class="ml-2 px-1.5 py-0.5 text-xs font-medium bg-yellow-500 text-green-900 rounded-full">{{ __('frontend.admin_badge') }}</span>
                        @endif
                    </div>
                    <div class="text-sm font-medium text-green-300">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    @if(Auth::user()->is_admin)
                        <x-ui.responsive-nav-link :href="route('dashboard') . '?locale=' . app()->getLocale()">
                            {{ __('frontend.dashboard') }}
                        </x-ui.responsive-nav-link>
                    @endif

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}?locale={{ app()->getLocale() }}">
                        @csrf
                        <input type="hidden" name="locale" value="{{ app()->getLocale() }}">

                        <x-ui.responsive-nav-link :href="route('logout') . '?locale=' . app()->getLocale()"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('frontend.logout') }}
                        </x-ui.responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-1 border-t border-green-700 dark:border-green-800">
                <div class="space-y-1">
                    <x-ui.responsive-nav-link :href="route('login') . '?locale=' . app()->getLocale()">
                        {{ __('frontend.login') }}
                    </x-ui.responsive-nav-link>
                    
                    <x-ui.responsive-nav-link :href="route('register') . '?locale=' . app()->getLocale()">
                        {{ __('frontend.register') }}
                    </x-ui.responsive-nav-link>
                </div>
            </div>
        @endauth
    </div>
</nav>
