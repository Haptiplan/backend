<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-lg text-white font-semibold rounded-md shadow-lg hover:from-blue-700 hover:to-indigo-700 transition ease-in-out duration-300 transform hover:scale-105'
]) }}>
    {{ $slot }}
</button>
