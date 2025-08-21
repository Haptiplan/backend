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
            <x-create-button href="{{ route('players.create', $game) }}">
                {{ __('messages.playerCreate') }}
            </x-create-button>
        </div>

        <!-- Player List Grouped by Game and Company -->
        <div class="mt-8 space-y-8">
            <div class="space-y-4">
                @foreach ($companies as $company)
                    <x-container>
                         <x-header-label>
                            {{ $company->name }}:
                         </x-header-label>
                         <ul class="space-y-4 mt-2">
                             @foreach($players as $player)
                                  @foreach($user_list as $user)
                                       @if ($player->id == $user->id && $player->company_id == $company->id)
                                           <x-list-item :item="$user" :editRoute="'players.edit', ['games' => $game->id, 'id' => $user->id]" :deleteRoute="'players.destroy', ['games' => $game->id, 'id' => $user->id]" />
                                       @endif
                                  @endforeach
                             @endforeach
                         </ul>
                     </x-container>
                @endforeach
            </div>
        </div>
    </x-content-box>

</x-app-layout>