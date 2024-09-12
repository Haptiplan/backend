<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('messages.gameEdit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-6">{{ __('messages.gameEdit') }}</h1>
                    <form class="space-y-4" action="{{ route('game.update', $game->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="game_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('messages.gameName') }}
                            </label>
                            <input type="text" name="game_name" id="game_name" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200" value={{ $game->name }}></input>
                        </div>
                        <div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-900 disabled:opacity-25 transition">
                                {{ __('messages.submit') }}
                            </button>
                        </div>
                    </form>
                    <h1 class="text-2xl font-bold mb-6">{{ __('messages.gamemasterAdd') }}</h1>
                    <form class="space-y-4" action="{{ route('gamemaster.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="game_id" value="{{ $game->id }}">
                        <div>
                            <label for="gamemasters" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('messages.listGamemasters') }}
                            </label>
                            <select name="gamemaster" id="gamemaster" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200">
                                <option value="" disabled hidden selected>{{ __('messages.chooseGamemaster') }}</option>
                                @foreach ($gamemasters as $gamemaster)
                                <option value="{{$gamemaster->id}}">{{$gamemaster->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-900 disabled:opacity-25 transition">
                                {{ __('messages.submit') }}
                            </button>
                        </div>
                    </form>
                    <div>
                        @foreach($list_gamemasters as $gamemaster)
                        <li>
                            {{$gamemaster->name}}
                            <form action="{{ route('gamemaster.delete', [$gamemaster->id, $game_id]) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-2 py-1 border border-transparent rounded-md font-semibold font-medium text-gray-700 dark:text-gray-300 tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-900 disabled:opacity-25 transition">
                                    {{ __('messages.delete') }}
                                </button>
                            </form>
                        </li>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>