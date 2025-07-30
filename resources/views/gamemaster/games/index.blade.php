<x-app-layout>
    <x-dashboard-header>
        {{ __('Dashboard') }}
    </x-dashboard-header>
    <x-content-box>
        <!-- Title Centered with Hover Effect -->
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
        <x-success-message></x-success-message>
        @php
            $groupedGames = $games->groupBy('status');
            $statusOrder = ['pending', 'active', 'completed', 'cancelled'];
        @endphp

        @foreach ($statusOrder as $status)
            @if ($groupedGames->has($status))
                <h2 class="text-xl font-bold mb-2 capitalize">{{ ucfirst($status) }}</h2>
                <ul class="mb-6">
                    @foreach ($groupedGames[$status] as $game)
                        <x-list-item :item="$game" :editRoute="'games.edit'" :deleteRoute="'games.destroy'" />
                    @endforeach
                </ul>
            @endif
        @endforeach

    </x-content-box>
</x-app-layout>