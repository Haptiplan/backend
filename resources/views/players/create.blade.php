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
                    <h1 class="text-2xl font-bold mb-6">{{ __('messages.playerCreate') }}</h1>
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
                    <form class="space-y-4" action="{{ route('players.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="id" class="block font-bold text-xl text-gray-700 dark:text-gray-300">
                                {{ __('messages.player') }}
                            </label>
                            @foreach ($users as $user)
                            <input type="radio" name="id" id="{{$user->id}}" value="{{$user->id}}" class="ml-5">
                            <label for="{{$user->id}}">{{$user->name}}</label><br>
                            @endforeach
                            
                            <label for="company_id" class="block font-bold text-xl text-gray-700 dark:text-gray-300">
                                {{ __('messages.company') }}:
                            </label>
                            @foreach ($games as $game)
                            <label class="text-sm font-medium ml-5 text-gray-700 dark:text-gray-300">{{ __('messages.game') }}: {{$game->name}}</label><br>
                            @foreach ($companies->where('game_id', $game->id) as $company)
                            <input type="radio" name="company_id" id="{{$company->id}}" value="{{$company->id}}" class="ml-10">
                            <label for="{{$company->id}}">{{$company->name}}</label><br>
                            @endforeach
                            @endforeach
                        </div>
                        <div>
                            <x-submit-button>{{ __('messages.create') }}</x-submit-button>
                        </div>
                    </form>

                    <x-back-button href="{{ route('players.index') }}"></x-back-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>