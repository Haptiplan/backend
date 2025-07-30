<x-app-layout>
    <x-dashboard-header>
        {{ __('Dashboard') }}
    </x-dashboard-header>

    <x-content-box>
        <!-- Game Creation Header -->
        <x-page-title>
            {{ __('messages.gameCreate') }}
        </x-page-title>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="bg-red-100 dark:bg-red-600 p-4 mb-6 rounded-md">
                <ul class="text-sm font-medium text-red-600 dark:text-red-300">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Game Creation Form -->
        <x-success-message></x-success-message>
        <form class="space-y-8" action="{{ route('games.store') }}" method="POST">
            @csrf

            <div class="space-y-4">
                <label for="game_name" class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                    {{ __('messages.gameName') }}
                </label>
                <input type="text" name="game_name" id="game_name" required
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200 transition duration-300 ease-in-out transform hover:scale-105">
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
            <x-back-button href="{{ route('games.index') }}">
                {{ __('messages.back') }}
            </x-back-button>
        </div>
    </x-content-box>

</x-app-layout>