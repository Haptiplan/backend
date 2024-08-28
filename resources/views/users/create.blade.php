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
                    <h1 class="text-2xl font-bold mb-6">{{ __('Benutzer erstellen') }}</h1>
                    <form class="space-y-4" action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Benutzername') }}
                            </label>
                            <input type="text" name="name" id="name" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200">
                            
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-4">
                                {{ __('Email') }}
                            </label>
                            <input type="email" name="email" id="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200">
                            
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-4">
                                {{ __('Passwort') }}
                            </label>
                            <input type="password" name="password" id="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200">
                            
                            <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-4">
                                {{ __('Benutzerrolle') }}
                            </label>
                            <select name="role" id="role" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200">
                                <option value="" disabled hidden selected>{{ __('Wähle eine Benutzerrolle aus') }}</option>
                                <option value="{{User::ROLE_ADMIN}}">{{ __('Admin') }}</option>
                                <option value="{{User::ROLE_GAMEMASTER}}">{{ __('Spielleiter') }}</option>
                                <option value="{{User::ROLE_USER}}">{{ __('Spieler') }}</option>
                            </select>
                            <label for="game" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-4">
                                {{ __('Spiele') }}
                            </label>
                            <select name="game" id="game" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200">
                                <option value="" disabled hidden selected>{{ __('Wähle ein Spiel für den Spielleiter aus') }}</option>
                                @foreach ($games as $game)
                                <option value="{{$game->id}}" >{{$game->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-900 disabled:opacity-25 transition">
                                {{ __('Erstellen') }}
                            </button>
                        </div>
                    </form> 
                    <div>
                        @foreach ($users as $user)
                        <li>
                            {{$user->name}}
                            <a href="{{ route('user.edit', $user->id) }}" class="inline-flex items-center px-2 py-1 border border-transparent rounded-md font-semibold font-medium text-gray-700 dark:text-gray-300 tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-900 disabled:opacity-25 transition">
                                {{ __('Bearbeiten') }}
                            </a>
                            <form action="{{ route('user.delete', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-2 py-1 border border-transparent rounded-md font-semibold font-medium text-gray-700 dark:text-gray-300 tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-900 disabled:opacity-25 transition">
                                    {{ __('Löschen') }}
                                </button>
                                </form>
                            </li>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
