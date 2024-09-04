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
                    <h1 class="text-2xl font-bold mb-6">{{ __('messages.userCreate') }}</h1>
                    <form class="space-y-4" action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('messages.username') }}
                            </label>
                            <input type="text" name="name" id="name" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200">
                            
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-4">
                                {{ __('messages.email') }}
                            </label>
                            <input type="email" name="email" id="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200">
                            
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-4">
                                {{ __('messages.password') }}
                            </label>
                            <input type="password" name="password" id="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200">
                            
                            <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-4">
                                {{ __('messages.role') }}
                            </label>
                            <select name="role" id="role" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200">
                                <option value="" disabled hidden selected>{{ __('messages.chooseRole') }}</option>
                                <option value="{{User::ROLE_ADMIN}}">{{ __('messages.admin') }}</option>
                                <option value="{{User::ROLE_GAMEMASTER}}">{{ __('messages.gamemaster') }}</option>
                                <option value="{{User::ROLE_USER}}">{{ __('messages.player') }}</option>
                            </select>
                            <label for="game" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mt-4">
                                {{ __('messages.listGames') }}
                            </label>
                            <select name="game" id="game" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200">
                                <option value="" disabled hidden selected>{{ __('messages.chooseGameGamemaster') }}</option>
                                @foreach ($games as $game)
                                <option value="{{$game->id}}" >{{$game->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-900 disabled:opacity-25 transition">
                                {{ __('messages.create') }}
                            </button>
                        </div>
                    </form> 
                    <div>
                        <label>{{ __('messages.admin') }}:</label> <br>
                        @foreach ($admins as $admin)
                        <li class="ml-10">
                            {{$admin->name}}
                            <a href="{{ route('user.edit', $admin->id) }}" class="inline-flex items-center px-2 py-1 border border-transparent rounded-md font-semibold font-medium text-gray-700 dark:text-gray-300 tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-900 disabled:opacity-25 transition">
                                Edit
                            </a>
                            <form action="{{ route('user.delete', $admin->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-2 py-1 border border-transparent rounded-md font-semibold font-medium text-gray-700 dark:text-gray-300 tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-900 disabled:opacity-25 transition">
                                    Delete
                                </button>
                                </form>
                            </li>
                        @endforeach
                        <label>{{ __('messages.gamemaster') }}:</label> <br>
                        @foreach ($gamemasters as $gamemaster)
                        <li class="ml-10">
                            {{$gamemaster->name}}
                            <a href="{{ route('user.edit', $gamemaster->id) }}" class="inline-flex items-center px-2 py-1 border border-transparent rounded-md font-semibold font-medium text-gray-700 dark:text-gray-300 tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-900 disabled:opacity-25 transition">
                                Edit
                            </a>
                            <form action="{{ route('user.delete', $gamemaster->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-2 py-1 border border-transparent rounded-md font-semibold font-medium text-gray-700 dark:text-gray-300 tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-900 disabled:opacity-25 transition">
                                    Delete
                                </button>
                                </form>
                            </li>
                        @endforeach
                        <label>{{ __('messages.player') }}:</label> <br>
                        @foreach ($players as $player)
                        <li class="ml-10">
                            {{$player->name}}
                            <a href="{{ route('user.edit', $player->id) }}" class="inline-flex items-center px-2 py-1 border border-transparent rounded-md font-semibold font-medium text-gray-700 dark:text-gray-300 tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-900 disabled:opacity-25 transition">
                                {{ __('messages.edit') }}
                            </a>
                            <form action="{{ route('user.delete', $player->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-2 py-1 border border-transparent rounded-md font-semibold font-medium text-gray-700 dark:text-gray-300 tracking-widest hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-900 disabled:opacity-25 transition">
                                    {{ __('messages.delete') }}
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
