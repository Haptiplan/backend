<x-app-layout>
    <x-dashboard-header>
        {{ __('Dashboard') }}
    </x-dashboard-header>

    <x-content-box>
        <!-- Centered Title with Elegant Font and Smooth Transition -->
        <x-page-title>
            {{ __('messages.playerIndex') }}
        </x-page-title>

        <!-- Error Handling with Soft Background and Styled List -->
        @if ($errors->any())
            <div
                class="alert alert-danger bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md mb-6 transition-transform transform hover:scale-105">
                <ul class="block text-sm font-medium text-red-600 dark:text-red-300 space-y-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Create Player Button with Gradient Background and Hover Effect -->
        <div class="text-center mb-6">
            <x-success-message></x-success-message>
            <x-create-button href="{{ route('players.create') }}">
                {{ __('messages.playerCreate') }}
            </x-create-button>
        </div>

        <!-- Player List Grouped by Game and Company with Stylish List Items -->
        <div class="mt-8 space-y-8">
            @foreach ($games as $game)
                    <div class="mb-6">
                        <div class="space-y-4">
                            @foreach ($companies as $company)
                                @if ($game->id == $company->game_id)
                                        <x-container>
                                            <label class=" underline decoration-yellow-400">
                                                {{ $company->name }}:</label>
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