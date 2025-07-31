<x-app-layout>
    <!-- Dashboard Header -->
    <x-dashboard-header>
        {{ __('Dashboard') }}
    </x-dashboard-header>

    <!-- Layout Content Box -->
    <x-content-box>

        <!-- Centered Title -->
        <x-page-title>
            {{ __('messages.playerIndex') }}
        </x-page-title>

        <!-- Error & Success Messages -->
        <x-error-message />
        <x-success-message />

        <!-- Create Player Button -->
        <div class="text-center mb-6">
            <x-create-button href="{{ route('players.create') }}">
                {{ __('messages.playerCreate') }}
            </x-create-button>
        </div>

        <!-- Player List Grouped by Game and Company -->
        <div class="mt-8 space-y-8">
            @foreach ($games as $game)
                    <div class="mb-6">
                        <div class="space-y-4">
                            @foreach ($companies as $company)
                                @if ($game->id == $company->game_id)
                                        <x-container>
                                            <x-header-label>
                                                {{ $company->name }}:
                                            </x-header-label>
                                            <ul class="space-y-4 mt-2">
                                                @foreach($players as $player)
                                                    @foreach($user_list as $user)
                                                        @if ($player->id == $user->id && $player->company_id == $company->id)
                                                            <x-list-item :item="$user" :editRoute="'players.edit'" :deleteRoute="'players.destroy'" />
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </ul>
                                        </x-container>
                                    </div>
                                @endif
                            @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </x-content-box>
</x-app-layout>