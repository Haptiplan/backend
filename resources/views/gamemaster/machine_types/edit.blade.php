<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('messages.machineTypeEdit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <h1 class="text-3xl font-semibold text-center mb-8 text-gray-900 dark:text-gray-100">{{ __('messages.machineTypeEdit') }}</h1>

                    <!-- Error Alert -->
                    @if ($errors->any())
                        <div class="alert alert-danger bg-red-100 dark:bg-red-800 border-l-4 border-red-500 p-4 mb-6 rounded-md">
                            <ul class="block text-sm font-medium text-red-600 dark:text-red-300">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <x-success-message></x-success-message>

                    <!-- Edit Machine Type Form -->
                    <form class="space-y-8" action="{{ route('machine_types.update', $machine_type->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Game Selection -->
                        <div class="space-y-4">
                            <label class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                                {{ __('messages.game') }}
                            </label>
                            <div class="space-y-2">
                                @foreach ($games as $game)
                                    <div class="flex items-center">
                                        <input type="radio" name="game_id" id="{{$game->id}}" value="{{$game->id}}" class="mr-2" @if ($game->id == $machine_type->game_id) checked="checked" @endif>
                                        <label for="{{$game->id}}" class="text-gray-800 dark:text-gray-200">{{ $game->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Machine Type Name Input -->
                        <div class="space-y-4">
                            <label for="name" class="block text-lg font-medium text-gray-700 dark:text-gray-300">

                                {{ __('messages.machineTypeName') }}
                            </label>
                            <input type="text" name="name" id="name" value="{{ $machine_type->name }}" required
                                   class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200 transition duration-300 ease-in-out transform hover:scale-105">
                        </div>

                        <!-- Machine Type Price Input -->
                        <div class="space-y-4">
                            <label for="price" class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                                {{ __('messages.machineTypePrice') }}
                            </label>
                            <input type="number" name="price" id="price" min="0" value="{{ $machine_type->price }}" step="5000000" required
                                   class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200 transition duration-300 ease-in-out transform hover:scale-105">
                        </div>

                        <!-- Machine Type Fix Costs Input -->
                        <div class="space-y-4">
                            <label for="fix_costs_per_period" class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                                {{ __('messages.machineTypeFixCosts') }}
                            </label>
                            <input type="number" name="fix_costs_per_period" id="fix_costs_per_period" min="0" value="{{ $machine_type->fix_costs_per_period }}" step="500000" required
                                   class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200 transition duration-300 ease-in-out transform hover:scale-105">
                        </div>

                        <!-- Machine Type Capacity Input -->
                        <div class="space-y-4">
                            <label for="capacity" class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                                {{ __('messages.machineTypeCapacity') }}
                            </label>
                            <input type="number" name="capacity" id="capacity" min="0" value="{{ $machine_type->capacity }}" step="5000" required
                                   class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200 transition duration-300 ease-in-out transform hover:scale-105">
                        </div>

                        <!-- Machine Type Number of Operators Input -->
                        <div class="space-y-4">
                            <label for="number_of_operators" class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                                {{ __('messages.machineTypeOperators') }}
                            </label>
                            <input type="number" name="number_of_operators" id="number_of_operators" min="0" value="{{ $machine_type->number_of_operators }}" step="5" required
                                   class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200 transition duration-300 ease-in-out transform hover:scale-105">
                        </div>

                        <!-- Machine Type Depreciation Period Input -->
                        <div class="space-y-4">
                            <label for="depreciation_period" class="block text-lg font-medium text-gray-700 dark:text-gray-300">
                                {{ __('messages.machineTypeDepreciationPeriod') }}
                            </label>
                            <input type="number" name="depreciation_period" id="depreciation_period" min="0" value="{{ $machine_type->depreciation_period }}" step="2" required
                                   class="mt-1 block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200 transition duration-300 ease-in-out transform hover:scale-105">
                        </div>

                        <div class="text-center">
                            <x-submit-button class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-md shadow-lg hover:from-blue-700 hover:to-indigo-700 transition ease-in-out duration-300 transform hover:scale-105">
                                {{ __('messages.submit') }}
                            </x-submit-button>
                        </div>
                    </form>

                    <!-- Back Button -->
                    <div class="text-center mt-6">
                        <x-back-button href="{{ route('machine_types.index') }}" class="px-8 py-3 bg-gray-300 dark:bg-gray-600 text-lg text-gray-800 dark:text-gray-200 font-semibold rounded-md shadow-lg hover:bg-gray-400 dark:hover:bg-gray-500 transition duration-300">
                            {{ __('messages.back') }}
                        </x-back-button>
                    </div>

</x-app-layout>
