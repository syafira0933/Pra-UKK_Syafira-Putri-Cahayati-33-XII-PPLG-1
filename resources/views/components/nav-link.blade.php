@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-coklat text-sm font-semibold leading-5 text-coklat-dark focus:outline-none focus:border-coklat transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-600 hover:text-coklat hover:border-coklat/40 focus:outline-none focus:text-coklat focus:border-coklat/40 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
