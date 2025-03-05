<button {{ $attributes->merge([
    'type' => 'submit', 
    'class' => 'inline-flex items-center px-2 py-1 bg-red-600 bg-opacity-75 border border-transparent rounded-md font-medium text-white tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800']) }}>
    {{ __('messages.deactivate') }}
</button>