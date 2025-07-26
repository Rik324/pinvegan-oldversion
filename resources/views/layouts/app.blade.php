<x-layout.app>
    @isset($header)
        <x-slot name="header">
            {{ $header }}
        </x-slot>
    @endisset
    
    @yield('content')
</x-layout.app>
