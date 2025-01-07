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
                    <h1 class="text-4xl font-extrabold mb-8">{{ __('messages.userIndex') }}</h1>

                    <div class="flex justify-end mb-6">
                        <x-create-button class="bg-yellow-400 hover:bg-yellow-500 text-gray-800 font-bold py-2 px-4 rounded shadow-lg transition duration-300" href="{{ route('users.create') }}">
                            {{ __('messages.userCreate') }}
                        </x-create-button>
                    </div>

                    <div class="space-y-10">
                        <!-- Admins Section -->
                        <div>
                            <h2 class="text-2xl font-semibold mb-4 border-b-2 border-yellow-400 pb-2">{{ __('messages.admin') }}</h2>
                            <ul class="space-y-6">
                                @foreach ($admins as $admin)
                                    <li class="flex items-center justify-between p-4 bg-white bg-opacity-10 rounded-lg shadow-lg">
                                        <span class="font-medium text-lg">{{ $admin->name }}</span>
                                        <div class="flex space-x-4">
                                            <x-edit-button class="bg-green-400 hover:bg-green-500 text-white font-bold py-1 px-3 rounded transition duration-300" href="{{ route('users.edit', $admin->id) }}">
                                                {{ __('messages.edit') }}
                                            </x-edit-button>
                                            <form action="{{ route('users.destroy', $admin->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <x-delete-button class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded transition duration-300">
                                                    {{ __('messages.delete') }}
                                                </x-delete-button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Gamemasters Section -->
                        <div>
                            <h2 class="text-2xl font-semibold mb-4 border-b-2 border-yellow-400 pb-2">{{ __('messages.gamemaster') }}</h2>
                            <ul class="space-y-6">
                                @foreach ($gamemasters as $gamemaster)
                                    <li class="flex items-center justify-between p-4 bg-white bg-opacity-10 rounded-lg shadow-lg">
                                        <span class="font-medium text-lg">{{ $gamemaster->name }}</span>
                                        <div class="flex space-x-4">
                                            <x-edit-button class="bg-green-400 hover:bg-green-500 text-white font-bold py-1 px-3 rounded transition duration-300" href="{{ route('users.edit', $gamemaster->id) }}">
                                                {{ __('messages.edit') }}
                                            </x-edit-button>
                                            <form action="{{ route('users.destroy', $gamemaster->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <x-delete-button class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded transition duration-300">
                                                    {{ __('messages.delete') }}
                                                </x-delete-button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Players Section -->
                        <div>
                            <h2 class="text-2xl font-semibold mb-4 border-b-2 border-yellow-400 pb-2">{{ __('messages.player') }}</h2>
                            <ul class="space-y-6">
                                @foreach ($players as $player)
                                    <li class="flex items-center justify-between p-4 bg-white bg-opacity-10 rounded-lg shadow-lg">
                                        <span class="font-medium text-lg">{{ $player->name }}</span>
                                        <div class="flex space-x-4">
                                            <x-edit-button class="bg-green-400 hover:bg-green-500 text-white font-bold py-1 px-3 rounded transition duration-300" href="{{ route('users.edit', $player->id) }}">
                                                {{ __('messages.edit') }}
                                            </x-edit-button>
                                            <form action="{{ route('users.destroy', $player->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <x-delete-button class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded transition duration-300">
                                                    {{ __('messages.delete') }}
                                                </x-delete-button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
