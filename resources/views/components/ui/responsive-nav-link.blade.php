@props(['active' => false])

@php
$classes = ($active ?? false)
    ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-yellow-400 text-start text-base font-medium text-yellow-400 bg-green-700 focus:outline-none focus:text-yellow-500 focus:bg-green-600 focus:border-yellow-500 transition duration-150 ease-in-out'
    : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-white hover:text-yellow-400 hover:bg-green-700 hover:border-yellow-300 focus:outline-none focus:text-yellow-400 focus:bg-green-700 focus:border-yellow-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
