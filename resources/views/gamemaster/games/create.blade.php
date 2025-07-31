<x-app-layout>
    <!-- Dashboard Header -->
    <x-dashboard-header>
        {{ __('Dashboard') }}
    </x-dashboard-header>

    <!-- Layout Content Box -->
    <x-content-box>

        <!-- Centered Title with Elegant Font and Smooth Transition -->
        <x-page-title>
            {{ __('messages.gameCreate') }}
        </x-page-title>

        <!-- Error Handling with Soft Background and Styled List -->
        <x-error-message />
        <x-success-message />

        <!-- Game Creation Form -->
        <form class="space-y-8" action="{{ route('games.store') }}" method="POST">
            @csrf

            <div class="space-y-4">
                <x-header-label for="game_name">
                    {{ __('messages.gameName') }}
                </x-header-label>
                <x-input-field name="game_name" required />
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
            <x-back-button href="{{ route('games.index') }}">
                {{ __('messages.back') }}
            </x-back-button>
        </div>
        
    </x-content-box>
</x-app-layout>