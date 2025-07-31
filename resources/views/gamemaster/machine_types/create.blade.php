<x-app-layout>
    <!-- Dashboard Header -->
    <x-dashboard-header>
        {{ __('Dashboard') }}
    </x-dashboard-header>

    <!-- Layout Content Box -->
    <x-content-box>

        <!-- Centered Title with Elegant Font and Smooth Transition -->
        <x-page-title>
            {{ __('messages.machineTypeCreate') }}
        </x-page-title>

        <!-- Error Handling with Soft Background and Styled List -->
        <x-error-message />
        <x-success-message />

        <!-- Machine Type Creation Form -->
        <form class="space-y-8" action="{{ route('machine_types.store') }}" method="POST">
            @csrf

            <!-- Game Selection -->
            <div class="space-y-4">
                <x-header-label>
                    {{ __('messages.game') }}
                </x-header-label>
                <x-game-select :games="$games" />
            </div>

            <!-- Machine Type Name Input -->
            <div class="space-y-4">
                <x-header-label for="name">
                    {{ __('messages.machineTypeName') }}
                </x-header-label>
                <x-input-field name="name" required />
            </div>

            <!-- Machine Type Price Input -->
            <div class="space-y-4">
                <x-header-label for="price">
                    {{ __('messages.machineTypePrice') }}
                </x-header-label>
                <x-input-field type="number" name="price" min="0" value="10000000" step="5000000" required />
            </div>

            <!-- Machine Type Fix Costs Input -->
            <div class="space-y-4">
                <x-header-label for="fix_costs_per_period">
                    {{ __('messages.machineTypeFixCosts') }}
                </x-header-label>
                <x-input-field type="number" name="fix_costs_per_period" min="0" value="1000000" step="500000" required />
            </div>

            <!-- Machine Type Capacity Input -->
            <div class="space-y-4">
                <x-header-label for="capacity">
                    {{ __('messages.machineTypeCapacity') }}
                </x-header-label>
                <x-input-field type="number" name="capacity" min="0" value="15000" step="5000" required />
            </div>

            <!-- Machine Type Number of Operators Input -->
            <div class="space-y-4">
                <x-header-label for="number_of_operators">
                    {{ __('messages.machineTypeOperators') }}
                </x-header-label>
                <x-input-field type="number" name="number_of_operators" min="0" value="10" step="5" required />
            </div>

            <!-- Machine Type Depreciation Period Input -->
            <div class="space-y-4">
                <x-header-label for="depreciation_period">
                    {{ __('messages.machineTypeDepreciationPeriod') }}
                </x-header-label>
                <x-input-field type="number" name="depreciation_period" min="0" value="8" step="2" required />
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
            <x-back-button href="{{ route('machine_types.index') }}">
                {{ __('messages.back') }}
            </x-back-button>
        </div>

    </x-content-box>
</x-app-layout>