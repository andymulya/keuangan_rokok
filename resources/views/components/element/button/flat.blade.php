<button
    {{ $attributes->merge(['class' => 'transition text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500']) }}>
    {{ $slot }}
</button>
