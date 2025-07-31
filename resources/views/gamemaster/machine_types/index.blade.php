<x-app-layout>
    <!-- Dashboard Header -->
    <x-dashboard-header>
        {{ __('Dashboard') }}
    </x-dashboard-header>

    <!-- Layout Content Box -->
    <x-content-box>

        <!-- Centered Title -->
        <x-page-title>
            {{ __('messages.machineTypeIndex') }}
        </x-page-title>

        <!-- Error & Success Messages -->
        <x-error-message />
        <x-success-message />

        <!-- Create Machine Type Button -->
        <div class="text-center mb-6">
            <x-create-button href="{{ route('machine_types.create') }}">
                {{ __('messages.machineTypeCreate') }}
            </x-create-button>
        </div>

        <!-- Machine Type List Grouped by Game -->
        <div class="mt-8 space-y-8">
            @foreach ($games as $game)
                <x-container>
                    <x-header-label>
                        {{ $game->name }}:
                    </x-header-label>
                    <ul class="space-y-4 mt-4">
                        @foreach ($machine_types as $machine_type)
                            @if ($machine_type->game_id == $game->id)
                                <x-list-item :item="$machine_type" :editRoute="'machine_types.edit'" :deleteRoute="'machine_types.destroy'" />
                            @endif
                        @endforeach
                    </ul>
                </x-container>
            @endforeach
        </div>
    </x-content-box>
</x-app-layout>