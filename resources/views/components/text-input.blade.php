@props(['disabled' => false])

<input 
    @disabled($disabled) 
    {{ $attributes->merge([
        'class' => 
            'border-gray-300 bg-gray-100 text-gray-800 placeholder-gray-500 focus:border-pink-500 focus:ring-pink-300 rounded-md shadow-sm'
    ]) }} 
/>
