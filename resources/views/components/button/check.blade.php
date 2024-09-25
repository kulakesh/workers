@props([
    'route'
])

<a href="{{ $route }}" {{ $attributes->class(['btn btn-primary']) }}>
    <x-icon.check/>
    {{ $slot }}
</a>