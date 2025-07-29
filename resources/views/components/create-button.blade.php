<a {{ $attributes->merge([
    'class' => 'px-6 py-3 bg-gradient-to-r from-blue-500 to-teal-400 text-white rounded-full text-lg font-semibold hover:from-teal-400 hover:to-blue-500 transition duration-300 ease-in-out transform hover:scale-105 shadow-lg hover:shadow-xl '
]) }}>
    {{$slot}}
</a>

