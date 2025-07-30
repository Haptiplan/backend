<x-app-layout>
    <x-dashboard-header>
        {{ __('Dashboard') }}
    </x-dashboard-header>
   
    <x-content-box>
        <!-- Game Edit Header -->
        <x-page-title>
            {{ __('messages.gameEdit') }}
        </x-page-title>
        <!-- Error Alert -->
        @if ($errors->any())
            <div class="alert alert-danger bg-red-100">
                <ul class="block text-sm font-medium text-red-600 dark:text-red-300">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <x-success-message></x-success-message>
        <form class="space-y-8" action="{{ route('games.update', $game->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <label for="game_name" class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                    {{ __('messages.gameName') }}
                </label>
                <input type="text" name="game_name" id="game_name" required
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200 transition duration-300 ease-in-out transform hover:scale-105"
                    value="{{ $game->name }}">
            </div>

            <div class="text-center">
                <x-submit-button>
                    {{ __('messages.submit') }}
                </x-submit-button>
            </div>
        </form>
        @php
            $groupedGames = $games->groupBy('status');
            $statusOrder = ['pending', 'active', 'completed', 'cancelled'];
        @endphp
        <form action="{{ route('games.updateStatus', $game->id) }}" method="POST" class="inline">
            @csrf
            @method('PATCH')
            <x-select-status :statusOrder="$statusOrder" :selected="$game->status" onchange="this.form.submit()" />
        </form>
        
        <!-- Gamemaster Add Form -->
        <x-page-title>
            {{ __('messages.gamemasterAdd') }}
        </x-page-title>
        <form class="space-y-8" action="{{ route('gamemasters.store') }}" method="POST">
            @csrf
            <input type="hidden" name="game_id" value="{{ $game->id }}">

            <div class="space-y-4">
                <label for="gamemasters" class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                    {{ __('messages.listGamemasters') }}
                </label>
                <div class="space-y-4">
                    @foreach ($gamemasters as $gamemaster)
                        <div class="flex items-center space-x-3">
                            <input type="radio" name="gamemaster" id="{{$gamemaster->id}}" value="{{$gamemaster->id}}"
                                class="h-5 w-5 text-blue-600 border-gray-300 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:focus:ring-blue-500 dark:text-blue-600">
                            <label for="{{$gamemaster->id}}"
                                class="text-lg text-gray-800 dark:text-gray-300">{{ $gamemaster->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="text-center">
                <x-submit-button>
                    {{ __('messages.submit') }}
                </x-submit-button>
            </div>
        </form>

        <!-- List of Existing Gamemasters -->
        <div class="space-y-4 mt-8">
            @foreach($list_gamemasters as $gamemaster)
                <div class="flex items-center justify-between text-gray-800 dark:text-gray-300">
                    <span>{{ $gamemaster->name }}</span>
                    <form action="{{ route('gamemasters.deleteOne', [$gamemaster->id, $game_id]) }}" method="POST"
                        class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md text-gray-700 dark:text-gray-300 font-semibold bg-red-500 hover:bg-red-600 focus:outline-none focus:border-red-600 focus:ring focus:ring-red-200 active:bg-red-700 transition duration-300 transform hover:scale-105">
                            {{ __('messages.delete') }}
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        <!-- Back Button -->
        <div class="text-center mt-6">
            <x-back-button href="{{ route('games.index') }}"
                class="px-8 py-3 bg-gray-300 dark:bg-gray-600 text-lg text-gray-800 dark:text-gray-200 font-semibold rounded-md shadow-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition duration-300">
                {{ __('messages.back') }}
            </x-back-button>
        </div>
    </x-content-box>
</x-app-layout>