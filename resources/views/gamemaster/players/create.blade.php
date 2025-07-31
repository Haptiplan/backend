<x-app-layout>
    <!-- Dashboard Header -->
    <x-dashboard-header>
        {{ __('Dashboard') }}
    </x-dashboard-header>

    <!-- Layout Content Box -->
    <x-content-box>

        <!-- Centered Title -->
        <x-page-title>
            {{ __('messages.playerCreate') }}
        </x-page-title>

        <!-- Error & Success Messages -->
        <x-error-message />
        <x-success-message />

        <!-- Player Creation Form -->
        <form class="space-y-8" action="{{ route('players.store') }}" method="POST">
            @csrf

            <!-- Player Selection -->
            <div class="space-y-4">
                <x-header-label for="id">
                    {{ __('messages.player') }}
                </x-header-label>
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
                <x-header-label for="company_id">
                    {{ __('messages.company') }}
                </x-header-label>
                <div class="space-y-6">
                    @foreach ($games as $game)
                        <div class="space-y-2">
                            <x-header-label class="text-sm font-medium ml-5">
                                {{ __('messages.game') }}: {{$game->name}}
                            </x-header-label>
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