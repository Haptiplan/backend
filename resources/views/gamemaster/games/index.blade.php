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
                    <!-- Title Centered with Hover Effect -->
                    <h1 class="text-3xl font-bold mb-6 text-center text-gray-900 dark:text-gray-100 transition duration-300 ease-in-out hover:text-blue-500">{{ __('messages.gameIndex') }}</h1>

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
                    <x-success-message></x-success-message>
                    @php
                    $groupedGames = $games->groupBy('status');
                    $statusOrder = ['pending', 'active', 'completed', 'cancelled'];
                    @endphp

                    @foreach ($statusOrder as $status)
                    @if ($groupedGames->has($status))
                    <h2 class="text-xl font-bold mb-2 capitalize">{{ __('messages.' . $status) }}</h2>
                    <ul class="mb-6">
                        @foreach ($groupedGames[$status] as $game)
                        <li class="flex justify-between items-center bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-700 rounded-lg p-4 shadow-lg transition-transform hover:scale-105 mb-2">
                            <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $game->name }}</span>
                            <div class="flex items-center space-x-2">
                                <x-edit-button href="{{ route('games.edit', $game->id) }}" />
                                <form action="{{ route('games.destroy', $game->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-delete-button />
                                </form>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                    @endforeach

                    <!-- Create Game Button with Gradient and Hover Effect -->
                    <div class="text-center mb-6">
                        <x-create-button href="{{ route('games.create') }}" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-teal-400 text-white rounded-full text-lg font-semibold hover:from-teal-400 hover:to-blue-500 transition duration-300 ease-in-out transform hover:scale-105 shadow-lg hover:shadow-xl">
                            {{ __('messages.gameCreate') }}
                        </x-create-button>
                    </div>

                    <!-- Game List with Styled Items -->
                </div>
            </div>
        </div>
    </div>




</x-app-layout>