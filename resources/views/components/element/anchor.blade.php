@props(['href' => 'javascript:void(0)'])

<a {{ $attributes->merge(['class' => 'text-gray-600 hover:text-gray-900']) }}
    href="{{ $href }}" wire:navigate>
    {{ $slot }}
</a>
