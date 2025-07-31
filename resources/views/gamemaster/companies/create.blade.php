<x-app-layout>
    <!-- Dashboard Header -->
    <x-dashboard-header>
        {{ __('Dashboard') }}
    </x-dashboard-header>

    <!-- Layout Content Box -->
    <x-content-box>

        <!-- Centered Title with Elegant Font and Smooth Transition -->
        <x-page-title>
            {{ __('messages.companyCreate') }}
        </x-page-title>

        <!-- Error Handling with Soft Background and Styled List -->
        <x-error-message />
        <x-success-message />

        <!-- Company Creation Form -->
        <form class="space-y-8" action="{{ route('companies.store') }}" method="POST">
            @csrf

            <!-- Company Name Input -->
            <div class="space-y-4">
                <x-header-label for="company_name">
                    {{ __('messages.companyName') }}
                </x-header-label>
                <x-input-field name="company_name" required />
            </div>

            <!-- Game Selection -->
            <div class="space-y-4">
                <x-header-label>
                    {{ __('messages.game') }}
                </x-header-label>
                <x-game-select :games="$games" />
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
            <x-back-button href="{{ route('companies.index') }}">
                {{ __('messages.back') }}
            </x-back-button>
        </div>
    </x-content-box>
</x-app-layout>