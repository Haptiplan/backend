<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-xl">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Centered Title with Elegant Font and Smooth Transition -->
                    <h1 class="text-3xl font-bold mb-6 text-center text-gray-900 dark:text-gray-100 transition duration-300 ease-in-out hover:text-blue-500">{{ __('messages.playerCreate') }}</h1>

                    <!-- Error Handling with Soft Background and Styled List -->
                    @if ($errors->any())
                    <div class="alert alert-danger bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md mb-6 transition-transform transform hover:scale-105">
                        <ul class="block text-sm font-medium text-red-600 dark:text-red-300 space-y-2">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Create Player Button with Gradient Background and Hover Effect -->
                    <div class="text-center mb-6">
                        <x-success-message></x-success-message>
                        <x-create-button href="{{ route('players.create', $game) }}" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-teal-400 text-white rounded-full text-lg font-semibold hover:from-teal-400 hover:to-blue-500 transition duration-300 ease-in-out transform hover:scale-105 shadow-lg hover:shadow-xl">
                            {{ __('messages.playerCreate') }}
                        </x-create-button>
                    </div>

                    <!-- Player List Grouped by Game and Company with Stylish List Items -->
                    <div class="mt-8 space-y-8">
                        <div class="space-y-4">
                            @foreach ($companies as $company)
                            <div class="ml-10 bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-700 rounded-lg p-4 shadow-lg mb-4">
                                <label class="font-semibold text-xl text-gray-800 dark:text-gray-100">{{ $company->name }}:</label>
                                <ul class="space-y-4 mt-2">
                                    @foreach ($players as $player)
                                    @if ($player->company_id == $company->id)
                                    @php
                                    $user = $user_list->firstWhere('id', $player->id);
                                    @endphp
                                    @if ($user)
                                    <li class="flex justify-between items-center bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md transition-all hover:shadow-xl transform hover:scale-105">
                                        <span class="text-gray-800 dark:text-gray-200 text-lg">{{ $user->name }}</span>
                                        <div class="flex items-center space-x-2">
                                            <x-edit-button href="{{ route('players.edit', ['games' => $game->id, 'id' => $user->id]) }}" />
                                            <form action="{{ route('players.destroy', ['games' => $game->id, 'id' => $user->id]) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <x-delete-button />
                                            </form>
                                        </div>
                                    </li>
                                    @endif
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>