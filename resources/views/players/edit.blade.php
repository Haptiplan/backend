<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('messages.playerEdit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-6">{{ __('messages.playerEdit') }}</h1>
                    <form class="space-y-4" action="{{ route('players.update', $player->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="player_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('messages.playerName') }}: {{$user->name}}
                            </label>
                            <label for="company_id" class="block font-bold text-xl text-gray-700 dark:text-gray-300">
                                {{ __('messages.company') }}:
                            </label>
                            @foreach ($games as $game)
                            <label class="text-sm font-medium ml-5 text-gray-700 dark:text-gray-300">{{ __('messages.game') }}: {{$game->name}}</label><br>
                            @foreach ($companies->where('game_id', $game->id) as $company)
                            <input type="radio" name="company_id" id="{{$company->id}}" value="{{$company->id}}" class="ml-10" @if($company->id == $player->company_id) 
                            checked
                            @endif>
                            <label for="{{$company->id}}">{{$company->name}}</label><br>
                            @endforeach
                            @endforeach
                        </div>
                        <div>
                            <x-submit-button>{{ __('messages.submit') }}</x-submit-button>
                        </div>
                    </form> 
                    <x-back-button href="{{ route('players.index') }}"></x-back-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
