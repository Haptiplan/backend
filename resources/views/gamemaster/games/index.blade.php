<x-app-layout>
    <!-- Dashboard Header -->
    <x-dashboard-header>
        {{ __('Dashboard') }}
    </x-dashboard-header>
    
    <!-- Layout Content Box -->
    <x-content-box>

        <!-- Centered Title with Elegant Font and Smooth Transition -->
        <x-page-title>
            {{ __('messages.gameIndex') }}
        </x-page-title>

        <!-- Create Game Button with Gradient and Hover Effect -->
        <div class="text-center mb-6">
            <x-create-button href="{{ route('games.create') }}">
                {{ __('messages.gameCreate') }}
            </x-create-button>
        </div>

        <!-- Error Handling with Soft Background and Styled List -->
        <x-error-message />
        <x-success-message />

        <!-- Game List Grouped by Status with Stylish List Items -->
        @php
            $groupedGames = $games->groupBy('status');
            $statusOrder = ['pending', 'active', 'completed', 'cancelled'];
        @endphp
        <!-- Loop through each status and display games -->
        @foreach ($statusOrder as $status)
            @if ($groupedGames->has($status))
                <x-header-label class="mb-2 capitalize">
                    {{ __('messages.' . $status) }}
                </x-header-label>
                <ul class="mb-6">
                    @foreach ($groupedGames[$status] as $game)
                        <x-list-item :item="$game" :editRoute="'games.edit'" :deleteRoute="'games.destroy'" />
                    @endforeach
                </ul>
            @endif
        @endforeach

    </x-content-box>
</x-app-layout>