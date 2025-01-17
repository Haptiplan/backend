<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('messages.playerEdit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <h1 class="text-3xl font-semibold text-center mb-8 text-gray-900 dark:text-gray-100">{{ __('messages.playerEdit') }}</h1>
                    <x-success-message></x-success-message>
                    <form action="{{ route('players.update', $player->id) }}" method="POST" class="space-y-10">

                        @csrf
                        @method('PUT')

                        <!-- Player Name Display -->
                        <div class="space-y-2">
                            <label for="player_name" class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                                {{ __('messages.playerName') }}:
                            </label>
                            <p class="text-xl font-semibold text-gray-900 dark:text-gray-100">{{ $user->name }}</p>
                        </div>

                        <!-- Company Selection -->
                        <div class="space-y-6">
                            <label for="company_id" class="block text-xl font-bold text-gray-700 dark:text-gray-300 mb-4">
                                {{ __('messages.company') }}:
                            </label>

                            @foreach ($games as $game)
                                <div class="space-y-4">
                                    <p class="text-lg font-medium text-gray-700 dark:text-gray-300">
                                        {{ __('messages.game') }}: <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $game->name }}</span>
                                    </p>

                                    @foreach ($companies->where('game_id', $game->id) as $company)
                                        <div class="flex items-center space-x-4 mb-4">
                                            <input type="radio" name="company_id" id="company_{{$company->id}}" value="{{$company->id}}" class="h-5 w-5 text-blue-600 border-gray-300 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:focus:ring-blue-500 dark:text-blue-600" @if($company->id == $player->company_id) checked @endif>
                                            <label for="company_{{$company->id}}" class="text-lg text-gray-800 dark:text-gray-300 font-medium">{{ $company->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center mt-8">
                            <x-submit-button class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-md shadow-lg hover:from-blue-700 hover:to-indigo-700 transition ease-in-out duration-300 transform hover:scale-105">
                                {{ __('messages.submit') }}
                            </x-submit-button>
                        </div>
                    </form>

                    <!-- Back Button -->
                    <div class="text-center mt-6">
                        <x-back-button href="{{ route('players.index') }}" class="px-8 py-3 bg-gray-300 dark:bg-gray-600 text-lg text-gray-800 dark:text-gray-200 font-semibold rounded-md shadow-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition duration-300">
                            {{ __('messages.back') }}
                        </x-back-button>
                    </div>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
