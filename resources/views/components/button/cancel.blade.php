@props([
    'route'
])

<a href="{{ $route }}" {{ $attributes->class(['btn btn-danger']) }}>
    <x-icon.close/>
    {{ $slot }}
</a>