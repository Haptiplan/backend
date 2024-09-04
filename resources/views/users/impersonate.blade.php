<?php use App\Models\User; ?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (Auth::check() && Auth::user()->role == User::ROLE_ADMIN)
                    <h1 class="text-2xl font-bold mb-6">{{ __('messages.impersonateGM') }}</h1>
                    <form class="space-y-4" action="{{ route('impersonate.start') }}" method="POST">
                        @csrf
                        <div>
                            <label for="game" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('messages.game') }}
                            </label>
                            <select name="game" id="game" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200">
                                <option value="" disabled hidden selected>{{ __('messages.chooseGame') }}</option>
                                @foreach ($games as $game)
                                <option value="{{$game->id}}" >{{$game->name}}</option>
                                @endforeach
                            </select>
                            <input name="role" id="role" required hidden value="{{ User::ROLE_GAMEMASTER }}"></input>
                        </div>
                        <div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-900 disabled:opacity-25 transition">
                                {{ __('messages.impersonateGM') }}
                            </button>
                        </div>
                    </form> 
                    @endif
                    <h1 class="text-2xl font-bold mb-6">{{ __('messages.impersonatePlayer') }}</h1>
                    <form class="space-y-4" action="{{ route('impersonate.start') }}" method="POST">
                        @csrf
                        <div>
                            <label for="company" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('messages.company') }}
                            </label>
                            <select  name="company" id="company" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200">
                                <option  class="block text-sm font-medium text-gray-700 dark:text-gray-300" value="" disabled hidden selected>{{ __('messages.chooseCompany') }}</option>
                                @foreach ($games as $game)
                                <optgroup label="{{ __('messages.game') }}: {{$game->name}}" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                    @foreach ($companies->where('game_id', $game->id) as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                            <input name="role" id="role" required hidden value="{{ User::ROLE_USER }}"></input>
                        </div>
                        <div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-900 disabled:opacity-25 transition">
                                {{ __('messages.impersonatePlayer') }}
                            </button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
