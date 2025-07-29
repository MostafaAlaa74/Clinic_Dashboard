@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-primary-color focus:ring-primary-color rounded-md shadow-sm']) }}>
