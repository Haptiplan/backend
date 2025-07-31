<x-app-layout>
    <!-- Dashboard Header -->
    <x-dashboard-header>
        {{ __('Dashboard') }}
    </x-dashboard-header>

    <!-- Layout Content Box -->
    <x-content-box>

        <!-- Centered Title -->
        <x-page-title>
            {{ __('messages.machineTypeEdit') }}
        </x-page-title>

        <!-- Error & Success Messages -->
        <x-error-message />
        <x-success-message />

        <!-- Edit Machine Type Form -->
        <form class="space-y-8" action="{{ route('machine_types.update', $machine_type->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Game Selection -->
            <div class="space-y-4">
                <x-header-label>
                    {{ __('messages.game') }}
                </x-header-label>
                <x-game-select :games="$games" :selected="$machine_type->game_id ?? null" />
            </div>

            <!-- Machine Type Name Input -->
            <div class="space-y-4">
                <x-header-label for="name">
                    {{ __('messages.machineTypeName') }}
                </x-header-label>
                <x-input-field name="name" id="name" value="{{ $machine_type->name }}" required />
            </div>

            <!-- Machine Type Price Input -->
            <div class="space-y-4">
                <x-header-label for="price">
                    {{ __('messages.machineTypePrice') }}
                </x-header-label>
                <x-input-field type="number" name="price" id="price" min="0" value="{{ $machine_type->price }}" step="5000000" required />
            </div>

            <!-- Machine Type Fix Costs Input -->
            <div class="space-y-4">
                <x-header-label for="fix_costs_per_period">
                    {{ __('messages.machineTypeFixCosts') }}
                </x-header-label>
                <x-input-field type="number" name="fix_costs_per_period" id="fix_costs_per_period" min="0" value="{{ $machine_type->fix_costs_per_period }}" step="500000" required />
            </div>

            <!-- Machine Type Capacity Input -->
            <div class="space-y-4">
                <x-header-label for="capacity">
                    {{ __('messages.machineTypeCapacity') }}
                </x-header-label>
                <x-input-field type="number" name="capacity" id="capacity" min="0" value="{{ $machine_type->capacity }}" step="5000" required />
            </div>

            <!-- Machine Type Number of Operators Input -->
            <div class="space-y-4">
                <x-header-label for="number_of_operators">
                    {{ __('messages.machineTypeOperators') }}
                </x-header-label>
                <x-input-field type="number" name="number_of_operators" id="number_of_operators" min="0" value="{{ $machine_type->number_of_operators }}" step="5" required />
            </div>

            <!-- Machine Type Depreciation Period Input -->
            <div class="space-y-4">
                <x-header-label for="depreciation_period">
                    {{ __('messages.machineTypeDepreciationPeriod') }}
                </x-header-label>
                <x-input-field type="number" name="depreciation_period" id="depreciation_period" min="0" value="{{ $machine_type->depreciation_period }}" step="2" required />
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <x-submit-button>
                    {{ __('messages.submit') }}
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