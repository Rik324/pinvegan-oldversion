<nav x-data="{ open: false }" class="bg-green-800 dark:bg-green-900 border-b border-green-700 dark:border-green-800 text-white">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-white font-bold text-xl">
                        Fruit Shop
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-ui.nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-ui.nav-link>
                    
                    <x-ui.nav-link :href="route('fruits.index')" :active="request()->routeIs('fruits.*')">
                        {{ __('Fruits') }}
                    </x-ui.nav-link>
                    
                    <x-ui.nav-link :href="route('about')" :active="request()->routeIs('about')">
                        {{ __('About Us') }}
                    </x-ui.nav-link>
                    
                    <x-ui.nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                        {{ __('Contact') }}
                    </x-ui.nav-link>
                    
                    <x-ui.nav-link :href="route('quote.index')" :active="request()->routeIs('quote.*')">
                        {{ __('Request Quote') }}
                    </x-ui.nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-ui.dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white hover:text-yellow-400 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-ui.dropdown-link :href="route('dashboard')">
                                {{ __('Dashboard') }}
                            </x-ui.dropdown-link>
                            
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-ui.dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-ui.dropdown-link>
                            </form>
                        </x-slot>
                    </x-ui.dropdown>
                @else
                    <div class="space-x-4">
                        <a href="{{ route('login') }}" class="text-white hover:text-yellow-400 transition">{{ __('Log in') }}</a>
                        <a href="{{ route('register') }}" class="text-white hover:text-yellow-400 transition">{{ __('Register') }}</a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-yellow-400 hover:bg-green-700 focus:outline-none focus:bg-green-700 focus:text-yellow-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-ui.responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-ui.responsive-nav-link>
            
            <x-ui.responsive-nav-link :href="route('fruits.index')" :active="request()->routeIs('fruits.*')">
                {{ __('Fruits') }}
            </x-ui.responsive-nav-link>
            
            <x-ui.responsive-nav-link :href="route('about')" :active="request()->routeIs('about')">
                {{ __('About Us') }}
            </x-ui.responsive-nav-link>
            
            <x-ui.responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                {{ __('Contact') }}
            </x-ui.responsive-nav-link>
            
            <x-ui.responsive-nav-link :href="route('quote.index')" :active="request()->routeIs('quote.*')">
                {{ __('Request Quote') }}
            </x-ui.responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-green-700 dark:border-green-800">
                <div class="px-4">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-green-300">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-ui.responsive-nav-link :href="route('dashboard')">
                        {{ __('Dashboard') }}
                    </x-ui.responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-ui.responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-ui.responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-1 border-t border-green-700 dark:border-green-800">
                <div class="space-y-1">
                    <x-ui.responsive-nav-link :href="route('login')">
                        {{ __('Log in') }}
                    </x-ui.responsive-nav-link>
                    
                    <x-ui.responsive-nav-link :href="route('register')">
                        {{ __('Register') }}
                    </x-ui.responsive-nav-link>
                </div>
            </div>
        @endauth
    </div>
</nav>
