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
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-6">{{ __('messages.userIndex') }}</h1>
                    <x-create-button href="{{ route('users.create') }}">{{ __('messages.userCreate')}}</x-create-button>
                    <div>
                        <label>{{ __('messages.admin') }}:</label> <br>
                        @foreach ($admins as $admin)
                        <li class="ml-10">
                            {{$admin->name}}<br>
                            <x-edit-button href="{{ route('users.edit', $admin->id) }}"></x-edit-button>
                            <form action="{{ route('users.destroy', $admin->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <x-delete-button>{{ __('messages.delete') }}</x-delete-button>
                            </form>
                        </li>
                        @endforeach
                        <label>{{ __('messages.gamemaster') }}:</label> <br>
                        @foreach ($gamemasters as $gamemaster)
                        <li class="ml-10">
                            {{$gamemaster->name}}<br>
                            <x-edit-button href="{{ route('users.edit', $gamemaster->id) }}"></x-edit-button>
                            <form action="{{ route('users.destroy', $gamemaster->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <x-delete-button>{{ __('messages.delete') }}</x-delete-button>
                            </form>
                        </li>
                        @endforeach
                        <label>{{ __('messages.player') }}:</label> <br>
                        @foreach ($players as $player)
                        <li class="ml-10">
                            {{$player->name}}<br>
                            <x-edit-button href="{{ route('users.edit', $player->id) }}"></x-edit-button>
                            <form action="{{ route('users.destroy', $player->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <x-delete-button></x-delete-button>
                            </form>
                        </li>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>