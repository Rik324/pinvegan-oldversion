<nav x-data="{ open: false }" class="text-white bg-green-800 border-b border-green-700 dark:bg-green-900 dark:border-green-800">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('home') }}" class="text-xl font-bold text-white">
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
                            <button class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-white rounded-md border border-transparent transition duration-150 ease-in-out hover:text-yellow-400 focus:outline-none">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-ui.dropdown-link :href="route('dashboard')">
                                {{ __('Dashboard') }}
                            </x-ui.dropdown-link>
                            
                            <x-ui.dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
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
                        <a href="{{ route('login') }}" class="text-white transition hover:text-yellow-400">{{ __('Log in') }}</a>
                        <a href="{{ route('register') }}" class="text-white transition hover:text-yellow-400">{{ __('Register') }}</a>
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
                    <div class="text-base font-medium text-white">{{ Auth::user()->name }}</div>
                    <div class="text-sm font-medium text-green-300">{{ Auth::user()->email }}</div>
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
