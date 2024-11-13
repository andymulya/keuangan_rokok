@props(['disabled' => false, 'required' => false, 'type' => null, 'styles' => 'rounded-lg'])

@php($name = $attributes->wire('model')->value ?? $attributes->get('name'))
@php($id = $attributes->wire('model')->value ?? $attributes->get('id'))

<input
    {{ $attributes->merge([
        'disabled' => $disabled,
        'required' => $required,
        'type' => $type,
        'name' => $name,
        'id' => $id,
        'class' =>
            'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm ' . $styles,
    ]) }} />
