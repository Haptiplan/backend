<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <!-- Company Creation Header -->
                    <h1 class="text-3xl font-semibold mb-8 text-center text-gray-900 dark:text-gray-100">{{ __('messages.companyCreate') }}</h1>

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

                    <!-- Company Creation Form -->
                     <x-success-message></x-success-message>
                    <form class="space-y-8" action="{{ route('companies.store') }}" method="POST">
                        @csrf

                        <!-- Company Name Input -->
                        <div class="space-y-4">
                            <label for="company_name" class="block text-lg font-medium text-gray-700 dark:text-gray-300">

                                {{ __('messages.companyName') }}
                            </label>
                            <input type="text" name="company_name" id="company_name" required
                                   class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200 transition duration-300 ease-in-out transform hover:scale-105">
                        </div>

                        <!-- Game Selection -->
                        <div class="space-y-4">
                            <label class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                                {{ __('messages.game') }}
                            </label>
                            <div class="space-y-2">
                                @foreach ($games as $game)
                                    <div class="flex items-center">
                                        <input type="radio" name="game_id" id="{{$game->id}}" value="{{$game->id}}" class="mr-2">
                                        <label for="{{$game->id}}" class="text-gray-800 dark:text-gray-200">{{ $game->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <x-submit-button class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-md shadow-lg hover:from-blue-700 hover:to-indigo-700 transition ease-in-out duration-300 transform hover:scale-105">
                                {{ __('messages.create') }}
                            </x-submit-button>
                        </div>
                    </form>

                    <!-- Back Button -->
                    <div class="text-center mt-6">
                        <x-back-button href="{{ route('companies.index') }}" class="px-8 py-3 bg-gray-300 dark:bg-gray-600 text-lg text-gray-800 dark:text-gray-200 font-semibold rounded-md shadow-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition duration-300">
                            {{ __('messages.back') }}
                        </x-back-button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
