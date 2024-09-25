@props([
    'route'
])

<a href="{{ $route }}" {{ $attributes->class(['btn btn-outline-danger']) }}>
    <x-icon.trash/>
    {{ $slot }}
</a>