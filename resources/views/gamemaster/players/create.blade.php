<x-app-layout>
    <x-dashboard-header>
        {{ __('Dashboard') }}
    </x-dashboard-header>

    <x-content-box>
        <!-- Player Creation Header -->
        <x-page-title>
            {{ __('messages.playerCreate') }}
        </x-page-title>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="bg-red-100 dark:bg-red-600 p-4 mb-6 rounded-md">
                <ul class="text-sm font-medium text-red-600 dark:text-red-300">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <x-success-message></x-success-message>
        <form class="space-y-8" action="{{ route('players.store') }}" method="POST">

            @csrf

            <!-- Player Selection -->
            <div class="space-y-4">
                <label for="id" class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                    {{ __('messages.player') }}
                </label>
                <div class="space-y-2">
                    @foreach ($users as $user)
                        <div class="flex items-center">
                            <input type="radio" name="id" id="{{$user->id}}" value="{{$user->id}}" class="mr-2">
                            <label for="{{$user->id}}" class="text-gray-800 dark:text-gray-200">{{ $user->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Company and Game Selection -->
            <div class="space-y-4">
                <label for="company_id" class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                    {{ __('messages.company') }}:
                </label>
                <div class="space-y-6">
                    @foreach ($games as $game)
                        <div class="space-y-2">
                            <label
                                class="text-sm font-medium ml-5 text-gray-700 dark:text-gray-300">{{ __('messages.game') }}:
                                {{$game->name}}</label>
                            <div class="space-y-2 ml-8">
                                @foreach ($companies->where('game_id', $game->id) as $company)
                                    <div class="flex items-center">
                                        <input type="radio" name="company_id" id="{{$company->id}}" value="{{$company->id}}"
                                            class="mr-2">
                                        <label for="{{$company->id}}"
                                            class="text-gray-800 dark:text-gray-200">{{ $company->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <x-submit-button>
                    {{ __('messages.create') }}
                </x-submit-button>
            </div>
        </form>

        <!-- Back Button -->
        <div class="text-center mt-6">
            <x-back-button href="{{ route('players.index') }}">
                {{ __('messages.back') }}
            </x-back-button>
        </div>
    </x-content-box>
</x-app-layout>