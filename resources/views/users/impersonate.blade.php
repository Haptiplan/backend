<?php

use App\Models\User; ?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 dark:from-gray-800 dark:to-gray-900 shadow-xl sm:rounded-lg">
                <div class="p-8 text-white">
                    @if (Auth::check() && Auth::user()->role->name == User::ROLE_ADMIN)
                        <!-- Impersonate GM Section -->
                        <h1 class="text-3xl font-extrabold mb-8">{{ __('messages.impersonateGM') }}</h1>
                        <form action="{{ route('impersonate.start') }}" method="POST" class="space-y-6">
                            @csrf
                            <div>
                                <label for="game" class="block text-lg font-medium mb-2">
                                    {{ __('messages.chooseGame') }}
                                </label>
                                @foreach ($games as $game)
                                    <div class="flex items-center space-x-3">
                                        <input type="radio" name="game" id="game-{{$game->id}}" value="{{$game->id}}" class="w-5 h-5 text-indigo-600 focus:ring-indigo-500">
                                        <label for="game-{{$game->id}}" class="text-lg">
                                            {{$game->name}}
                                        </label>
                                    </div>
                                @endforeach
                                <input name="role" id="role" required hidden value="{{ User::ROLE_GAMEMASTER }}">
                            </div>
                            <div>
                                <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-3 px-6 rounded-full shadow-lg transition-transform transform hover:scale-105">
                                    {{ __('messages.impersonateGM') }}
                                </button>
                            </div>
                        </form>
                    @endif

                    <!-- Impersonate Player Section -->
                    <h1 class="text-3xl font-extrabold mt-12 mb-8">{{ __('messages.impersonatePlayer') }}</h1>
                    <form action="{{ route('impersonate.start') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="company" class="block text-lg font-medium mb-2">
                                {{ __('messages.company') }}
                            </label>
                            @foreach ($games as $game)
                                <div class="mb-4">
                                    <p class="text-lg font-bold mb-2">{{ __('messages.game') }}: {{$game->name}}</p>
                                    @foreach ($companies->where('game_id', $game->id) as $company)
                                        <div class="flex items-center space-x-3">
                                            <input type="radio" name="company" id="company-{{$company->id}}" value="{{$company->id}}" class="w-5 h-5 text-indigo-600 focus:ring-indigo-500">
                                            <label for="company-{{$company->id}}" class="text-lg">
                                                {{$company->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                            <input name="role" id="role" required hidden value="{{ User::ROLE_USER }}">
                        </div>
                        <div>
                            <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-3 px-6 rounded-full shadow-lg transition-transform transform hover:scale-105">
                                {{ __('messages.impersonatePlayer') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
