<x-app-layout>
    <!-- Dashboard Header -->
    <x-dashboard-header>
        {{ __('Dashboard') }}
    </x-dashboard-header>

    <!-- Layout Content Box -->
    <x-content-box>

        <!-- Centered Title -->
        <x-page-title>
            {{ __('messages.playerEdit') }}
        </x-page-title>

        <!-- Error & Success Messages -->
        <x-error-message />
        <x-success-message />

        <!-- Player Edit Form -->
        <form action="{{ route('players.update', $player->id) }}" method="POST" class="space-y-10">
            @csrf
            @method('PUT')

            <!-- Player Name Display -->
            <div class="space-y-2">
                <x-header-label>
                    {{ __('messages.playerName') }}:
                </x-header-label>
                <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $user->name }}</p>
            </div>

            <!-- Company Selection -->
            <div class="space-y-6">
                <x-header-label>
                    {{ __('messages.company') }}:
                </x-header-label>

                @foreach ($games as $game)
                    <div class="space-y-4">
                        <x-header-label>
                            {{ __('messages.game') }}: {{ $game->name }}
                        </x-header-label>
                        <x-company-select :companies="$companies->where('game_id', $game->id)->values()->all()" :selected="$player->company_id" />
                    </div>
                @endforeach
            </div>

            <!-- Submit Button -->
            <div class="text-center mt-8">
                <x-submit-button>
                    {{ __('messages.submit') }}
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