<a {{ $attributes->merge([
    'class' => 'inline-flex items-center px-4 py-2 bg-gray-600 border bg-opacity-75 border-transparent rounded-md font-medium text-white tracking-widest hover:bg-gray-500 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 '
]) }}>
    {{$slot}}
</a>

