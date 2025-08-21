<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'px-3 py-1 text-sm bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-md shadow hover:from-blue-700 hover:to-indigo-700 transition ease-in-out duration-300 transform hover:scale-105 mb-4'
]) }}>
    {{ $slot }}
</button>

