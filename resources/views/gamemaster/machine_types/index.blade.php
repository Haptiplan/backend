<x-app-layout>
    <x-dashboard-header>
        {{ __('Dashboard') }}
    </x-dashboard-header>

    <x-content-box>
                    <!-- Centered Title with Elegant Font and Smooth Transition -->
                    <x-page-title>
                        {{ __('messages.machineTypeIndex') }}
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
                    <x-success-message></x-success-message>

                    <!-- Create Machine Type Button with Gradient Background and Hover Effect -->
                    <div class="text-center mb-6">
                        <x-create-button href="{{ route('machine_types.create') }}">
                            {{ __('messages.machineTypeCreate') }}
                        </x-create-button>
                    </div>

                    <!-- Machine Type List Grouped by Game with Stylish List Items -->
                    <div class="mt-8 space-y-8">
                        @foreach ($games as $game)
                            <x-container>
                                <label class=" underline decoration-yellow-400">{{ $game->name }}:</label>
                                <ul class="space-y-4 mt-4">
                                    @foreach ($machine_types as $machine_type)
                                        @if ($machine_type->game_id == $game->id)
                                            <x-list-item :item="$machine_type" :editRoute="'machine_types.edit'"
                                                :deleteRoute="'machine_types.destroy'" />
                                        @endif
                                    @endforeach
                                </ul>
                            </x-container>
                        @endforeach
                    </div>
                </x-content-box>
            </x-app-layout>