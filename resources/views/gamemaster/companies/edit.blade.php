<x-app-layout>
    <!-- Dashboard Header -->
    <x-dashboard-header>
        {{ __('Dashboard') }}
    </x-dashboard-header>

    <!-- Layout Content Box -->
    <x-content-box>
        <!-- Centered Title with Elegant Font and Smooth Transition -->
        <x-page-title>
            {{ __('messages.companyEdit') }}
        </x-page-title>

        <!-- Error Handling with Soft Background and Styled List -->
        <x-error-message />
        <x-success-message />

        <!-- Edit Company Form -->
        <form class="space-y-8" action="{{ route('companies.update', ['games' => $game->id, 'id' => $company->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Company Name Input -->
            <div class="space-y-4">
                <x-header-label for="company_name">
                    {{ __('messages.companyName') }}
                </x-header-label>
                <x-input-field name="company_name" value="{{ $company->name }}" required />
            </div>

            <!-- Game Selection -->
            <input type="hidden" name="game_id" value="{{ $game->id }}">
            
            <!-- Submit Button -->
            <div class="text-center">
                <x-submit-button>
                    {{ __('messages.submit') }}
                </x-submit-button>
            </div>
        </form>

        <!-- Back Button -->
        <div class="text-center mt-6">
            <x-back-button href="{{ route('companies.index', $game) }}">
                {{ __('messages.back') }}
            </x-back-button>
        </div>
    </x-content-box>
</x-app-layout>
