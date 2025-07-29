<x-app-layout>
    <x-dashboard-header>
        {{ __('Dashboard') }}
    </x-dashboard-header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-xl">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Centered Title with Elegant Font and Smooth Transition -->
                    <x-page-title>
                        {{ __('messages.companyIndex') }}
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

                    <!-- Create Company Button with Gradient Background and Hover Effect -->
                    <div class="text-center mb-6">
                        <x-create-button href="{{ route('companies.create') }}">
                            {{ __('messages.companyCreate') }}
                        </x-create-button>
                    </div>

                    <!-- Company List Grouped by Game with Stylish List Items -->
                    <div class="mt-8 space-y-8">
                        @foreach ($games as $game)
                            <div class="mb-6">
                                <div class="space-y-4">
                                    <ul class="space-y-4 mt-2">
                                        @foreach ($companies as $company)
                                            @if ($game->id == $company->game_id)
                                                <x-list-item :item="$company" :editRoute="'companies.edit'"
                                                    :deleteRoute="'companies.destroy'" />
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>