@props(['text', 'class' => 'text-base font-semibold text-gray-900 dark:text-gray-100'])

<span {{ $attributes->merge(['class' => $class]) }}>
    {{ $text }}
</span>