@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-coklat focus:ring-coklat rounded-md shadow-sm']) }}>
