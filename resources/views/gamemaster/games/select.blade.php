<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('messages.selectGame')  }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="mt-4 space-y-2">
            @foreach($games as $game)
            <form method="POST" action="{{ route('games.set_selected', $game) }}">
                @csrf
                <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    {{ $game->name }}
                </button>
            </form>
            @endforeach
        </div>
    </div>
</x-app-layout>