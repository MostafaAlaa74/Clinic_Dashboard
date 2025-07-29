@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-blue-600 dark:text-blue-400']) }}>
    {{ $value ?? $slot }}
</label>
