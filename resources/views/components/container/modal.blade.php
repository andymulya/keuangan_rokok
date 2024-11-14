@props([
    'name' => 'modal',
    'title' => 'Header',
    'method' => null,
])


<div class="fixed inset-0 z-20 flex items-center justify-center" x-data="{ visible: false, name: '{{ $name }}' }"
    x-on:open-modal.window="($event.detail.id && name === $event.detail.name) ? $wire.load($event.detail.id) : visible = (name === $event.detail.name)"
    x-on:close-modal.window="(name === $event.detail.name) ? $wire.clear() : $event.preventDefault()" x-transition
    x-show="visible" x-cloak>
    <div wire:loading.class="pointer-events-none" class="fixed inset-0 bg-gray-100 opacity-80"
        x-on:click="$dispatch('close-modal', {name: name})"></div>
    <div
        class="bg-white max-h-[34rem] max-w-xl w-full rounded-lg text-black relative">
        @if (isset($method))
            <form wire:submit="{{ $method }}">
        @endif
        <div class="flex justify-between p-3 border-b">
            {{ __($title) }}
            <button type="button" x-on:click="$dispatch('close-modal', {name: name})">
                &cross;
            </button>
        </div>
        <div class="p-3 my-1 overflow-y-auto max-h-96">
            <div>
                {{ $slot }}
            </div>
        </div>
        <div class="flex justify-end gap-1 p-3 border-t">
            <x-element.button.secondary wire:loading.attr="disabled" type="button"
                x-on:click="$dispatch('close-modal', {name: name})">
                {{ __('Close') }}
            </x-element.button.secondary>
            {{ $button ?? '' }}
        </div>
        @if (isset($method))
            </form>
        @endif
    </div>
</div>
