<x-app-layout>
    <!-- Dashboard Header -->
    <x-dashboard-header>
        {{ __('Dashboard') }}
    </x-dashboard-header>

    <!-- Layout Content Box -->
    <x-content-box>

        <!-- Centered Title with Elegant Font and Smooth Transition -->
        <x-page-title>
            {{ __('messages.companyIndex') }}
        </x-page-title>

        <!-- Error Handling with Soft Background and Styled List -->
        <x-error-message />
        <x-success-message />
        
        <!-- Create Company Button with Gradient Background and Hover Effect -->
        <div class="text-center mb-6">
            <x-create-button href="{{ route('companies.create', $game) }}">
                {{ __('messages.companyCreate') }}
            </x-create-button>
        </div>

        <!-- Company List Grouped by Game with Stylish List Items -->
        <div class="mt-8 space-y-8">
            <div class="space-y-4">
                <ul class="mt-2">
                    @foreach ($companies as $company)
                        @if ($game->id == $company->game_id)
                            <x-list-item :item="$company" :editRoute="'companies.edit', ['games' => $game->id, 'id' => $company->id]" :deleteRoute="'companies.destroy', ['games' => $game->id, 'id' => $company->id]" />
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        
    </x-content-box>

</x-app-layout>