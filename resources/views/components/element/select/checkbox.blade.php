@props(['name' => null, 'required' => false, 'disabled' => false, 'label' => null])

@php($name = $name ?? $attributes->wire('model')->value)

<label for="{{ $name }}" class="inline-flex items-center">
    <input id="{{ $name }}"
        {{ $attributes->merge([
            'type' => 'checkbox',
            'name' => $name,
            'required' => $required,
            'disabled' => $disabled,
            'class' =>
                'rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500',
        ]) }} />
    @isset($label)
        <span class="ml-2 text-sm text-gray-600">{{ __($label) }}</span>
    @endisset
</label>
