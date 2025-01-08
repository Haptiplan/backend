<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-6">{{ __('messages.gameIndex') }}</h1>
                    @if ($errors->any())
                        <div class="alert alert-danger bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <ul class="block text-sm font-medium text-red-600 dark:text-red-300">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <x-success-message></x-success-message>
                    <x-create-button href="{{ route('games.create') }}">{{ __('messages.gameCreate') }}</x-create-button>
                    <div>
                        @foreach($games as $game)
                        <li>
                            {{$game->name}}
                            <x-edit-button href="{{ route('games.edit', $game->id) }}"></x-edit-button>
                            <form action="{{ route('games.destroy', $game->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <x-delete-button></x-delete-button>
                            </form>
                        </li>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
