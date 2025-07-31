@props([
    'type' => 'text',
    'name',
    'id' => null,
    'value' => '',
    'required' => false,
    'min' => null,
    'max' => null,
    'step' => null,
])

<input
    type="{{ $type }}"
    name="{{ $name }}"
    id="{{ $id ?? $name }}"
    value="{{ old($name, $value) }}"
    @if($required) required @endif
    @if($min !== null) min="{{ $min }}" @endif
    @if($max !== null) max="{{ $max }}" @endif
    @if($step !== null) step="{{ $step }}" @endif
    {{ $attributes->merge([
        'class' => 'mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200 transition duration-300 ease-in-out transform hover:scale-105'
    ]) }}
>